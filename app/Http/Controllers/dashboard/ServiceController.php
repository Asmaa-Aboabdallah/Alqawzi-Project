<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\main_service;
use App\Models\sub_service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    public function index()
    {
        $data['main_services'] = main_service::select('id', 'name', 'duration', 'price', 'img')->get();


        return view('dashboard.services.index')->with($data);
    }
    public function subservice($main_id)
    {
        $main = main_service::findOrFail($main_id);
        $data['sub_services'] = sub_service::where('main_service_id', $main->id)->select('id', 'name')->get();

        return view('dashboard.services.sub_service')->with($data);
    }

    public function show($main_id)
    {
        $data['main'] = main_service::findOrFail($main_id);

        return view('dashboard.services.show')->with($data);
    }

    public function main_edit($main_id)
    {
        $data['main'] = main_service::findOrFail($main_id);
        return view('dashboard.services.edit')->with($data);
    }
    public function main_update($main_id, Request $request)
    {
        $main = main_service::findOrFail($main_id);

        $request->validate([
            'name' => ['required', 'string'],
            'short_desc' => ['required', 'string'],
            'description' => ['required', 'string'],
            'duration' => ['required', 'integer'],
            'price' => ['required', 'numeric'],
            'image' => ['nullable', 'image', 'max:2048'],
        ]);

        $path = $main->img;
        if ($request->hasFile('image')) {
            Storage::delete($path);
            $path = Storage::putFile("users", $request->file('image'));
        }


        $main->update([
            'name' => $request->name,
            'short_desc' => $request->short_desc,
            'description' => $request->description,
            'duration' => $request->duration,
            'price' => $request->price,
            'img' => $path,

        ]);
        $request->session()->flash('msg', 'service updated successfully');
        return redirect("dashboard/services");
    }

    public function sub_edit($sub_id)
    {
        $data['sub'] = sub_service::findOrFail($sub_id);
        return view('dashboard.services.edit-sub')->with($data);
    }
    public function sub_update($sub_id, Request $request)
    {
        $sub = sub_service::findOrFail($sub_id);

        $request->validate([
            'name' => ['required', 'string'],
        ]);

        $sub->update([
            'name' => $request->name,

        ]);
        $request->session()->flash('msg', 'service updated successfully');
        return back();
    }
}


