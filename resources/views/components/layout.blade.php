<!DOCTYPE html>
<html lang="en">
<head>
  <title>Online Book Store</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="{{ asset('css/main.css') }}">
  <style>
      .main-bg {
    background-color:rgb(191, 238, 152);
}

.bg-card{
    background-color:rgb(216, 246, 216);
}
.cart-font{
    font-size: small;
}
.bg-lightcolor{
    background-color: rgb(238, 222, 191);
}
textarea {
    resize: none;
  }

  </style>
</head>
<body class="main-bg">
<div class="container mt-5">
  <div class="row">
    <div class="col-sm-1">
    </div>
    <div class="col-sm-10 bg-white rounded-2">
    <div class="row border-bottom">
        <div class="col-sm pt-3 ms-4">
            <span>
                <b>Customer : </b>{{ auth()->user()->name ?? 'Guest' }}
            </span>
        </div>
        <div class="col-sm">
            <span class="float-end my-3 mx-2">
                @auth
                <form action="{{ route('auth.destroy') }}" method="POST" >
                    @csrf
                    @method('DELETE')
                    <button class="bg-white border-0 text-danger">Sign Out</button>
                </form>
                @else
                <a href="{{ route('auth.create') }}" class="text-decoration-none">Sign In</a>
                @endauth
            </span>
            @auth
                <span class="float-end my-3 mx-2">
                    <a href="{{ route('order.index') }}" class="text-decoration-none rounded-5 float-end">My Orders</a>
                </span>
            @endauth
            <span class="float-end border border-1 rounded-2 p-2 m-2 bg-card">
                <a href="{{ route('cart.index')}}" class="text-decoration-none">
                <!--<img src="{{ asset('images/cart-logo.jpg') }}" onerror="" class="img-fluid" width="45" height="40" alt="">-->
                    <b>My Book Cart</b><span class="badge bg-danger ms-2">{{ session('cart') }}</span>
                </a>
            </span>
        </div>
    </div>
      {{ $slot }}
    </div>
    <div class="col-sm-1">

    </div>
  </div>
</div>

</body>
</html>

