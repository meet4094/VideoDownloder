<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Functions;

class Twitter extends Model
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

        $video["links"] = array();
        $video["source"] = "twitter";

        //api pass download url title name 
        $enable_proxies = false;
        $web_page = $this->Functions->url_get_contents($url, $enable_proxies);
        $video['title'] = $this->Functions->get_string_between($web_page, "<title>", "</title>");
        // $tweet_data = $this->tweet_data($this->find_id($url));
        // $video['title'] = $this->clean_title($tweet_data["full_text"]);

        //api pass download url Thumbnail image
        $video['thumbnail'] = $this->Functions->get_string_between($web_page, 'property="og:image" content="', '">');
        // $video['thumbnail'] = $tweet_data["entities"]["media"][0]["media_url_https"];

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


    function clean_title($string)
    {
        $title = preg_replace('/(https?:\/\/([-\w\.]+[-\w])+(:\d+)?(\/([\w\/_\.#-]*(\?\S+)?[^\.\s])?).*$)|(\n)/', '', $string);
        return !empty($title) ? $title : $string;
    }

    function tweet_data($tweet_id)
    {
        return $this->codebird_request("1.1/statuses/show/$tweet_id.json?tweet_mode=extended&include_entities=true");
    }

    function codebird_request($path)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->website_url . "/assets/js/codebird-cors-proxy/" . $path,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "x-authorization: Bearer " . $this->access_token
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            return false;
        } else {
            return json_decode($response, true);
        }
    }

    function find_id($url)
    {
        $domain = str_ireplace("www.", "", parse_url($url, PHP_URL_HOST));
        $last_char = substr($url, -1);
        if ($last_char == "/") {
            $url = substr($url, 0, -1);
        }
        switch ($domain) {
            case "twitter.com":
                $arr = explode("/", $url);
                return end($arr);
                break;
            case "mobile.twitter.com":
                $arr = explode("/", $url);
                return end($arr);
                break;
            default:
                $arr = explode("/", $url);
                return end($arr);
                break;
        }
    }
}
