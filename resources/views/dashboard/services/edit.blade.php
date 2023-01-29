@extends('dashboard.layout')

@section('main')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">{{ __('web.Edit') }} {{ __('web.Service') }} - {{ $main->name }} </h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">{{ __('web.Home') }}</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('dashboard/services') }}">{{ __('web.Services') }}</a></li>
                            <li class="breadcrumb-item active">{{ $main->name }} </li>
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
                        <form action="{{ url("dashboard/services/main_update/$main->id") }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>{{ __('web.Name') }}</label>
                                            <input type="text" value="{{ $main->name }}" class="form-control"
                                                name="name">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>{{ __('web.Short_Description') }}</label>
                                            <textarea name="short_desc" class="form-control">{{ $main->short_desc }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>{{ __('web.Description') }}</label>
                                            <textarea name="description" class="form-control">{{ $main->description }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>{{ __('web.Duration') }}</label>
                                            <input type="number" value="{{ $main->duration }}" class="form-control"
                                                name="duration">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>{{ __('web.Price') }}</label>
                                            <input type="number" step="0.01" value="{{ $main->price }}" class="form-control"
                                                name="price">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>{{ __('web.Image') }}</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="form-control" name="image">
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
