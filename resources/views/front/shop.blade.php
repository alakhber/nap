<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Sebet</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('project/backend/plugins/fontawesome-free/css/all.min.css') }}">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>

<body class="">
    <div class="">
        <div class="px-6 py-4 ">
            <a href="{{ route('home') }}" class="pl-3 mr-3">Ana Səhifə</a>
            <a href="javascript:void(0)" class="pl-3 logout">Çıxış
                <form action="{{ route('logout') }}" method="post">
                    @csrf
                </form>
            </a>
        </div>
        <div class="container">

            <div class="row">
                @if (session('errorValidation'))
                    <div class="col-lg-12">
                        <h5 class="text-center text-danger">{{ session('order') }}</h5>
                    </div>
                @else
                    <div class="col-lg-12">
                        <h5 class="text-center text-success">{{ session('order') }}</h5>
                    </div>
                @endif
                @if (session('errorValidation'))
                    <div class="col-lg-12">
                        <h5 class="text-center text-danger">{{ session('removeToCart') }}</h5>
                    </div>
                @else
                    <div class="col-lg-12">
                        <h5 class="text-center text-success">{{ session('removeToCart') }}</h5>
                    </div>
                @endif
                <div class="col-lg-12">
                    <div class="card {{ count($shops) < 1 ? 'card-danger' : 'card-primary' }}  card-outline">
                        <div class="card-body">
                            @if (count($shops) < 1)
                                <h4 class="text-center text-danger">Səbətdə Məhsul Yoxdur.Əlavə Etmək Üçün <a href="{{ route('home') }}">Klikləyin</a></h4>
                            @else
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="text-center">#</th>
                                            <th scope="col" class="text-center">Məhsul Adı</th>
                                            <th scope="col" class="text-center">Qiymət</th>
                                            <th scope="col" class="text-center">Say</th>
                                            <th scope="col" class="text-center">Ümumi Qiymət</th>
                                            <th scope="col" class="text-center">Əməliyyatlar</th>
                                            <th scope="col" class="text-center">Sifariş Et</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($shops as $product)
                                            <tr>
                                                <th class="text-center" scope="row">{{ $loop->iteration }}</th>
                                                <td class="text-center">{{ $product->product->name }}</td>
                                                <td class="text-center">{{ $product->price }} Azn</td>
                                                <td class="text-center">{{ $product->count }}</td>
                                                <td class="text-center">{{ $product->count * $product->price }} Azn</td>
                                                <td class="text-center">
                                                    <div class="d-flex justify-content-between w-50 mx-auto">
                                                        <a href="javascript:void(0)" class="increment"><i class="fas fa-plus"></i>
                                                            <form action="{{ route('cart.increment') }}" method="POST">
                                                                @method('patch')
                                                                @csrf
                                                                <input type="hidden" name="product_id" value="{{ $product->product->id }}">
                                                            </form>
                                                        </a>
                                                        <a href="javascript:void(0)" class="decrement"><i class="fas fa-minus"></i></i>
                                                            <form action="{{ route('cart.decrement') }}" method="POST">
                                                                @method('patch')
                                                                @csrf
                                                                <input type="hidden" name="product_id" value="{{ $product->product->id }}">
                                                            </form>
                                                        </a>

                                                        <a href="javascript:void(0)" class="delete"><i class="fas fa-trash"></i>
                                                            <form action="{{ route('cart.remove') }}" method="POST">
                                                                @method('delete')
                                                                @csrf
                                                                <input type="hidden" name="product_id" value="{{ $product->product->id }}">
                                                                
                                                            </form>
                                                        </a>

                                                    </div>

                                                </td>
                                                <td class="text-center">
                                                    <a href="javascript:void(0)" class="order"><i class="fas fa-cart-arrow-down"></i>
                                                        <form action="{{ route('shop.addOrder') }}" method="POST">
                                                            @csrf
                                                            <input type="hidden" name="shop_id" value="{{ $product->id }}">
                                                        </form>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            @endif
                        </div>
                    </div>
                    <div class="d-flex justify-content-center">
                        {{ $shops->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
    <script>
        $(document).ready(function() {
            $('.delete').on('click', function() {
                $(this).attr('disabled', true);
                $(this).find('form').submit();
            })
            $('.logout').on('click', function() {
                $(this).find('form').submit();
            })
            $('.increment').on('click', function() {
                $(this).find('form').submit();
            })
            $('.decrement').on('click', function() {
                $(this).find('form').submit();
            })
            $('.order').on('click', function() {
                $(this).find('form').submit();
            })

        });
    </script>
</body>

</html>
