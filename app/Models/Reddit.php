<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Functions;

class Reddit extends Model
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
        $video["source"] = "reddit";
        $video["title"] = $this->Functions->get_string_between($web_page, "<title>", "</title>");
        $video["thumbnail"] = $this->Functions->get_string_between($web_page, '<meta property="og:image" content="', '"/>');
    
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
