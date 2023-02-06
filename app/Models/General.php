<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Functions;
use App\Models\Youtube;
use App\Models\Twitter;
use App\Models\Bitchute;
use App\Models\Dailymotion;
use App\Models\Espn;
use App\Models\Imdb;
use App\Models\Imgur;
use App\Models\Izlesene;
use App\Models\Reddit;
use App\Models\Rumble;
use App\Models\Instagram;
use App\Models\Facebook;

class General extends Model
{
    use HasFactory;

    protected $Functions;
    protected $Youtube;
    protected $Twitter;
    protected $Bitchute;
    protected $Dailymotion;
    protected $Imdb;
    protected $Imgur;
    protected $Izlesene;
    protected $Reddit;
    protected $Rumble;
    protected $Instagram;
    protected $Facebook;

    public function __construct()
    {
        $this->Functions = new Functions();
        $this->Youtube = new Youtube();
        $this->Twitter = new Twitter();
        $this->Bitchute = new Bitchute();
        $this->Dailymotion = new Dailymotion();
        $this->Espn = new Espn();
        $this->Imdb = new Imdb();
        $this->Imgur = new Imgur();
        $this->Izlesene = new Izlesene();
        $this->Reddit = new Reddit();
        $this->Rumble = new Rumble();
        $this->Instagram = new Instagram();
        $this->Facebook = new Facebook();
    }

