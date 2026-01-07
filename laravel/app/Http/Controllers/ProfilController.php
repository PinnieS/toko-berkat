<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $user = User::find(Auth::user()->id);
        return view('page/profil',['user'=>$user]);
    }

   
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_user' => ['required', 'string', 'max:255'],
           
        ]);
        $user = User::find($id);
        $user->name = $request->nama_user;

        if($request->password_new !== NULL){
            $request->validate([
            'nama_user' => ['required', 'string', 'max:255'],
           
            ]);
            $user->password = Hash::make($request->password_new);
        }else{

        }
        $user->save();
        return redirect()->back()->with('success',"Profil Berhasil di Update");
        
    }

    
    public function destroy($id)
    {
        //
    }
}
