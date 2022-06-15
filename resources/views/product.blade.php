@extends('layout.main') 
@section('konten') 
<section class="py-5 text-center container">
    <div class="row py-lg-5">
      <div class="col-lg-6 col-md-8 mx-auto">
        <h1 class="fw-light">PRODUCT</h1>
        <p class="lead text-muted">Produk produk terbaru yang sudah dipastikan kualitasnya</p>
      </div>
    </div>
  </section>
<div class="row">
@foreach($data_product as $data)
<div class="col-4">
  <div class="card shadow-sm">
  <img src="img/{{$data->foto}}" class="img-thumbnail" style="max-width: 450px;max-height: 450px;">
    <div class="card-body">
    <h5>{{$data->name}} - Rp.{{$data->harga}}</h5>
      <p class="card-text">{{$data->deskripsi}}</p>
      <div class="d-flex justify-content-between align-items-center">
        <div class="btn-group">
          <a class="btn btn-sm btn-outline-secondary" href="/detail/{{$data->id}}">View</a>
        </div>
        <small class="text-muted">{{$data->updated_at}}</small>
      </div>
    </div>
  </div>
</div>
@endforeach
</div>
@endsection