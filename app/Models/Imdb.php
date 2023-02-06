<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Functions;

class Imdb extends Model
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
        $embed_url = "https://www.imdb.com/video/imdb/$video_id/imdb/embed";
        $embed_source = $this->Functions->url_get_contents($embed_url, $this->enable_proxies);
        $video_data = $this->Functions->get_string_between($embed_source, '<script class="imdb-player-data" type="text/imdb-video-player-json">', '</script>');
        $video_data = json_decode($video_data, true);
        $video["title"] = $this->Functions->get_string_between($embed_source, '<meta property="og:title" content="', '"/>');
        $video["source"] = "imdb";
        $video["thumbnail"] = $this->Functions->get_string_between($embed_source, '<meta property="og:image" content="', '">');
        $video["links"] = array();
        $video["source"] = "espn";

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

    function orderArray($arrayToOrder, $keys)
    {
        $ordered = array();
        foreach ($keys as $key) {
            if (isset($arrayToOrder[$key])) {
                $ordered[$key] = $arrayToOrder[$key];
            }
        }
        return $ordered;
    }

    function find_video_id($url)
    {
        preg_match('/vi\d{4,20}/', $url, $match);
        return $match[0];
    }
}
