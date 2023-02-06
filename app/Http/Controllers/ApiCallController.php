<?php

namespace App\Http\Controllers;

use App\Models\ApiCall;
use DataTables;

class ApiCallController extends Controller
{
    protected $ApiCall;
    public function __construct()
    {
        $this->ApiCall = new ApiCall();
    }

    public function index()
    {
        return view('apicall');
    }

    public function Get_ApiCallData()
    {
        return DataTables::of(ApiCall::query())->make(true);
    }
}
