<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Functions;

class Instagram extends Model
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

        $url = $url = strtok($url, '?');
        if (substr($url, -1) != '/') {
            $url .= "/";
        }
        $this->post_page = $this->Functions->url_get_contents($url . "embed/captioned/", $this->enable_proxies);
        if (strpos($this->post_page, "WatchOnInstagram")) {
            return $this->media_info_legacy($url);
        }
        preg_match_all('/window.__additionalDataLoaded\(\'extra\',(.*?)\);<\/script>/', $this->post_page, $matches);
        if (!isset($matches[1][0]) || empty($matches[1][0])) {
            return false;
        }
        $data = json_decode($matches[1][0], true);
        $video["links"] = array();
        if (!isset($data["shortcode_media"])) {
            preg_match_all('/<img class="EmbeddedMediaImage" alt=".*" src="(.*?)"/', $this->post_page, $matches);
            if (isset($matches[1][0]) != "") {
                $video["title"] = $this->Functions->get_string_between($this->post_page, '<img class="EmbeddedMediaImage" alt="', '"');
                $video["source"] = "instagram";
                $video["thumbnail"] = $matches[1][0];
                $media_url = html_entity_decode($matches[1][0]);
                $bytes = $this->Functions->get_file_size($media_url, $this->enable_proxies, false);
                array_push($video["links"], [
                    "url" => $media_url,
                    "type" => "jpg",
                    "bytes" => $bytes,
                    "size" => $this->Functions->format_size($bytes),
                    "quality" => "HD",
                    "mute" => 0
                ]);
            } else {
                return false;
            }
        } else {
            $video["title"] = $data["shortcode_media"]["edge_media_to_caption"]["edges"][0]["node"]["text"] ?? "";
            if (empty($video["title"]) && isset($data["shortcode_media"]["owner"]["username"]) != "") {
                $video["title"] = "Instagram Post from " . $data["shortcode_media"]["owner"]["username"];
            } else {
                $video["title"] = "Instagram Post";
            }
            //$video["data"] = $data;
            $video["source"] = "instagram";
            $video["thumbnail"] = $data["shortcode_media"]["display_resources"][0]["src"];
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