    // APi Main Function
    public function ButtonData($req)
    {
        $ReqToken = $req->header('request-token');
        $AppToken = $req->app_token;
        $DeviceId = $req->device_id;
        $AppId = $req->app_id;
        $RequestTokenData = DB::table('settings')->where('request_token', $ReqToken)->first();
        $AppTokenData = DB::table('api_calls')->where('app_token', $AppToken)->first();

        if (empty($ReqToken) || empty($RequestTokenData->request_token)) {
            return response()->json([
                "statuscode" => 7,
                "msg" => "Request token missing"
            ]);
        } else {
            $validator = Validator::make($req->all(), [
                'app_token' => 'required',
                'device_id' => 'required',
                'app_id' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    "statuscode" => 0,
                    'error' => $validator->errors()->toArray()
                ]);
            } else {
                if (empty($AppToken) || empty($AppTokenData->app_token)) {
                    return response()->json([
                        "statuscode" => 7,
                        "msg" => "App token Invalide"
                    ]);
                } else if ($DeviceId != $AppTokenData->device_id) {
                    return response()->json([
                        "statuscode" => 7,
                        "msg" => "Device Id Invalide"
                    ]);
                } else if ($AppId != $RequestTokenData->id) {
                    return response()->json([
                        "statuscode" => 7,
                        "msg" => "App Id Invalide"
                    ]);
                }
            }
        }
    }

    public function ApiCallData($req)
    {
        $request_token = $req->header('request-token');
        $data = DB::table('settings')->where('request_token', $request_token)->first();
        if (empty($request_token) || empty($data->request_token)) {
            return response()->json([
                "statuscode" => 7,
                "msg" => "Request token missing"
            ]);
        } else {
            $validator = Validator::make($req->all(), [
                'device_id' => 'required',
                'package_name' => 'required',
                'app_version' => 'required',
                'app_version_code' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    "statuscode" => 0,
                    'error' => $validator->errors()->toArray()
                ]);
            } else {
                $ipAddress = $this->get_client_ip();
                $app_token = Str::random(15);
                $Api_CallData = array(
                    'app_id' => $data->id,
                    'device_id' => $req['device_id'],
                    'package_name' => $req['package_name'],
                    'app_version' => $req['app_version'],
                    'version_code' => $req['app_version_code'],
                    'app_token' => $app_token,
                    'ip_address' => $ipAddress
                );
                return response()->json(['api_callData' => $Api_CallData, 'app_data' => $data]);
            }
        }
    }

    function get_client_ip()
    {
        $ipAddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipAddress = $_SERVER['HTTP_CLIENT_IP'];
        else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipAddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_X_FORWARDED']))
            $ipAddress = $_SERVER['HTTP_X_FORWARDED'];
        else if (isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipAddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_FORWARDED']))
            $ipAddress = $_SERVER['HTTP_FORWARDED'];
        else if (isset($_SERVER['REMOTE_ADDR']))
            $ipAddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipAddress = 'UNKNOWN';
        return $ipAddress;
    }
    
    public function VideoData($req)
    {
        $ReqToken = $req->header('request-token');
        $AppToken = $req->app_token;
        $DeviceId = $req->device_id;
        $AppId = $req->app_id;
        $RequestTokenData = DB::table('settings')->where('request_token', $ReqToken)->first();
        $AppTokenData = DB::table('api_calls')->where('app_token', $AppToken)->first();

        if (empty($ReqToken) || empty($RequestTokenData->request_token)) {
            return response()->json([
                "statuscode" => 7,
                "msg" => "Request token missing"
            ]);
        } else {
            $validator = Validator::make($req->all(), [
                'app_token' => 'required',
                'device_id' => 'required',
                'app_id' => 'required',
                'download_url' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    "statuscode" => 0,
                    'error' => $validator->errors()->toArray()
                ]);
            } else {
                if (empty($AppToken) || empty($AppTokenData->app_token)) {
                    return response()->json([
                        "statuscode" => 7,
                        "msg" => "App token Invalide"
                    ]);
                } else if ($DeviceId != $AppTokenData->device_id) {
                    return response()->json([
                        "statuscode" => 7,
                        "msg" => "Device Id Invalide"
                    ]);
                } else if ($AppId != $RequestTokenData->id) {
                    return response()->json([
                        "statuscode" => 7,
                        "msg" => "App Id Invalide"
                    ]);
                }
            }
        }
    }

    // End Main APi Function

    //Api pass url Validation
    public function DownloadUrlValidation($req)
    {
        // api pass download url
        $url = $req->download_url;

        //api pass download url Domain name 
        $host = parse_url($url, PHP_URL_HOST);
        $domain = str_ireplace("www.", "", $host);
        $main_domain = $this->Functions->get_main_domain($host);

        if ($domain == "instagram.com") {
            $data = $this->Instagram->Data($req);
            return $data;
        } else if ($domain == "youtube.com" || $domain == "m.youtube.com" || $domain == "youtu.be") {
            $data = $this->Youtube->Data($req);
            return $data;
        } else if ($domain == "facebook.com" || $domain == "m.facebook.com" || $domain == "web.facebook.com" || $domain == "fb.watch" || $main_domain == "facebook.com") {
            $data = $this->Facebook->Data($url);
            return $data;
        } else if ($domain == "twitter.com" || $domain == "mobile.twitter.com") {
            $data = $this->Twitter->Data($req);
            return $data;
        } else if ($domain == "bitchute.com") {
            $data = $this->Bitchute->Data($req);
            return $data;
        } else if ($domain == "dailymotion.com" || $domain == "dai.ly") {
            $data = $this->Dailymotion->Data($req);
            return $data;
        } else if ((explode('.', $domain)[0] ?? "") == "espn") {
            $data = $this->Espn->Data($req);
            return $data;
        } else if ($domain == "imdb.com" || $domain == "m.imdb.com") {
            $data = $this->Imdb->Data($req);
            return $data;
        } else if ($domain == "imgur.com" || $domain == "0imgur.com") {
            $data = $this->Imgur->Data($req);
            return $data;
        } else if ($domain == "izlesene.com" || $domain == "izl.sn") {
            $data = $this->Izlesene->Data($req);
            return $data;
        } else if ($domain == "reddit.com") {
            $data = $this->Reddit->Data($req);
            return $data;
        } else if ($domain == "rumble.com") {
            $data = $this->Rumble->Data($req);
            return $data;
        } else {
            return response()->json([
                "statuscode" => 0,
                "msg" => "Check the url!!",
            ]);
        }
    }
}
