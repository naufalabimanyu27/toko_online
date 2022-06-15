<html>
  <head>
    <title>DASHBOARD</title>
    <link rel="stylesheet" href="css/bootstrap.css">
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-success">
      <div class="container-fluid">
        <a class="navbar-brand" href="/dashboard">DASHBOARD TOKO ONLINE</a>
        <div class="collapse navbar-collapse" id="navbarsExample05">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link " href="/dashboard">List User</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="/dashboardproduct">List Product</a>
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
    @if(session()->has('gagaltambah'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
      {{ session('gagaltambah') }}
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>

    </div>
    @endif
        <form method="POST" action="/add_product" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="nama">Nama Produk</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Masukan Nama Produk" required>
                @error('name')
                <small id="namadesc" class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Deskripsi Produk</label>
                <textarea name ="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" id="exampleFormControlTextarea1" rows="3">{{ old('deskripsi') }}</textarea>
                @error('deskripsi')
                <small id="namadesc" class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="nama">Harga Produk</label>
                <input name="harga" type="number" value="{{ old('harga') }}" class="form-control @error('harga') is-invalid @enderror" placeholder="Masukan harga Produk" required>
                @error('harga')
                <small id="harga" class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group mt-5 mb-5">
                <label for="exampleFormControlFile1">Example file input</label>
                <input type="file" name="foto" class="form-control-file @error('foto') is-invalid @enderror" id="exampleFormControlFile1" required>
                @error('foto')
                <small id="harga" class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>
            <button class="w-100 btn btn-lg btn-success" type="submit">ADD</button>
          <a href="/dashboardproduct" class="w-100 btn btn-lg btn-danger ">Cancel</a>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="js/bootstrap.js"></script>
  </body>
</html>