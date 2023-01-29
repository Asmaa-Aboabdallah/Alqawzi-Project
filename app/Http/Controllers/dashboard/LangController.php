<?php

namespace App\Http\Controllers\dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LangController extends Controller
{
    public function set($lang,Request $request)
    {
        $acceptedLang = ['en','ar'];
        if(!in_array($lang,$acceptedLang)){
            $lang = "en";
        }
        $request->session()->put('lang',$lang);
        return back();

    }
}
