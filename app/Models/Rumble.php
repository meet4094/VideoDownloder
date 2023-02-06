<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Functions;

class Rumble extends Model
{
    use HasFactory;

    protected $Functions;
    protected $enable_proxies = false;

    public function __construct()
    {
        $this->Functions = new Functions();
    }

    public function Data($req)
    {
        $url = $req->download_url;
        $devicesid = $req->device_id;

        $web_page = $this->Functions->url_get_contents($url, $this->enable_proxies);
        $video_id = $this->Functions->get_string_between($web_page, '"video":"', '"');
        if (empty($video_id)) {
            return false;
        }
        $video_info = $this->get_video_info($video_id);
        $video["title"] = $video_info["title"];
        $video["source"] = "rumble";
        $video["duration"] = $this->Functions->format_seconds($video_info["duration"]);
        $video["thumbnail"] = $video_info["i"];
        $video["links"] = array();

        $downloadMeta = array(
            'title' => $video['title'],
            'thumbnail' => $video['thumbnail'],
            'video_url' => $url,
            'client_ip' => '::1',
        );
        $insertedfild = array(
            'download_meta' => json_encode($downloadMeta),
            'download_links' => '',
            'download_source' => $video["source"],
            'devices_id' => $devicesid
        );
        return response()->json(['data' => $insertedfild]);
    }

    private function get_video_info($video_id)
    {
        $_REQUEST_USER_AGENT = "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.105 Safari/537.36";

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://rumble.com/embedJS/u3/?request=video&v=" . $video_id,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_USERAGENT => $_REQUEST_USER_AGENT
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        return json_decode($response, true);
    }
}
