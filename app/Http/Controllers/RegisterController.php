<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('register',[
            'title'=>'REGISTER'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $datavalidasi = $request->validate([
            'name'=>'required',
            'email'=>'required|email:dns|unique:users,email',
            'username'=>'required|unique:users,username|min:5',
            'password'=>'required|min:5'
        ]);

        $datavalidasi['password_not_encrypted'] = $datavalidasi['password'];
        $datavalidasi['password'] = Hash::make($datavalidasi['password']);

        $post = User::create($datavalidasi);
        if($post){
            return redirect('/login')->with('suksesregis','Anda Berhasil Registrasi, Silahkan Login');
        }else{
            return redirect('/register')->with('gagalregis','Terjadi Galat, Silahkan Coba Lagi Nanti');
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
