<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use File;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $data = DB::table('orders')
                    ->select('orders.id','orders.userid','orders.productid','users.name','users.username','users.email','products.name as product_name','products.deskripsi','products.foto','products.harga','orders.status_bayar','orders.foto as foto_bayar')
                    ->join('users', 'orders.userid', '=', 'users.id')
                    ->join('products', 'orders.productid', '=', 'products.id')
                    ->where('users.id', $id)
                    ->get();
        return view('order',[
            'title'=>'ORDER',
            'data_order'=>$data
        ]);
    }
    public function dashboard(){
        $data_order = DB::table('orders')
                    ->select('orders.id','orders.userid','orders.productid','users.name','users.username','users.email','products.name as product_name','products.deskripsi','products.foto','products.harga','orders.status_bayar','orders.foto as foto_bayar')
                    ->join('users', 'orders.userid', '=', 'users.id')
                    ->join('products', 'orders.productid', '=', 'products.id')
                    ->get();
        return view('admin.order',compact('data_order'));
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
    public function pesan(Request $request,$id)
    {
        $datavalidasi = $request->validate([
            'userid'=>'required|exists:users,id'
        ]);
        $datavalidasi['productid'] = $id;
        $datavalidasi['status_bayar'] = FALSE;
        $post = Order::create($datavalidasi);
        if($post){
            return redirect('/detail/'.$id)->with('sukses','Anda Berhasil Order, Silahkan Melakukan Pembayaran Ke 666666 - Bank Manduduk Atas Nama Tono Sutono Mutono Dan Upload Bukti Melalui List Order');
        }else{
            return redirect('/detail/'.$id)->with('gagal','Terjadi Galat, Silahkan Coba Lagi Nanti');
        }
    }
    public function store(Request $request,$id){
        $datavalidasi = $request->validate([
            'userid'=>'required|exists:users,id',
            'foto'=>'required|file|image|mimes:jpeg,png,jpg'
        ]);

        $data_order = Order::firstWhere('id',$id);
        $file = $request->file('foto');
        $folder = 'img';
        $file->move($folder,$file->getClientOriginalName());
        $datavalidasi['foto'] = $file->getClientOriginalName();
        // $datavalidasi['status_bayar']=TRUE;
        $update = Order::where('id' , $id)->update($datavalidasi);
        if($update){
            return redirect('/listorder/'.$datavalidasi['userid'])->with('suksestambah','Anda Berhasil Upload Bukti Bayar');
        }else{
            return redirect('/listorder/'.$datavalidasi['userid'])->with('gagaldelete','Terjadi Galat, Silahkan Coba Lagi Nanti');
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
    public function bayar(Request $request, $id)
    {
        $datavalidasi['status_bayar']=TRUE;
        $update = Order::where('id' , $id)->update($datavalidasi);
        if($update){
            return redirect('/dashboardorder')->with('sukses','Anda Berhasil Update');
        }else{
            return redirect('/dashboardorder')->with('gagal','Terjadi Galat, Silahkan Coba Lagi Nanti');
        } 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $datavalidasi = $request->validate([
            'userid'=>'required|exists:users,id'
        ]);

        $data_order = Order::firstWhere('id',$id);
        if($data_order['status_bayar']==0){
            $delete = $data_order->delete();
            if($delete){
                return redirect('/listorder/'.$datavalidasi['userid'])->with('suksestambah','Anda Berhasil Membatalkan');
            }else{
                return redirect('/listorder/'.$datavalidasi['userid'])->with('gagaldelete','Terjadi Galat, Silahkan Coba Lagi Nanti');
            } 
        }
        else{
            return redirect('/listorder/'.$datavalidasi['userid'])->with('gagaldelete','Gagal Membatalkan, Pesanan Sudah Di Bayar dan Di Kirim');
        }
    }
}
