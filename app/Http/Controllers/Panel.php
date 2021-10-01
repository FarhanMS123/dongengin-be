<?php

namespace App\Http\Controllers;

use App\Models\Story;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class Panel extends Controller
{
    public function artisan(Request $request){
        return Artisan::call($request->q);
    }

    public function executor(Request $request){
        $ss = Story::all();
        foreach($ss as $s){
            $s->updateStoryRanking();
        }
        // return Artisan::call($request->q);
    }

    public function panel(Request $request){
        //
    }
}
