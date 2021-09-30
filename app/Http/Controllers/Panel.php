<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class Panel extends Controller
{
    public function artisan(Request $request){
        return Artisan::call($request->q);
    }

    public function panel(Request $request){
        //
    }
}
