@extends('layout.main')
@section('konten')
<div class="row">
@error('userid')
<div class="alert alert-warning alert-dismissible fade show" role="alert">
  Mohon Login Sebelum Order Barang
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>

</div>
@enderror


@if(session()->has('gagal'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
  {{ session('gagal') }}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>

</div>
@endif



@if(session()->has('sukses'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  <h1>{{ session('sukses') }}</h1>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>

</div>
@endif



<div class="col">
  <div class="card shadow-sm">
    <img src="../img/{{$data_product['foto']}}" class="img-thumbnail" style="max-height: 400px;min-height: 400px;max-width: 400px;min-width: 400px;">
    <div class="card-body">
      <h5>{{$data_product['name']}} - Rp.{{$data_product['harga']}}</h5>
      <p class="card-text">{{$data_product['deskripsi']}}</p>
      <div class="d-flex justify-content-between align-items-center">
        <div class="btn-group">
          <form method="POST" action="/order/{{ $data_product['id'] }}">
            @csrf
            @auth
            <input type="hidden" name="userid" value="{{ auth()->user()->id }}">
            @else
            <input type="hidden" name="userid">
            @endauth
            <button type="submit" class="btn btn-sm btn-outline-success" type="submit">BUY</button>
          </form>
        </div>
        <small class="text-muted">{{$data_product['updated_at']}}</small>
      </div>
    </div>
  </div>
</div>
<a href="/product">< Return to product</a>
</div>
@endsection