<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>

<body class="">
    <div class="">
        @if (Route::has('login'))
            <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                @auth
                    <a href="{{ route('shop.shop') }}" class="mr-3 pl-3">Səbət</a>
                    <a href="javascript:void(0)" class="pl-3 logout">Çıxış
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                        </form>

                    </a>
                @else
                    <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                    @endif
                @endauth
            </div>
        @endif
        <div class="container">
            <div class="row">
                @if (count($products) < 1)
                    <div class="col-lg-12">
                        <h5 class="text-center text-danger">Məhsul Əlavə Edilməyib</h5>
                    </div>
                @endif
                @foreach ($products as $product)
                    <div class="col-lg-3 my-2">
                        <div class="card" style="width: 100%;">
                            <img class="card-img-top" src="http://via.placeholder.com/640x360" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <p>
                                    @if (is_null($product->discount))
                                        {{ $product->price }} Azn
                                    @else
                                        <del>{{ $product->price }} Azn </del> {{ $product->price - $product->discount }} Azn
                                    @endif
                                </p>
                            </div>

                            <div class="card-body">
                                <button class="btn-primary btn addToCart">Sebete At
                                    <form action="{{ route('cart.add') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="product_id" value={{ $product->id }}>
                                    </form>

                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <script>
        $(document).ready(function() {
            $('.addToCart').on('click', function() {
                $(this).attr('disabled', true);
                $(this).find('form').submit();
            })
            $('.logout').on('click', function() {
                $(this).find('form').submit();
            })
        });
    </script>
    @if (session()->has('success'))
        <script type='text/javascript'>
            $(document).ready(function() {
                Swal.fire(
                    'Uğurlu Əməliyyat!',
                    '{{ session()->get('success') }}',
                    'success'
                )
            });
        </script>
    @endif
    @if (session()->has('error'))
        <script type='text/javascript'>
            $(document).ready(function() {
                Swal.fire(
                    'Uğursuz Əməliyyat!',
                    ' {{ session()->get('error') }}',
                    'error'
                )
            });
        </script>
    @endif
</body>

</html>
