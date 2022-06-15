<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data_user = User::latest()->get();
        return view('admin.dashboard',compact('data_user'));
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
        //
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
        $data_user = User::firstWhere('id',$id);
        return view('admin.user_edit',compact('data_user'));
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
        $datavalidasi = $request->validate([
            'name'=>'required',
            'email'=>'required|email:dns',
            'username'=>'required|min:5',
            'password'=>'min:5'
        ]);

        $data_user = User::firstWhere('id',$id);

        if($datavalidasi['password'] == ''){
            $datavalidasi['password'] = $data_user['password_not_encrypted'];
            $datavalidasi['password_not_encrypted'] = $datavalidasi['password'];
            $datavalidasi['password'] = Hash::make($datavalidasi['password']);
        }else{
            $datavalidasi['password_not_encrypted'] = $datavalidasi['password'];
            $datavalidasi['password'] = Hash::make($datavalidasi['password']);
        }
        $update = User::where('id' , $id)->update($datavalidasi);
        if($update){
            return redirect('/dashboard')->with('suksesupdate','Anda Berhasil Update');
        }else{
            return redirect('/edit_user/$id')->with('gagalupdate','Terjadi Galat, Silahkan Coba Lagi Nanti');
        } 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data_user = User::firstWhere('id',$id);
        $delete = $data_user->delete();
        if($delete){
            return redirect('/dashboard')->with('suksesdelete','Anda Berhasil Delete');
        }else{
            return redirect('/dashboard')->with('gagaldelete','Terjadi Galat, Silahkan Coba Lagi Nanti');
        } 
    }
}
