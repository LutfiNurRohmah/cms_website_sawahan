<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\ContactInformation;
use App\Models\ProfilePadukuhan;
use App\Models\Umkm;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    public function index() {

        // Retrieve the first ContactInformation record
        $contactInformation = ContactInformation::first();
        $profil = ProfilePadukuhan::first();
        $lokasi = $profil->peta_lokasi;
        $sambutan = $profil->sambutan_dukuh;
        if ($sambutan) {
            $processedSambutan = str_replace("\t", "", $sambutan);
            $processedSambutan = str_replace("\n", "\n\n", $processedSambutan);
        }

        $berita = Berita::where('published', true)->orderBy('updated_at', 'desc')->limit(2)->get()->map(function ($item) {
            $item->deskripsi_thumbnail = Str::limit($item->body, 120, '...');
            $item->updated_id = Carbon::parse($item->updated_at)->translatedFormat('d F Y');
            return $item;
        });

        $query = Umkm::where('published', true)->inRandomOrder()->limit(3);
        $umkm = $query->get()->map(function ($item) {
            $item->deskripsi_thumbnail = Str::limit($item->description, 120, '...');
            return $item;
        });

        // Check if the record exists and retrieve the 'thumbnail' field
        $images = $contactInformation ? $contactInformation->thumbnail : [];

        return view('website.beranda.index', [
            "title" => "Beranda",
            "description" => "Selamat datang di Website Padukuhan Sawahan, Kelurahan Sidomoyo, Kecamatan Godean, Kabupaten Sleman, Provinsi Daerah Istimewa Yogyakarta. Website ini berisi informasi terkait padukuhan beripa profil, infografis kependudukan, umkm, potensi, berita, dan kegiatan yang ada di padukuhan.",
            "keywords" => 'website, desa, padukuhan, dusun, sawahan, yogyakarta, godean, sidomoyo, informasi',
            "images" => $images,
            "lokasi" => $lokasi,
            "sambutan" => $processedSambutan,
            "beritas" => $berita,
            "umkms" => $umkm,
        ]);
    }
}
