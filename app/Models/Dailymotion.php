<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Functions;

class Dailymotion extends Model
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
        $video_id = $this->find_video_id($url);
        $web_page = $this->Functions->url_get_contents("https://www.dailymotion.com/player/metadata/video/" . $video_id, $this->enable_proxies);
        $data = json_decode($web_page, true);

        $video["title"] = $data["title"];
        $video["source"] = "dailymotion";
        $video["thumbnail"] = end($data["posters"]);
        $video["duration"] = $this->Functions->format_seconds($data["duration"]);
        $video["links"] = array();
        $video["source"] = "dailymotion";

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
    
    function find_video_id($url)
    {
        $domain = str_ireplace("www.", "", parse_url($url, PHP_URL_HOST));
        switch (true) {
            case ($domain == "dai.ly"):
                $video_id = str_replace('https://dai.ly/', "", $url);
                $video_id = str_replace('/', "", $video_id);
                return $video_id;
                break;
            case ($domain == "dailymotion.com"):
                $url_parts = parse_url($url);
                $path_arr = explode("/", $url_parts['path']);
                $video_id = $path_arr[2];
                if ($video_id == "video" && count($path_arr) === 4) {
                    $video_id = $path_arr[3];
                }
                return $video_id;
                break;
            default:
                return "";
                break;
        }
    }
}
