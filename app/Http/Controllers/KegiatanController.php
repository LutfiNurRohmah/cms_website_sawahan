<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KegiatanController extends Controller
{
    public function index(){
        $data = Activity::where('published', true)->get()->map(function ($item) {
            $item->deskripsi_thumbnail = Str::limit($item->description, 130, '...');
            return $item;
        });
        return view('website.kegiatan.index', [
            "title" => "Kegiatan Rutin",
            "description" => null,
            "keywords" => null,
            "data" => $data,
        ]);
    }

    public function detail($slug) {
        $data = Activity::where('slug', $slug)->first();
        $others = Activity::where('published', true)
        ->where('slug', '!=', $slug)
        ->get();

        $title = $data->name;
        $processedBody = str_replace("\t", "", $data->description);
        $processedBody = str_replace("\n", "\n\n", $processedBody);
        Carbon::setLocale('id');
        $updated = Carbon::parse($data->updated_at)->translatedFormat('d F Y') . ' pukul ' . Carbon::parse($data->updated_at)->format('H.i');
        $description = Str::limit($processedBody, 200, '...');
        $keyword = implode(", ", $data->tags);
        return view('website.kegiatan.detail', [
            "title" => $title . " | Kegiatan Rutin",
            "description" => $description,
            "keywords" => $keyword,
            "data" => $data,
            "body" => $processedBody,
            "updated" => $updated,
            "others" => $others,
        ]);
    }
}
