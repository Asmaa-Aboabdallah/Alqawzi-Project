<?php

namespace App\Http\Controllers\dashboard;

use App\Models\User;
use App\Models\main_service;
use App\Models\main_service_user;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $data['users'] = User::where('role_id', 2)->count();
        $data['services'] = main_service::count();
        $data['orders'] = main_service_user::where('status', '!=', 'completed')->count();

        return view('dashboard.index')->with($data);
    }
}
