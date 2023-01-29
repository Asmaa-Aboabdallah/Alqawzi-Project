@extends('dashboard.layout')


@section('main')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{__('web.Orders_Uploads')}}</h1>
                        @include('dashboard.inc.msg')
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">{{ __('web.Home') }}</a></li>
                            <li class="breadcrumb-item active">{{__('web.Orders_Uploads')}}</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">{{__('web.Orders_Uploads')}}</h3>
                               

                                {{-- <div class="card-tools">
                                    <div class="input-group input-group-sm" style="width: 150px;">
                                        <input type="text" name="table_search" class="form-control float-right"
                                            placeholder="Search">
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-default">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div> --}}
                            </div>

                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>{{ __('web.ID') }}</th>
                                            <th>{{ __('web.Order_Number') }}</th>
                                            <th>{{ __('web.Uploads') }}</th>
                                            <th>{{ __('web.Actions') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($uploads as $id => $upload)
                                            <tr>
                                                <td>{{ $id + 1 }}</td>
                                                <td>
                                                    {{ $upload->order_number }}
                                                </td>
                                                <td><img src="{{ asset('uploads/' . "$upload->admin_uploads") }}" height="60px"></td>
                                              
                                                <td>
                                                    <a href="{{ url("dashboard/uploads/delete/$upload->id") }}"
                                                        class="btn btn-sm btn-primary">
                                                        <i class="fas fa-trash"></i>
                                                    </a>

                                                  
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>

                        </div>

                    </div>
                </div>
                <!-- /.row -->

                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
