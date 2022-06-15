@extends('layout.main')
@section('konten')
      <div class="row">
        <div class="col">
          @auth
          <h1>WELCOME {{ auth()->user()->name }} TO TOKO ONLINE, <a href="/product">SEE OUR PRODUCT HERE</a></h1>
          @else
          <h1>WELCOME TO TOKO ONLINE</h1>
          @endauth
        </div>
      </div>
   @endsection