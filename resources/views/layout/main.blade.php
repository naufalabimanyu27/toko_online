<html>
  <head>
    <title>{{$title}}</title>
    <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
  </head>
  <body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand text-success" href="/">TOKO ONLINE</a>
      

      <div class="collapse navbar-collapse" id="navbarsExample05">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link {{ ($title=='HOME') ? 'active':'' }}" href="/">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link  {{ ($title=='PRODUCT') ? 'active':'' }}" href="/product">Product</a>
          </li>
          @auth
          <li class="nav-item">
            <a class="nav-link  {{ ($title=='ORDER') ? 'active':'' }}" href="/listorder/{{ auth()->user()->id }}">List Order</a>
          </li>
          @endauth
        </ul>
        @auth
        @if(auth()->user()->is_admin===1)
        <a class="btn btn-outline-warning" href="/dashboard">ADMIN PANEL</a>
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
      @yield('konten')
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="{{asset('js/bootstrap.js')}}"></script>
  </body>
</html>