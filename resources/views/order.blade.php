@extends('layout.main')
@section('konten')


@if(session()->has('suksestambah'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  {{ session('suksestambah') }}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>

</div>
@endif

@if(session()->has('gagaldelete'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
  {{ session('gagaldelete') }}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>

</div>
@endif

@error('foto')
<div class="alert alert-danger alert-dismissible fade show" role="alert">
{{ $message }}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>

</div>
@enderror


<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Nama Produk</th>
      <th scope="col">Deskripsi Produk</th>
      <th scope="col">Harga</th>
      <th scope="col">Foto Barang</th>
      <th scope="col">Upload Bukti Bayar</th>
      <th scope="col">Status Bayar</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    @foreach($data_order as $data)
    <tr>
      <td><b><a href="/detail/{{ $data->productid }}">{{ $data->product_name }}</a></b></td>
      <td>{{$data->deskripsi}}</td>
      <td>{{$data->harga}}</td>
      <td><img src="../img/{{ $data->foto }}" class="img-thumbnail" style="max-width:250px;max-height:250px;"></td>
      <td>
        @if(empty($data->foto_bayar))
        <form enctype="multipart/form-data" method="POST" action="/upload_bukti_bayar/{{$data->id}}">
        @csrf
          <input type="file" name="foto">
          <input type="hidden" name="userid" value="{{ auth()->user()->id }}">
          <button type="submit" class="btn btn-warning">Upload Bukti Bayar</button>
        </form>
        @else
        <img src="../img/{{ $data->foto_bayar }}" class="img-thumbnail" style="max-width:250px;max-height:250px;">
        @endif
      </td>
      <td>
      @if((!$data->status_bayar) && (!empty($data->foto_bayar)))
      Bukti sudah kami terima, mohon menunggu pengecekan admin terima kasih
      @elseif(($data->status_bayar) && (!empty($data->foto_bayar)))
      Pembayaran sudah diterima
      @else
      Silahkan melakukan pembayaran ke nomor rekening : <br>666666 - Bank Manduduk<br>Atas Nama Tono Sutono Mutono
      @endif
      </td>
      <td>
        @if(!$data->status_bayar)
        <form method="POST" action="/delete_order/{{$data->id}}">
          @csrf
          <input type="hidden" name="userid" value="{{ auth()->user()->id }}">
          <button type="submit" class="btn btn-danger">Batalkan Order</button>
        </form>
        @else
        <p>Pembayaran sudah kami terima, barang telah dikirim</p>
        @endif
      </td>
    </tr>
    @endforeach
  </tbody>
</table>

@endsection