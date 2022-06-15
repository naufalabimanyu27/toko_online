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
    <div class="row">
      <civ class="col">
        <table class="table table-striped table-dark">
          <thead>
            <tr>
              <th scope="col">Name</th>
              <th scope="col">Deskripsi</th>
              <th scope="col">Harga</th>
              <th scope="col">Foto</th>
              <th scope="col">Action | <a class="btn btn-success" href="/add_product">ADD +</a></th>
            </tr>
          </thead>
          <tbody>
            @foreach($data_product as $data)
            <tr>
              <td>{{ $data->name }}</td>
              <td>{{ $data->deskripsi }}</td>
              <td>{{ $data->harga }}</td>
              <td><img src="img/{{ $data->foto }}" class="img-thumbnail" style="max-width:250px;max-height:250px;"></td>
                <td>
                    <a class="btn btn-warning" href="/edit_product/{{ $data->id }}">EDIT</a>
                    <form method="POST" action="/delete_product/{{ $data->id }}">@csrf 
                    <button class="btn btn-danger" type="submit">DELETE</button></form>
                </td>
            </tr>
            @endforeach
          </tbody>
        </table>
    </div>
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
  </div>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="js/bootstrap.js"></script>
  </body>
</html>