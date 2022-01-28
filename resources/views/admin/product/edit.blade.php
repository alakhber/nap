@extends('layouts.admin')
@section('_content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ $product->name }}</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                            <li class="breadcrumb-item active">Məhsul</li>
                            <li class="breadcrumb-item active">{{ $product->name }}</li>
                            <li class="breadcrumb-item active">Edit</li>
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
                        <div class="card card-primary card-outline">
                            <div class="card-body">
                                @if (session('msg'))
                                    <h4 class="text-center {{ !session('operation') ? 'text-danger' : 'text-success' }}">{{ session('msg') }}</h4>
                                @endif
                                <form action="{{ route('admin.product.update', $product->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <div class="form-group">
                                        <label class="col-form-label" for="name">Məhsulun Adı </label>
                                        <input type="text" name="name" value="{{ $product->name }}" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Məhsulun Adı ">
                                        @error('name')
                                            <span id='name' class="error invalid-feedback" style="">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label" for="price">Məhsulun Qiyməti</label>
                                        <input type="text" name="price" value="{{ $product->price }}" class="form-control @error('price') is-invalid @enderror" id="price" placeholder="Məhsulun Qiyməti ">
                                        @error('price')
                                            <span id='price' class="error invalid-feedback" style="">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label" for="discount">Məhsulun Endirim Qiyməti </label>
                                        <input type="text" name="discount" value="{{ $product->discount }}" class="form-control @error('discount') is-invalid @enderror" id="discount" placeholder="Məhsulun Endirim Qiyməti ">
                                        @error('discount')
                                            <span id='discount' class="error invalid-feedback" style="">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-primary float-right">Yadda Saxla</button>
                                    </div>
                                </form>
                            </div>
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
