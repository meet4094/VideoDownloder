<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Functions;

class Espn extends Model
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
        // api pass download url
        $url = $req->download_url;
        $devicesid = $req->device_id;
        //api pass download url title name 
        $media_id = $this->find_media_id($url);
        $api_url = "http://cdn.espn.com/core/video/clip/_/id/" . $media_id . "?xhr=1&device=desktop&country=us&lang=en&region=us&site=espn&edition-host=espn.com&one-site=true&site-type=full";
        $rest_api = $this->Functions->url_get_contents($api_url, $this->enable_proxies);
        $rest_api = json_decode($rest_api, true);
        $video["title"] = $rest_api["meta"]["title"];
        $video["source"] = "dailymotion";
        $video["thumbnail"] = $rest_api["meta"]["image"];
        $video["duration"] = gmdate(($rest_api["content"]["duration"] > 3600 ? "H:i:s" : "i:s"), $rest_api["content"]["duration"]);
        $video["links"] = array();
        $video["source"] = "espn";

        $downloadMeta = array(
            'title' => $video['title'],
            'thumbnail' => $video['thumbnail'],
            'video_url' => $url,
            'duration' => $video["duration"],
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

    function find_media_id($url)
    {
        if (preg_match("/(id=\d{5,20}|id\/\d{5,20}|video\/\d{5,20})/", $url, $match)) {
            $video_id = (int)filter_var($match[0], FILTER_SANITIZE_NUMBER_INT);
            return $video_id;
        }
    }
}
