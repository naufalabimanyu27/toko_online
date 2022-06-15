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
    <div class="row">
      <civ class="col">
        <table class="table table-striped table-dark">
          <thead>
            <tr>
              <th scope="col">Username</th>
              <th scope="col">Name</th>
              <th scope="col">Email</th>
              <th scope="col">Is Admin?</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($data_user as $data)
            <tr>
              <th>{{ $data->username }}</th>
              <td>{{ $data->name }}</td>
              <td>{{ $data->email }}</td>
              <td>{{ $data->is_admin===1 ? 'YES':'NO' }}</td>
                <td>
                    <a class="btn btn-warning" href="/edit_user/{{ $data->id }}">EDIT</a>
                    <form method="POST" action="/delete_user/{{ $data->id }}">@csrf 
                    <button class="btn btn-danger" type="submit">DELETE</button></form>
                </td>
            </tr>
            @endforeach
          </tbody>
        </table>
    </div>

    @if(session()->has('suksesupdate'))
    <div class="col">
<div class="alert alert-success alert-dismissible fade show" role="alert">
  {{ session('suksesupdate') }}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="removeAlert()">
    <span aria-hidden="true">&times;</span>
  </button>

</div></div>
@endif

@if(session()->has('suksesdelete'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  {{ session('suksesdelete') }}
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
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>