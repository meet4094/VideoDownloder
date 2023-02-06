<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use PDO;

class Functions extends Model
{
    use HasFactory;

    function format_seconds($seconds)
    {
        return gmdate(($seconds > 3600 ? "H:i:s" : "i:s"), $seconds);
    }

    function get_main_domain($host)
    {
        $main_host = strtolower(trim($host));
        $count = substr_count($main_host, '.');
        if ($count === 2) {
            if (strlen(explode('.', $main_host)[1]) > 3) $main_host = explode('.', $main_host, 2)[1];
        } else if ($count > 2) {
            $main_host = $this->get_main_domain(explode('.', $main_host, 2)[1]);
        }
        return $main_host;
    }

    function get_string_between($string, $start, $end)
    {
        $string = ' ' . $string;
        $ini = strpos($string, $start);
        if ($ini == 0) return '';
        $ini += strlen($start);
        $len = strpos($string, $end, $ini) - $ini;
        return substr($string, $ini, $len);
    }

    function url_get_contents($url, $enable_proxies = false)
    {
        $_REQUEST_USER_AGENT = "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.105 Safari/537.36";
        $cookie_file_name = 'token' . ".txt";
        $cookie_file = join(DIRECTORY_SEPARATOR, [sys_get_temp_dir(), $cookie_file_name]);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_USERAGENT, $_REQUEST_USER_AGENT);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        if ($enable_proxies) {
            if (!empty($_SESSION["proxy"] ?? null)) {
                $proxy = $_SESSION["proxy"];
            } else {
                $proxy = $this->get_proxy();
                $_SESSION["proxy"] = $proxy;
            }
            curl_setopt($ch, CURLOPT_PROXY, $proxy['ip'] . ":" . $proxy['port']);
            curl_setopt($ch, CURLOPT_PROXYTYPE, $this->get_proxy_type($proxy['type']));
            if (!empty($proxy['username']) && !empty($proxy['password'])) {
                curl_setopt($ch, CURLOPT_PROXYUSERPWD, $proxy['username'] . ":" . $proxy['password']);
            }
            $chunkSize = 1000000;
            curl_setopt($ch, CURLOPT_TIMEOUT, (int)ceil(3 * (round($chunkSize / 1048576, 2) / (1 / 8))));
        }
        curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file);
        if (file_exists($cookie_file)) {
            curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file);
        }
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }

    function get_proxy()
    {
        $proxy = DB::find_random_proxy();
        if (!empty($_SESSION["proxy"]["ip"] ?? null)) {
            return $_SESSION["proxy"];
        } else if (!empty($proxy["ip"])) {
            $_SESSION["proxy"] = $proxy;
            return $proxy;
        } else {
            return false;
        }
    }

    function get_proxy_type($id)
    {
        switch ($id) {
            case 0:
                $type = "HTTP";
                break;
            case 1:
                $type = "HTTPs";
                break;
            case 2:
                $type = "SOCKS4";
                break;
            case 3:
                $type = "SOCKS5";
                break;
            default:
                $type = "unknown";
                break;
        }
        return $type;
    }

    public static $db;
    public static function connect($dsn, $username, $password)
    {
        self::$db = new PDO($dsn, $username, $password);
        self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        self::$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    }
    public static function find_random_proxy()
    {
        $stmt = self::$db->prepare("SELECT * FROM proxies WHERE banned=0 ORDER BY RAND() LIMIT 1");
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt = self::$db->prepare("UPDATE proxies SET usage_count = usage_count + 1 WHERE ip =:ip");
        $stmt->bindParam(':ip', $row["ip"], PDO::PARAM_STR);
        $stmt->execute();
        if (!empty($row)) {
            return $row;
        } else {
            return false;
        }
    }

    function format_size($bytes)
    {
        switch ($bytes) {
            case $bytes < 1024:
                $size = $bytes . " B";
                break;
            case $bytes < 1048576:
                $size = round($bytes / 1024, 2) . " KB";
                break;
            case $bytes < 1073741824:
                $size = round($bytes / 1048576, 2) . " MB";
                break;
            case $bytes < 1099511627776:
                $size = round($bytes / 1073741824, 2) . " GB";
                break;
        }
        if (!empty($size)) {
            return $size;
        } else {
            return "";
        }
    }
}
