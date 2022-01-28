@extends('layouts.admin')
@section('_content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Sifarişlər</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                            <li class="breadcrumb-item active">Sifarişlər</li>
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
                        <div class="card {{ count($orders) < 1 ? 'card-danger' : 'card-primary' }}  card-outline">
                            <div class="card-body">
                                @if (count($orders) < 1)
                                    <h4 class="text-center text-danger">Sifarişlər Yoxdur</h4>
                                @else
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col" class="text-center">#</th>
                                                <th scope="col" class="text-center">Məhsul Adı</th>
                                                <th scope="col" class="text-center">Alicı</th>
                                                <th scope="col" class="text-center">Qiymət</th>
                                                <th scope="col" class="text-center">Say</th>
                                                <th scope="col" class="text-center">Hazırki Qiymət</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($orders as $order)
                                                <tr>
                                                    <th class="text-center" scope="row">{{ $loop->iteration }}</th>
                                                    <td class="text-center">{{ $order->product_name }}</td>
                                                    <td class="text-center">{{ $order->user_name }} Azn</td>
                                                    <td class="text-center">{{ $order->price}} Azn</td>
                                                    <td class="text-center">{{  $order->count }} </td>
                                                    <td class="text-center">{{  $order->count*$order->price }} </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @endif
                            </div>
                        </div>
                        <div class="d-flex justify-content-center">
                            {{ $orders->links() }}
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
