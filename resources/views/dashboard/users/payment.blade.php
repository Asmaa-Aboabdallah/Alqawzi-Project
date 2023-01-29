@extends('dashboard.layout')


@section('main')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0"> {{ __('web.Payment') }} - {{ $user->name }}</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">{{ __('web.Home') }}</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('dashboard/users') }}">{{ __('web.Users') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('web.Payment') }} - {{ $user->name }}</li>
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
                                <h3 class="card-title">{{ __('web.Payment') }} - {{ $user->name }}</h3>
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
                                            <th>{{ __('web.Payment_Receipt') }}</th>
                                            <th>{{ __('web.Card_Number') }}</th>
                                            <th>{{ __('web.Amount') }}</th>
                                            <th>{{ __('web.Expire_Date') }}</th>
                                            <th>{{ __('web.Actions') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($payment as $id => $pay)
                                            <tr>
                                                <td>{{ $id + 1 }}</td>
                                                <td>{{ $pay->order_number}}</td>
                                                @if ($pay->payment_receipt != null)
                                                    <td><img src="{{ asset('uploads/' . "$pay->payment_receipt") }}" height="60px"></td>
                                                @else
                                                    <td>....</td>
                                                @endif
                                                    <td>{{ $pay->card_number  ?? "..."  }}</td>
                                                <td>{{ $pay->amount  ?? "..."  }}</td>
                                                <td>{{ date("M Y", strtotime($pay->expire_date)) ?? "..." }}</td>

                                              
                                                <td>
                                                   
                                                    {{-- <a href="{{ url("dashboard/users/orders/$main_order->id") }}"
                                                        class="btn btn-sm btn-primary">
                                                        <i class="fas fa-receipt"></i>
                                                    </a> --}}

                                                    
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
