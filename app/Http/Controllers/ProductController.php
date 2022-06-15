<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use File;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data_product = Product::latest()->get();
        return view('product',[
            'title'=>'PRODUCT',
            'data_product'=>$data_product
        ]);
    }
    public function detail($id)
    {
        $data_product = Product::firstWhere('id',$id);
        return view('detail',[
            'title'=>'DETAIL PRODUCT',
            'data_product'=>$data_product
        ]);
    }
    public function dashboard()
    {
        $data_product = Product::latest()->get();
        return view('admin.product',compact('data_product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.new_product');
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
            'name'=>'required|unique:products,name',
            'deskripsi'=>'required',
            'harga'=>'required',
            'foto'=>'required|file|image|mimes:jpeg,png,jpg'
        ]);
        $file = $request->file('foto');
        $folder = 'img';
        $file->move($folder,$file->getClientOriginalName());
        $datavalidasi['foto'] = $file->getClientOriginalName();
        $post = Product::create($datavalidasi);
        if($post){
            return redirect('/dashboardproduct')->with('suksestambah','Anda Berhasil Menambah Data');
        }else{
            return redirect('/add_product')->with('gagaltambah','Terjadi Galat, Silahkan Coba Lagi Nanti');
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
        $data_product = Product::firstWhere('id',$id);
        return view('admin.edit_product',compact('data_product'));
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
            'deskripsi'=>'required',
            'harga'=>'required',
            'foto'=>'file|image|mimes:jpeg,png,jpg'
        ]);
        $data_product = Product::firstWhere('id',$id);
        if(empty($datavalidasi['foto'])){
            $datavalidasi['foto']=$data_product['foto'];
        }else{
            $file = $request->file('foto');
            $folder = 'img';
            $file->move($folder,$file->getClientOriginalName());
            File::delete('img/'.$data_product['foto']);
            $datavalidasi['foto']=$file->getClientOriginalName();
        }

        $update = Product::where('id' , $id)->update($datavalidasi);
        if($update){
            return redirect('/dashboardproduct')->with('suksestambah','Anda Berhasil Update');
        }else{
            return redirect('/edit_product/$id')->with('gagalupdate','Terjadi Galat, Silahkan Coba Lagi Nanti');
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
        $data_product = Product::firstWhere('id',$id);
        File::delete('img/'.$data_product['foto']);
        $delete = $data_product->delete();
        if($delete){
            return redirect('/dashboardproduct')->with('suksestambah','Anda Berhasil Delete');
        }else{
            return redirect('/dashboardproduct')->with('gagaldelete','Terjadi Galat, Silahkan Coba Lagi Nanti');
        } 
    }
}
