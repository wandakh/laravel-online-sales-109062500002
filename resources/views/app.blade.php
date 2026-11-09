<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Toko Laravel')</title>
    <style>
        * {
            box-sizing: border-box
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f7f7f8;
            color: #222
        }

        a {
            color: inherit;
            text-decoration: none
        }

        .container {
            max-width: 1120px;
            margin: auto;
            padding: 0 20px
        }

        nav {
            background: #111;
            color: #fff;
            padding: 16px 0
        }

        .nav {
            display: flex;
            gap: 18px;
            align-items: center
        }

        .nav .brand {
            font-weight: 700;
            margin-right: auto
        }

        main {
            padding: 30px 0
        }

        .card {
            background: #fff;
            border: 1px solid #e5e5e5;
            border-radius: 12px;
            padding: 18px
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 18px
        }

        .btn {
            display: inline-block;
            border: 0;
            border-radius: 8px;
            padding: 10px 14px;
            background: #111;
            color: #fff;
            cursor: pointer
        }

        .btn-light {
            background: #ececec;
            color: #222
        }

        .btn-danger {
            background: #a91515
        }

        .input,
        select,
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 8px;
            margin-top: 6px
        }

        label {
            display: block;
            margin-bottom: 12px
        }

        .alert {
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 16px;
            background: #e9f8ee
        }

        .error {
            background: #fdecec
        }

        .price {
            font-weight: 700;
            font-size: 1.1rem
        }

        .muted {
            color: #666
        }

        .row {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
            align-items: end
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: #fff
        }

        th,
        td {
            padding: 12px;
            border-bottom: 1px solid #eee;
            text-align: left
        }

        .thumb {
            width: 100%;
            height: 170px;
            object-fit: cover;
            border-radius: 9px;
            background: #eee
        }
    </style>
</head>

<body>
    <nav>
        <div class="container nav">
            <a class="brand" href="{{ route('shop.index') }}">Toko Laravel</a>
            <a href="{{ route('shop.index') }}">Produk</a>
            @auth

            @if(auth()->user()->role === 'customer')

            <a href="{{ route('cart.index') }}">Keranjang</a>
            <a href="{{ route('orders.index') }}">Pesanan</a>
            @else

            <a href="{{ route('admin.dashboard') }}">Admin</a>
            @endif

            <form method="POST" action="{{ route('logout') }}">@csrf<button class="btn-light" type="submit">Logout</button>
            </form>
            @else

            <a href="{{ route('login') }}">Login</a>
            <a href="{{ route('register') }}">Register</a>
            @endauth

        </div>
    </nav>
    <main>
        <div class="container">
            @if(session('success'))<div class="alert">{{ session('success') }}</div>@endif

            @if(session('error'))<div class="alert error">{{ session('error') }}</div>@endif

            @if($errors->any())<div class="alert error">

                <ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>

            </div>@endif

            @yield('content')
        </div>
    </main>
</body>

</html>