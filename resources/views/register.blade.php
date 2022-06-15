@extends('layout.main') 
@section('konten') 

@if(session()->has('gagalregis'))
<div class="alert alert-warning alert-dismissible fade show" role="alert">
  {{ session('gagalregis') }}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>

</div>
@endif

<form method="POST" action="/register">
  @csrf
  <h1 class="h3 mb-3 fw-normal">Please register your data</h1>
  <div class="row">
    <div class="col-6">
      <div class="form-floating">
        <input type="name" name="name" class="form-control @error('name') is-invalid @enderror" id="floatingname" placeholder="name" value="{{old('name')}}" required>
        <label for="floatingname">Name</label>
      </div>
      @error('name')
      <p class="text-danger">{{ $message }}</p>
      @enderror
    </div>
    <div class="col-6">
      <div class="form-floating">
      <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="floatingemail" placeholder="email" value="{{old('email')}}" required>
        <label for="floatingemail">Email</label>        
      </div>
      @error('email')
      <p class="text-danger">{{ $message }}</p>
      @enderror
    </div>
    <div class="col-6">
      <div class="form-floating">
      <input type="username" name="username" class="form-control @error('username') is-invalid @enderror" id="floatingusername" placeholder="username" value="{{old('username')}}" required>
        <label for="floatingusername">Username</label>
      </div>
      @error('username')
      <p class="text-danger">{{ $message }}</p>
      @enderror
    </div>
    <div class="col-6">
      <div class="form-floating">
        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="floatingPassword" placeholder="Password" required>
        <label for="floatingPassword">Password</label>
      </div>
      @error('password')
      <p class="text-danger">{{ $message }}</p>
      @enderror
    </div>
  </div>
  <hr>
  <button class="w-100 btn btn-lg btn-success" type="submit">Register</button>
</form>

@endsection