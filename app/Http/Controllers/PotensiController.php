<?php

namespace App\Http\Controllers;

use App\Models\PotensiPadukuhan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PotensiController extends Controller
{
    public function index() {
        Carbon::setLocale('id');
        $data = PotensiPadukuhan::where('published', true)->get()->map(function ($item) {
            $item->deskripsi_thumbnail = Str::limit($item->description, 320, '...');
            $item->updated_id = Carbon::parse($item->updated_at)->translatedFormat('d F Y');
            return $item;
        });

        $description = "Padukuhan Sawahan menyimpan beragam potensi yang menjadi fondasi untuk membangun kesejahteraan bersama. Kenali potensi kami dan jadilah bagian dari perjalanan menuju padukuhan yang lebih baik.";
        $keyword = 'potensi, potensi desa, potensi sawahan, perkembangan, potensi padukuhan sawahan, potensi sawahan sidomoyo, bidang';
        return view('website.potensi.index', [
            "title" => "Potensi Padukuhan",
            "description" => $description,
            "keywords" => $keyword,
            "data" => $data,
        ]);
    }

    public function detail($slug) {
        $data = PotensiPadukuhan::where('slug', $slug)->first();
        $others = PotensiPadukuhan::where('published', true)
        ->where('slug', '!=', $slug)
        ->get();

        $title = $data->name;
        $processedBody = str_replace("\t", "", $data->description);
        $processedBody = str_replace("\n", "\n\n", $processedBody);
        Carbon::setLocale('id');
        $updated = Carbon::parse($data->updated_at)->translatedFormat('d F Y');
        $description = Str::limit($processedBody, 200, '...');
        $keyword = implode(", ", $data->tags);
        return view('website.potensi.detail', [
            "title" => $title . " | Potensi Padukuhan",
            "description" => $description,
            "keywords" => $keyword,
            "data" => $data,
            "body" => $processedBody,
            "updated" => $updated,
            "others" => $others,
        ]);
    }
}
