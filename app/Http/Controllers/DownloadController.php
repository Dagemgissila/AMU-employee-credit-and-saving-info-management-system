<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DownloadController extends Controller
{
    public function download(){


        $file = public_path('excelfiles/member.xlsx');

        return response()->download($file);
    }
    public function download2(){
        $file = public_path('excelfiles/depositsample.xlsx');

        return response()->download($file);
    }
}
