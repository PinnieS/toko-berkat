<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = User::all();
        return view('page.master.data-user',['user'=>$user]);
    }


    protected function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string'],
            'level' => ['required'],
        ]);

        


        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'level'=> $request->level,
        ]);

        return redirect('/data-user')->with('success',"Data Berhasil Disimpan");


    }

    public function update(Request $request, $id)
    {

        
        
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            
        ]);
        $user = User::find($id);
        $user->name = $request->name;

        if($request->password !== NULL){
            $request->validate([
                'password' => ['required', 'string'],
            ]);
            $user->password = Hash::make($request->password);
        }else{

        }
        
        $user->save();
        return redirect('/data-user')->with('success',"Data Berhasil Diupdate");
        
    }

    public function destroy($id)
    {
        $user = User::find($id);

        $user->delete();

        return redirect('/data-user')->with('error',"Data Berhasil Dihapus");
    }
}
