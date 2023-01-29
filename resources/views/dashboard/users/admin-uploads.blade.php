@extends('dashboard.layout')

@section('main')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">{{ __('web.Uploads_For_Service') }} - {{ $main_order->main_services->name }} </h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">{{ __('web.Home') }}</a></li>
                            <li class="breadcrumb-item"><a href="{{ url()->previous() }}">{{ __('web.Services') }}</a></li>
                            <li class="breadcrumb-item active">{{ $main_order->main_services->name }} </li>
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
                    <div class="col-12 pb-3">
                        @include('dashboard.inc.msg')
                        <form action="{{ url("dashboard/users/storeUploads/$main_order->id") }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>{{ __('web.Order_Number') }}</label>
                                            <input type="number" disabled value="{{ $main_order->order_number }}" class="form-control"
                                                name="order_number">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>{{ __('web.Uploads') }}</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="form-control" name="image[]" multiple>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <button type="submit" class="btn btn-success">{{ __('web.Submit') }}</button>
                                    <a href="{{ url()->previous() }}" class="btn btn-primary">{{ __('web.Back') }}</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
@endsection
