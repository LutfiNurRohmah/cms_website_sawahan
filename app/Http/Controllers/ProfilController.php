<?php

namespace App\Http\Controllers;

use App\Models\ProfilePadukuhan;
use Illuminate\Http\Request;

class ProfilController extends Controller
{
    public function index() {
        $profilPadukuhan = ProfilePadukuhan::first();

        // Initialize meta description string
        $metaDescription = null;

        // Concatenate the specific fields if they are not null
        if ($profilPadukuhan) {
            $processedDeskripsi = str_replace("\t", "", $profilPadukuhan->deskripsi);
            $processedSejarah = str_replace("\t", "", $profilPadukuhan->sejarah);
            $processedVisi = str_replace("\t", "", $profilPadukuhan->visi);
            $processedMisi = str_replace("\t", "", $profilPadukuhan->misi);
            $processedDeskripsi = str_replace("\n", "\n\n", $processedDeskripsi);
            $processedSejarah = str_replace("\n", "\n\n", $processedSejarah);
            $processedVisi = str_replace("\n", "\n\n", $processedVisi);
            $processedMisi = str_replace("\n", "\n\n", $processedMisi);
            $metaDescription = implode(' ', [
                $processedDeskripsi,
                $processedSejarah,
            ]);

            // Optionally trim the result to avoid extra spaces
            $metaDescription = trim($metaDescription);
        }

        return view('website.profil.index', [
            "title" => "Profil Padukuhan",
            "description" => $metaDescription,
            "keywords" => "deskripsi, sejarah, visi, misi, struktur pemerintahan, profil, padukuhan, sawahan, lokasi",
            "profil" => $profilPadukuhan,
            "prosessed" => [$processedDeskripsi, $processedSejarah, $processedVisi, $processedMisi]
        ]);
    }
}
