@extends('layouts.admin')
@section('_content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Məhsullar</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                            <li class="breadcrumb-item active">Məhsullar</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- /.col-md-6 -->
                    <div class="col-lg-12">
                        <div class="card {{ count($products) < 1 ? 'card-danger' : 'card-primary' }}  card-outline">
                            <div class="card-body">
                                @if (session('msg'))
                                <h4 class="text-center {{ !session('operation') ? 'text-danger' : 'text-success' }}">{{ session('msg') }}</h4>
                                @endif
                                @if (count($products) < 1)
                                    <h4 class="text-center text-danger">Məhsul Yoxdur.Əlavə Etmək Üçün <a href="{{ route('admin.product.create') }}">Klikləyin</a></h4>
                                @else
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col" class="text-center">#</th>
                                                <th scope="col" class="text-center">Məhsul Adı</th>
                                                <th scope="col" class="text-center">Qiymət</th>
                                                <th scope="col" class="text-center">Endirim</th>
                                                <th scope="col" class="text-center">Hazırki Qiymət</th>
                                                <th scope="col" class="text-center">Əməliyyatlar</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($products as $product)
                                                <tr>
                                                    <th class="text-center" scope="row">{{ $loop->iteration }}</th>
                                                    <td class="text-center">{{ $product->name }}</td>
                                                    <td class="text-center">{{ $product->price }} Azn</td>
                                                    <td class="text-center">{{ is_null($product->discount) ? 0 : $product->discount }} Azn</td>
                                                    <td class="text-center">{{ is_null($product->discount) ? $product->price : $product->price - $product->discount }} Azn</td>
                                                    <td class="text-center">
                                                        <div class="d-flex justify-content-between w-25 mx-auto">
                                                            <a href="{{ route('admin.product.edit', $product->id) }}"><i class="fas fa-pen"></i></a>
                                                            <a href="javascript:void(0)" class="delete"><i class="fas fa-trash"></i>
                                                                <form action="{{ route('admin.product.delete', $product->id) }}" method="POST">
                                                                    @method('delete')
                                                                    @csrf
                                                                </form>
                                                            </a>
                                                        </div>

                                                    </td>

                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                @endif

                            </div>
                        </div>
                        <div class="d-flex justify-content-center">
                            {{ $products->links() }}
                        </div>
                    </div>

                    <!-- /.col-md-6 -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
@endsection
@section('_scripts')
    <script>
        $(document).ready(function() {
            $('.delete').on('click', function() {
                Swal.fire({
                    title: 'Xəbərdarlıq !',
                    text: "Silmək İstədiyinizə Əminsiniz ?",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    cancelButtonText: 'Xeyr !',
                    confirmButtonText: 'Bəli !'
                }).then((result) => {
                    if (result.value) {
                        $(this).find('form').submit();
                    }
                });
            })
        });
    </script>
@endsection
