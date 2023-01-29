<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\admin_main_upload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    public function index()
    {
        $data['uploads'] = admin_main_upload::select('id','order_number','admin_uploads')->get();
        return view('dashboard.uploads.index')->with($data);
    }

    public function delete($upload_id, Request $request)
    {
        $upload = admin_main_upload::findOrFail($upload_id);

        $upload->delete();
        $path = $upload->admin_uploads;
        Storage::delete($path);

        $request->session()->flash('msg','row deleted successfully');
        return back();

    }
}
