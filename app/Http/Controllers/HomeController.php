<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BukuModel;
use Illuminate\Support\Facades\Auth;
use App\Models\Komentar;
use App\Models\Bookmark;
use App\Models\Kategori;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request, $kategori = null)
    {
        $query = $request->input('query');
        $kategorilist = Kategori::all();
        $buku = BukuModel::when($kategori, function ($query, $kategori) {
            return $query->where('category', $kategori);
            })
        ->when($query, function ($query, $search) {
            return $query->where('judul_buku', 'like', '%' . $search . '%');
        })
        ->get();
        $carousel = BukuModel::latest()->take(3)->get();
        return view('home', compact('buku','carousel','kategorilist','kategori'));
    }

    public function detailBuku($id)
    {
        // $detail = BukuModel::where('id',$id);
        $user = Auth::id();
        $detail = BukuModel::find($id);
        $komentar = Komentar::with('change_user')->where('id_buku',$detail->id)->get();
        // dd($user,$detail);
        $bookmark = Bookmark::where('id_user', $user)->where('id_buku', $detail->id)->first();    
        return view('detail-buku',['buku' => $detail, 'user' => $user,], compact('komentar','bookmark'));
    }

    public function pdfBuku($id)
    {
        $pdf = BukuModel::find($id);
        return view('pdf-buku',['buku' => $pdf]);
    }

    public function komentar(Request $request)
    {
        $request->validate([
            'id_buku' => 'Required',
            'id_user' => 'Required',
            'komentar' => 'Required',
        ]);
        Komentar::create([
            'id_user' => $request->id_user,
            'id_buku' => $request->id_buku,
            'komentar' => $request->komentar,
        ]);
        return back();
    }

    public function bookmark($id)
    {
        $user = Auth::id();
        Bookmark::create([
            'id_user' => $user,
            'id_buku' => $id,
        ]);

        return back();
    }
}
