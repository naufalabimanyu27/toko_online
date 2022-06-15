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
              <a class="nav-link " href="/dashboardproduct">List Product</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="/dashboardorder">List Order</a>
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
  {{ session('sukses') }}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>

</div>
@endif
    <civ class="col">
        <table class="table table-striped table-dark">
          <thead>
            <tr>
              <th scope="col">Nama Pengguna</th>
              <th scope="col">Username</th>
              <th scope="col">Barang Pesanan</th>
              <th scope="col">Harga</th>
              <th scope="col">Bukti Bayar</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($data_order as $data)
            <tr>
              <td>{{ $data->name }}</td>
              <td>{{ $data->username }}</td>
              <td>{{ $data->product_name }}</td>
              <td>{{ $data->harga }}</td>
              <td>
                @if(!empty($data->foto_bayar))
                <img src="img/{{ $data->foto_bayar }}" class="img-thumbnail" style="max-width:250px;max-height:250px;">
                @endif
              </td>
                <td>
                    @if((!$data->status_bayar) && (!empty($data->foto_bayar)))
                    <form method="POST" action="/terima_bayar/{{ $data->id }}">@csrf 
                    <button class="btn btn-warning" type="submit">KLIK UNTUK TERIMA PEMBAYARAN</button></form>
                    @elseif((!$data->status_bayar) && (empty($data->foto_bayar)))
                    <b><p class="text-danger">BUKTI BELUM DI UPLOAD</p></b>
                    @else
                    <b><p class="text-success">PEMBAYARAN SUDAH DITERIMA</p></b>
                    @endif
                </td>
            </tr>
            @endforeach
          </tbody>
        </table>
    </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="js/bootstrap.js"></script>
  </body>
</html>