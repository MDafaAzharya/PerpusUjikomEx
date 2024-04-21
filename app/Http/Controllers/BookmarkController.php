<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BukuModel;
use Illuminate\Support\Facades\Auth;
use App\Models\Bookmark;

class BookmarkController extends Controller
{
    public function index()
    {
        $user = Auth::id();
        $buku = Bookmark::with('buku')->where('id_user', $user)->get();
        return view('bookmark', compact('buku'));
    }

    public function destroy(string $id)
    {
        $user = Auth::id();
        $bookmark = Bookmark::where('id_user', $user)->where('id_buku', $id)->first();  
        $bookmark->delete();
        return back()->with('success', 'Remove Success');
    }
}
