<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class DeshboardController extends Controller
{
    // protected $Deshboard;
    // public function __construct()
    // {
    //     $this->Deshboard = new Deshboard();
    // }

    public function index()
    {
        $data['app_data'] = DB::table('settings')->count();
        $data['button_data'] = DB::table('buttons')->count();
        $data['apicall_data'] = DB::table('api_calls')->count();
        $data['video_data'] = DB::table('videos')->count();
        return view('dashboard', $data);
    }
}
