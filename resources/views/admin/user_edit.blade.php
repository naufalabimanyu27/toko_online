<html>
  <head>
    <title>DASHBOARD</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-success">
      <div class="container-fluid">
        <a class="navbar-brand" href="/dashboard">DASHBOARD TOKO ONLINE</a>
        <div class="collapse navbar-collapse" id="navbarsExample05">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" href="/dashboard">List User</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/dashboardproduct">List Product</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/dashboardorder">List Order</a>
            </li>
          </ul> 
          @auth @if(auth()->user()->is_admin===1) 
          <a class="btn btn-outline-dark" href="/">KEMBALI KE WEB</a>
          <form action="/logout" method="POST" class="mb-0"> 
            @csrf 
            <button type="submit" class="btn btn-outline-danger">LOGOUT</button>
          </form> 
          @else 
          <form action="/logout" method="POST" class="mb-0"> 
            @csrf 
            <button type="submit" class="btn btn-outline-danger">LOGOUT</button>
          </form> 
          @endif 
          @else 
          <a class="btn btn-outline-success" href="/register">REGISTER</a>
          <a class="btn btn-outline-secondary" href="/login">LOGIN</a> 
          @endauth
        </div>
      </div>
    </nav>
    <div class="container">

    @if(session()->has('gagalupdate'))
    <div class="row">
<div class="alert alert-warning alert-dismissible fade show" role="alert">
  {{ session('gagalupdate') }}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>

</div></div>
@endif
      <div class="row">
        <form method="POST" action="/update_user/{{ $data_user->id }}"> 
   
        @csrf
            
            <h1 class="h3 mb-3 fw-normal">EDIT USER</h1>
          <div class="row">
            <div class="col-6">
              <div class="form-floating">
                <input type="name" name="name" class="form-control @error('name') is-invalid @enderror" id="floatingname" placeholder="name" value="{{ old('name',$data_user->name) }}" required>
                <label for="floatingname">Name</label>
              </div> 
              @error('name') 
              <p class="text-danger">{{ $message }}</p> 
              @enderror
            </div>
            <div class="col-6">
              <div class="form-floating">
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="floatingemail" placeholder="email" value="{{ old('email',$data_user->email) }}" required>
                <label for="floatingemail">Email</label>
              </div> 
              @error('email') 
              <p class="text-danger">{{ $message }}</p> 
              @enderror
            </div>
            <div class="col-6">
              <div class="form-floating">
                <input type="username" name="username" class="form-control @error('username') is-invalid @enderror" id="floatingusername" placeholder="username" value="{{old('username',$data_user->username)}}" required>
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
          <button class="w-100 btn btn-lg btn-success" type="submit">Edit</button>
          <a href="/dashboard" class="w-100 btn btn-lg btn-danger ">Cancel</a>
        </form>
      </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="../js/bootstrap.js"></script>
  </body>
</html>