<!DOCTYPE html>
<html lang="en">
<head>
  <title>Online Book Store</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="{{url('css/main.css')}}">
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
<div class="container mt-5 mb-5">
  <div class="row">
    <div class="col-sm-1">

    </div>
    <div class="col-sm-10 bg-white rounded-2">
    <div class="p-3 row bg-info rounded-top-2">
        <div class="col">
        <span>
            <b>Publisher Name:</b> {{ $info['publisher_name'] }}
        </span>
        </div>

        <div class="col">
        <span class="float-end me-2">
            @auth
            <form action="{{ route('auth.destroy') }}" method="POST" >
                @csrf
                @method('DELETE')
                <button class="bg-info border-0 text-danger">Sign Out</button>
            </form>
           @else
            <a href="{{ route('auth.create') }}" class="text-decoration-none ">Sign In</a>
           @endauth
        </span>
            <span class="me-1 float-end">
                <a href="{{ route('stocks.myrequests') }}" class="ms-2 text-decoration-none">
                    <button class="btn btn-sm bg-success text-white rounded-5">Stock Requests</button>
                </a>
            </span>
        <span class="float-end me-1">
            <form action="{{ route('books.create') }}">
            <button class="btn btn-sm btn-success rounded-5">Add New Book</button>
            </form>
        </span>
        <span class="float-end me-1">
            <form action="{{ route('books.index') }}">
            <button class="btn btn-sm btn-success rounded-5">My Books</button>
            </form>
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

