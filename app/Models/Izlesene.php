<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Functions;

class Izlesene extends Model
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
        if (preg_match_all('/videoObj\s*=\s*({.+?})\s*;\s*\n/', $web_page, $match)) {
            $player_json = $match[1][0];
            $player_data = json_decode($player_json, true);
            $video["title"] = $player_data["videoTitle"];
            $video["source"] = "izlesene";
            $video["thumbnail"] = $player_data["posterURL"];
            $video["duration"] = $this->Functions->format_seconds($player_data["duration"] / 1000);
        }

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
}
