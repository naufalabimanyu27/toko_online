@extends('layout.main')
@section('konten')

@if(session()->has('suksesregis'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  {{ session('suksesregis') }}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>

</div>
@endif

@if(session()->has('gagalLogin'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
  {{ session('gagalLogin') }}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>

</div>
@endif

  <form action="/login" method="POST">
  @csrf
    <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

    <div class="form-floating">
      <input type="username" name="username" class="form-control @error('username') is-invalid @enderror" id="floatingInput" value="{{ old('username') }}"  placeholder="username" autofocus required>
      <label for="floatingInput">Username</label>
    </div>
    @error('username')
      <p class="text-danger">{{ $message }}</p>
      @enderror
    <div class="form-floating">
      <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="floatingPassword" placeholder="Password" required>
      <label for="floatingPassword">Password</label>
    </div>
    @error('password')
      <p class="text-danger">{{ $message }}</p>
      @enderror
    <hr>
    <button class="w-100 btn btn-lg btn-success" type="submit">Sign in</button>
  </form>


@endsection