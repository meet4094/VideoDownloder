<?php

namespace App\Http\Controllers;

use App\Models\Video;
use DataTables;

class VideoController extends Controller
{
    protected $Video;
    public function __construct()
    {
        $this->Video = new Video();
    }

    public function index()
    {
        return view('video');
    }

    public function Get_VideoData()
    {
        return DataTables::of(Video::query())
            ->addColumn('thumbnail', function ($row) {
                $meta = json_decode($row["download_meta"], true);
                $update_btn = "<img src='" . $meta["thumbnail"] . "' class='img img-thumbnail rounded h-25' onerror=\"this.src='https://cdn.nicheoffice.web.tr/image/5bE7J6oOjH.jpg';\">";
                return $update_btn;
            })
            ->addColumn('viedo_url', function ($row) {
                $meta = json_decode($row["download_meta"], true);
                $update_btn = "<a target='_blank' href='" . $meta["video_url"] . "'>Media Link <i class='fas fa-external-link-alt'></i></a>";
                return $update_btn;
            })
            ->addColumn('client_ip', function ($row) {
                $meta = json_decode($row["download_meta"], true);
                $update_btn = ($meta["client_ip"] ?? "Unknown");
                return $update_btn;
            })
            ->rawColumns(['thumbnail', 'viedo_url', 'client_ip'])
            ->make(true);
    }
}
