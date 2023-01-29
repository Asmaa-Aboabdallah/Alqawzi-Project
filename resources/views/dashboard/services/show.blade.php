@extends('dashboard.layout')


@section('main')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ __('web.Services') }}</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">{{ __('web.Home') }}</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('dashboard/services') }}">{{ __('web.Main_Services') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('web.Sub_Services') }}</li>
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
                    <div class="col-md-10 offset-md-1 pb-3">

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                   {{ __('web.Service') }} - {{ $main->name }}
                                </h3>
                            </div>

                            <div class="card-body p-0">

                                <table class="table table-sm">
                                    <tbody>
                                        <tr>
                                            <th>{{ __('web.Name') }}</th>
                                            <td>
                                               {{ $main->name }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>{{ __('web.Short_Description') }}</th>
                                            <td>
                                                {{ $main->short_desc ?? "..." }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>{{ __('web.Description') }}</th>
                                            <td>
                                               {{ $main->description ?? "..." }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>{{ __('web.Duration') }}</th>
                                            <td>
                                               {{ $main->duration}} {{ __('web.Days') }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>{{ __('web.Price') }}</th>
                                            <td>
                                               {{ $main->price}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>{{ __('web.Image') }}</th>
                                            <td><img src="{{ asset("uploads/". "$main->img") }}" height="100px"></td>
                                        </tr>

    

                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <a href="{{ url('dashboard/services') }}" class="btn btn-sm btn-primary">{{ __('web.Back') }}</a>

                    </div>

                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
    <!-- /.content -->
    </div>
@endsection
