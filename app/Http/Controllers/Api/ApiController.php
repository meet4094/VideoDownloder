<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\General;
use App\Models\Button;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
    protected $General;
    public function __construct()
    {
        $this->General = new General();
    }

    public function ApiCallData(Request $req)
    {
        $data = $this->General->ApiCallData($req);
        if (isset($data->original['statuscode'])) {
            return $data;
        } else {
            $App_Data = json_decode(json_encode($data->original['app_data'], true), true);
            $replacements = array('app_token' => $data->original['api_callData']['app_token']);
            $App_Data = array_replace($App_Data, $replacements);

            DB::table('api_calls')->insert($data->original['api_callData']);
            unset($App_Data['created_at']);
            unset($App_Data['updated_at']);
            unset($App_Data['is_del']);
            return response()->json([
                "statuscode" => 1,
                "msg" => "Api call successfully.",
                "data" => $App_Data
            ]);
        }
    }

    public function ButtonData(Request $req)
    {
        $data = $this->General->ButtonData($req);
        if (isset($data->original['statuscode'])) {
            return $data;
        } else {
            $buttons = Button::where('is_del', 0)->select('id', 'button_name', 'button_slug', 'is_del as status')->get();
            return response()->json([
                "statuscode" => 1,
                "msg" => "Success!!",
                "data" => $buttons
            ]);
        }
    }

    public function VideoData(Request $req)
    {
        $data = $this->General->VideoData($req);
        if (isset($data->original['statuscode'])) {
            return $data;
        } else {
            $validation = $this->General->DownloadUrlValidation($req);
            if (isset($validation->original['statuscode'])) {
                return $validation;
            } else {
                DB::table('videos')->insert($validation->original['data']);
                $DownloadData = array('download_meta' => json_decode($validation->original['data']['download_meta']));
                $validation = array_replace($validation->original['data'], $DownloadData);

                return response()->json([
                    "statuscode" => 1,
                    "msg" => "Success!!",
                    'data' => $validation
                ]);
            }
        }
    }
}
