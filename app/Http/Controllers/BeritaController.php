<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BeritaController extends Controller
{
    public function index() {
        Carbon::setLocale('id');
        $data = Berita::where('published', true)->orderBy('updated_at', 'desc')->get()->map(function ($item) {
            $item->deskripsi_thumbnail = Str::limit($item->body, 120, '...');
            $item->updated_id = Carbon::parse($item->updated_at)->translatedFormat('d F Y');
            return $item;
        });
        return view('website.berita.index', [
            "title" => "Berita",
            "description" => null,
            "keywords" => null,
            "data" => $data,
        ]);
    }

    public function detail($slug) {
        $data = Berita::where('slug', $slug)->first();
        $others = Berita::where('published', true)
        ->where('slug', '!=', $slug)
        ->get();

        $title = $data->title;
        $processedBody = str_replace("\t", "", $data->body);
        $processedBody = str_replace("\n", "\n\n", $processedBody);
        Carbon::setLocale('id');
        $updated = Carbon::parse($data->updated_at)->translatedFormat('d F Y') . ', ' . Carbon::parse($data->updated_at)->format('H.i');
        $description = Str::limit($processedBody, 200, '...');
        $keyword = implode(", ", $data->tags);

        return view('website.berita.detail', [
            "title" => $title . " | Kegiatan Rutin",
            "description" => $description,
            "keywords" => $keyword,
            "data" => $data,
            "body" =>$processedBody,
            "updated" => $updated,
            "others" => $others,
        ]);
    }
}
