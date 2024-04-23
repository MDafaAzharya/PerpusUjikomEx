<?php

namespace App\Http\Controllers\Dashboard\Petugas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BukuModel;
use Illuminate\Support\Facades\Storage;
use App\Models\Kategori;
use App\Libraries\PDF;

class DataBukuController extends Controller
{
    public function index(){
        $kategori = Kategori::all();
        return view('Dashboard.databuku',compact('kategori'));
    }

    public function store(Request $request){
        //dd($request->all());
        $request->validate([
            'judul_buku' => 'required',
            'penulis' => 'required',
            'deskripsi' => 'required',
            'kategori' => 'required',
            'file_buku' => 'required|mimes:pdf',
            'cover'=> 'required|mimes:jpeg,jpg,png'
        ]);
        if ($request->file('file_buku')) {
            $originalFileName = $request->file('file_buku')->getClientOriginalName();
            $image = $request->file('file_buku')->storeAs('public/buku', $originalFileName); 
            // Tambahkan nama file gambar ke data sebelum disimpan
        }
        if ($request->file('cover')) {
            $originalCoverName = $request->file('cover')->getClientOriginalName();
            $cover = $request->file('cover')->storeAs('public/cover', $originalCoverName); 
            // Tambahkan nama file gambar ke data sebelum disimpan
        }
        $insert = BukuModel::create([
            'judul_buku' => $request->judul_buku,
            'penulis' => $request->penulis,
            'deskripsi' => $request->deskripsi,
            'category' => $request->kategori,
            'file_buku' => $originalFileName,
            'cover' => $originalCoverName,
        ]);
        return back();
    }

    public function edit(string $id){
        $data =  BukuMOdel::find($id);
        return response()->json($data);
    }

    public function update(Request $request){
        //dd($request->all());
        $request->validate([
            'judul_buku' => 'required',
            'penulis' => 'required',
            'deskripsi_edit' => 'required',
            'kategori' => 'required',
            'file_buku' => 'mimes:pdf',
            'cover' => 'mimes:pdf',
        ]);
        $data = BukuModel::find($request->id);
        
        if ($request->hasFile('file_buku')) {
            $originalFileName = $request->file('file_buku')->getClientOriginalName();

            if ($data->file_buku) {
                Storage::delete('public/buku/' . $data->file_buku);
            }
            $image = $request->file('file_buku')->storeAs('public/buku', $originalFileName);
            $data->file_buku = $originalFileName;
        }

        if ($request->hasFile('cover')) {
            $originalCoverName = $request->file('cover')->getClientOriginalName();
            if ($data->cover) {
                Storage::delete('public/cover/' . $data->cover);
            }
            $cover = $request->file('cover')->storeAs('public/cover', $originalCoverName);
            $data->cover = $originalCoverName;
        }
        
        $data->judul_buku = $request->judul_buku;
        $data->penulis = $request->penulis;
        $data->deskripsi = $request->deskripsi_edit;
        $data->category = $request->kategori;
        $data->save();
        return back();
    }

    public function destroy(string $id)
    {
        $buku = BukuMOdel::findOrFail($id);
        
        if ($buku->file_buku) {
        $file_buku = 'public/file_buku/' . $buku->file_buku;
        if (Storage::exists($file_buku)) {
            Storage::delete($file_buku);
        }
        }

        if ($buku->cover) {
        $cover = 'public/cover/' . $buku->cover;
        if (Storage::exists($cover)) {
            Storage::delete($cover);
        }
        }        
        $buku->delete();
        return back()->with('success', 'Berhasil menghapus data');
    }

    public function datatable(){
        $data = BukuModel::with('change_kategori')->get();
        return \Yajra\DataTables\DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('judul_buku', function($row){
            return $row->judul_buku;
        })
        ->addColumn('penulis', function($row){
            return $row->penulis;
        })
        ->addColumn('deskripsi', function($row){
            return strip_tags($row->deskripsi);
        })
        ->addColumn('kategori', function($row){
            return $row->change_kategori->kategori;
        })
        ->addColumn('file_buku', function($row){
            $download_link = '<a href="' . Storage::url('public/buku/' . $row->file_buku) . '">Download</a>';
            return $download_link;
        })
        ->addColumn('cover', function ($row) {
            $imageUrl = asset("storage/cover/{$row->cover}");
            return $imageUrl;
        })
        ->addColumn('action', function($item){
            $button_delete = "<button class=\"btn btn-danger p-2 mx-1 btn-delete\" data-id=\"".$item->id."\"><i class=\"fa-solid fa-trash\"></i></button>";
            $button_edit = "<button class=\"btn btn-success p-2 mx-1 btn-edit\" data-id=\"".$item->id."\"><i class=\"fa-solid fa-pen-to-square\"></i></button>";
    
            return $button_delete . $button_edit;
          })
        ->rawColumns(['file_buku', 'action'])
        ->make(true);
    }

    public function print()
    {
        $books = BukuModel::all();
       

        // Define table header
        $header = array('Judul', 'Penulis', 'Kategori' ,'Cover');

        // Define table data
        $data = array();
        foreach ($books as $book) {
            $imagePath = 'storage/cover/' . $book->cover;
            $rowData = array($book->judul_buku, $book->penulis, $book->change_kategori->kategori, $imagePath);
            array_push($data, $rowData);
        }

        // Create PDF instance
        $pdf = new PDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);

        // Create book table
        $pdf->BookTable($header, $data);

        // Output PDF
        $pdf->Output();
        exit;
    }
}
