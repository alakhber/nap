@extends('layouts.admin')
@section('_content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Yeni Məhsul</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                            <li class="breadcrumb-item active">Yeni Məhsul</li>
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
                                <form action="{{ route('admin.product.store') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label class="col-form-label" for="name">Məhsulun Adı </label>
                                        <input type="text" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Məhsulun Adı ">
                                        @error('name')
                                            <span id='name' class="error invalid-feedback" style="">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label" for="price">Məhsulun Qiyməti</label>
                                        <input type="text" name="price" value="{{ old('price') }}" class="form-control @error('price') is-invalid @enderror" id="price" placeholder="Məhsulun Qiyməti ">
                                        @error('price')
                                            <span id='price' class="error invalid-feedback" style="">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label" for="discount">Məhsulun Endirim Qiyməti </label>
                                        <input type="text" name="discount" value="{{ old('discount') }}" class="form-control @error('discount') is-invalid @enderror" id="discount" placeholder="Məhsulun Endirim Qiyməti ">
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

@section('_scripts')
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
@endsection
