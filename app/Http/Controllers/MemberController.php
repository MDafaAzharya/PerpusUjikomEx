<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class MemberController extends Controller
{
    public function index(){
        $user_id = Auth::id();
        return view('member',compact('user_id'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'nama'=>'Required',
            'username'=>'Required',
            'email'=>'Required',
            'no_telepon'=>'Required',
            'alamat'=>'Required',
            'user_id'=>'Required',
        ]);
        Member::create([
            'nama'=>$request->nama,
            'username'=>$request->username,
            'email'=>$request->email,
            'no_telepon'=>$request->no_telepon,
            'alamat'=>$request->alamat,
            'id_user'=>$request->user_id,
        ]);

        $id = Auth::id();
        $user = User::where('id',$id)->first();;
        $user->status = 'member';
        $user->save();

        return back();
    }
}
