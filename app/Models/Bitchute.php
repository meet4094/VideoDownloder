<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Functions;

class Bitchute extends Model
{
    use HasFactory;

    protected $Functions;

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
        $enable_proxies = false;
        $web_page = $this->Functions->url_get_contents($url, $enable_proxies);
        $video['title'] = $this->Functions->get_string_between($web_page, "<title>", "</title>");
        $video['thumbnail'] = $this->Functions->get_string_between($web_page, 'poster="', '"');
        $video["duration"] = $this->Functions->get_string_between($web_page, '<span class="video-duration">', '</span>');
        $video["links"] = array();
        $video["source"] = "bitchute";

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
}
