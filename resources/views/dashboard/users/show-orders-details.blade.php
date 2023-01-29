@extends('dashboard.layout')


@section('main')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0"> {{ __('web.Order') }} - {{ $main_order->main_services->name }}</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">{{ __('web.Home') }}</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('dashboard/users') }}">{{ __('web.Users') }}</a></li>
                            <li class="breadcrumb-item"><a href="{{ url()->previous() }}">{{ __('web.Orders') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('web.Order') }} - {{ $main_order->main_services->name }}</li>
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
                                <h3 class="card-title">{{ __('web.Order') }} - {{ $main_order->main_services->name }}</h3>
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
                            <div class="card-body p-0">

                                <table class="table table-sm">
                                    <tbody>
                                        @if ($main_order->main_services->name == 'نقل الملكيه')
                                            @if ($sub_order->sub_services->name == 'شخص الي شخص')
                                                <tr>
                                                    <th>{{ __('web.Service') }}</th>
                                                    <td>
                                                        {{ $sub_order->sub_services->name }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th colspan="2"><span class="badge bg-success">{{ __('web.First_Party_Uploads') }}</span></th>
                                                </tr>
                                                <tr>
                                                    <th>{{ __('web.ID_Photo') }}</th>
                                                    <td>
                                                        <img src="{{ asset('uploads/' . "$P2P->id_photo_from") }}"
                                                            height="100px">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>{{__('web.Driving_License')}}</th>
                                                    <td>
                                                        <img src="{{ asset('uploads/' . "$P2P->driving_license_from	") }}"
                                                            height="100px">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>{{ __('web.others') }}</th>
                                                    @if ($P2P->others_from != null)
                                                        <td><img src="{{ asset('uploads/' . "$P2P->others_from") }}"
                                                                height="100px">
                                                        </td>
                                                    @else
                                                        <td>....</td>
                                                    @endif
                                                </tr>
                                                <tr>
                                                    <th colspan="2"><span class="badge bg-danger">{{__('web.Second_Party_Uploads')}}</span></th>
                                                </tr>
                                                <tr>
                                                    <th>{{ __('web.ID_Photo') }}</th>
                                                    <td>
                                                        <img src="{{ asset('uploads/' . "$P2P->id_photo_to") }}"
                                                            height="100px">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>{{ __('web.Driving_License') }}</th>
                                                    <td>
                                                        <img src="{{ asset('uploads/' . "$P2P->driving_license_to	") }}"
                                                            height="100px">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>{{ __('web.others') }}</th>
                                                    @if ($P2P->others_to != null)
                                                        <td><img src="{{ asset('uploads/' . "$P2P->others_to") }}"
                                                                height="100px">
                                                        </td>
                                                    @else
                                                        <td>....</td>
                                                    @endif
                                                </tr>
                                            @elseif ($sub_order->sub_services->name == 'شركة الي شركة')
                                                <tr>
                                                    <th>{{ __('web.Service') }}</th>
                                                    <td>
                                                        {{ $sub_order->sub_services->name }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th colspan="2"><span class="badge bg-success">{{__('web.First_Party_Uploads')}}</span></th>
                                                </tr>
                                                <tr>
                                                    <th>{{ __('web.Log_Image') }}</th>
                                                    <td>
                                                        <img src="{{ asset('uploads/' . "$C2C->log_image_from") }}"
                                                            height="100px">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>{{ __('web.Letter') }}</th>
                                                    <td>
                                                        <img src="{{ asset('uploads/' . "$C2C->letter_from") }}"
                                                            height="100px">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>{{ __('web.Driving_License') }}</th>
                                                    <td>
                                                        <img src="{{ asset('uploads/' . "$C2C->driving_license_from	") }}"
                                                            height="100px">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>{{ __('web.others') }}</th>
                                                    @if ($C2C->others_from != null)
                                                        <td><img src="{{ asset('uploads/' . "$C2C->others_from") }}"
                                                                height="100px">
                                                        </td>
                                                    @else
                                                        <td>....</td>
                                                    @endif
                                                </tr>
                                                <tr>
                                                    <th colspan="2"><span class="badge bg-danger">{{__('web.Second_Party_Uploads')}}</span></th>
                                                </tr>
                                                <tr>
                                                    <th>{{ __('web.Log_Image') }}</th>
                                                    <td>
                                                        <img src="{{ asset('uploads/' . "$C2C->log_image_to") }}"
                                                            height="100px">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>{{ __('web.Letter') }}</th>
                                                    <td>
                                                        <img src="{{ asset('uploads/' . "$C2C->letter_to") }}"
                                                            height="100px">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>{{ __('web.Driving_License') }}</th>
                                                    <td>
                                                        <img src="{{ asset('uploads/' . "$C2C->driving_license_to	") }}"
                                                            height="100px">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>{{ __('web.others') }}</th>
                                                    @if ($C2C->others_to != null)
                                                        <td><img src="{{ asset('uploads/' . "$C2C->others_to") }}"
                                                                height="100px">
                                                        </td>
                                                    @else
                                                        <td>....</td>
                                                    @endif
                                                </tr>
                                            @elseif ($sub_order->sub_services->name == 'شخص الي شركة')
                                                <tr>
                                                    <th>{{ __('web.Service') }}</th>
                                                    <td>
                                                        {{ $sub_order->sub_services->name }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th colspan="2"><span class="badge bg-success">{{__('web.First_Party_Uploads')}}</span></th>
                                                </tr>
                                                <tr>
                                                    <th>{{ __('web.ID_Photo') }}</th>
                                                    <td>
                                                        <img src="{{ asset('uploads/' . "$P2C->id_photo_from") }}"
                                                            height="100px">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>{{ __('web.Driving_License') }}</th>
                                                    <td>
                                                        <img src="{{ asset('uploads/' . "$P2C->driving_license_from	") }}"
                                                            height="100px">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>{{ __('web.others') }}</th>
                                                    @if ($P2C->others_from != null)
                                                        <td><img src="{{ asset('uploads/' . "$P2C->others_from") }}"
                                                                height="100px">
                                                        </td>
                                                    @else
                                                        <td>....</td>
                                                    @endif
                                                </tr>
                                                <tr>
                                                    <th colspan="2"><span class="badge bg-danger">{{ __('web.Second_Party_Uploads') }}</span></th>
                                                </tr>
                                                <tr>
                                                    <th>{{ __('web.Log_Image') }}</th>
                                                    <td>
                                                        <img src="{{ asset('uploads/' . "$P2C->log_image_to") }}"
                                                            height="100px">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>{{ __('web.Letter') }}</th>
                                                    <td>
                                                        <img src="{{ asset('uploads/' . "$P2C->letter_to") }}"
                                                            height="100px">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>{{ __('web.Driving_License') }}</th>
                                                    <td>
                                                        <img src="{{ asset('uploads/' . "$P2C->driving_license_to	") }}"
                                                            height="100px">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>{{ __('web.others') }}</th>
                                                    @if ($P2C->others_to != null)
                                                        <td><img src="{{ asset('uploads/' . "$P2C->others_to") }}"
                                                                height="100px">
                                                        </td>
                                                    @else
                                                        <td>....</td>
                                                    @endif
                                                </tr>
                                            @else
                                                <tr>
                                                    <th>{{ __('web.Service') }}</th>
                                                    <td>
                                                        {{ $sub_order->sub_services->name }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th colspan="2"><span class="badge bg-success">{{__('web.First_Party_Uploads')}}</span></th>
                                                </tr>
                                                <tr>
                                                    <th>{{ __('web.Log_Image') }}</th>
                                                    <td>
                                                        <img src="{{ asset('uploads/' . "$C2P->log_image_from") }}"
                                                            height="100px">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>{{ __('web.Letter') }}</th>
                                                    <td>
                                                        <img src="{{ asset('uploads/' . "$C2P->letter_from") }}"
                                                            height="100px">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>{{ __('web.Driving_License') }}</th>
                                                    <td>
                                                        <img src="{{ asset('uploads/' . "$C2P->driving_license_from	") }}"
                                                            height="100px">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>{{ __('web.others') }}</th>
                                                    @if ($C2P->others_from != null)
                                                        <td><img src="{{ asset('uploads/' . "$C2P->others_from") }}"
                                                                height="100px">
                                                        </td>
                                                    @else
                                                        <td>....</td>
                                                    @endif
                                                </tr>
                                                <tr>
                                                    <th colspan="2"><span class="badge bg-danger">{{ __('web.Second_Party_Uploads') }}</span></th>
                                                </tr>
                                                <tr>
                                                    <th>{{ __('web.ID_Photo') }}</th>
                                                    <td>
                                                        <img src="{{ asset('uploads/' . "$C2P->id_photo_to") }}"
                                                            height="100px">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>{{ __('web.Driving_License') }}</th>
                                                    <td>
                                                        <img src="{{ asset('uploads/' . "$C2P->driving_license_to	") }}"
                                                            height="100px">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>{{ __('web.others') }}</th>
                                                    @if ($P2P->others_to != null)
                                                        <td><img src="{{ asset('uploads/' . "$C2P->others_to") }}"
                                                                height="100px">
                                                        </td>
                                                    @else
                                                        <td>....</td>
                                                    @endif
                                                </tr>
                                            @endif
                                        @elseif ($main_order->main_services->name == 'تجديد الرخصة')
                                            <tr>
                                                <th>{{ __('web.Service') }}</th>
                                                <td>
                                                    {{ $main_order->main_services->name }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>{{ __('web.ID_Photo') }}</th>
                                                <td>
                                                    <img src="{{ asset('uploads/' . "$new->id_photo") }}" height="100px">
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>{{ __('web.Form') }}</th>
                                                <td>
                                                    <img src="{{ asset('uploads/' . "$new->form") }}" height="100px">
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>{{ __('web.Examination') }}</th>
                                                <td>
                                                    <img src="{{ asset('uploads/' . "$new->Examination") }}"
                                                        height="100px">
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>{{ __('web.others') }}</th>
                                                @if ($new->others != null)
                                                    <td><img src="{{ asset('uploads/' . "$new->others") }}"
                                                            height="100px">
                                                    </td>
                                                @else
                                                    <td>....</td>
                                                @endif
                                            </tr>
                                        @else
                                            <tr>
                                                <th>{{ __('web.Service') }}</th>
                                                <td>
                                                    {{ $main_order->main_services->name }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>{{ __('web.ID_Photo') }}</th>
                                                <td>
                                                    <img src="{{ asset('uploads/' . "$insurance->id_photo") }}"
                                                        height="100px">
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>{{ __('web.Form') }}</th>
                                                <td>
                                                    <img src="{{ asset('uploads/' . "$insurance->form") }}"
                                                        height="100px">
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>{{ __('web.others') }}</th>
                                                @if ($insurance->others !== null)
                                                    <td><img src="{{ asset('uploads/' . "$insurance->others") }}"
                                                            height="100px">
                                                    </td>
                                                @else
                                                    <td>....</td>
                                                @endif
                                            </tr>
                                        @endif
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
