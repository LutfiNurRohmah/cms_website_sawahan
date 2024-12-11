<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Umkm;
use App\Models\UmkmAccount;
use App\Models\UmkmProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UmkmController extends Controller
{
    public function index() {

        $query = Umkm::where('published', true);

        if (request('search')) {
            $query->where('umkm_name', 'like', '%' . request('search') . '%')
                  ->orWhere('description', 'like', '%' . request('search') . '%')
                  ->orWhereHas('umkmCategory', function ($q) {
                      $q->where('name', 'like', '%' . request('search') . '%');
                  });
        }

        $data = $query->get()->map(function ($item) {
            $item->deskripsi_thumbnail = Str::limit($item->description, 120, '...');
            return $item;
        });

        $description = "Temukan berbagai produk unggulan UMKM Padukuhan Sawahan sebagai langkah mendukung perekonomian lokal dan pemberdayaan masyarakat.";
        $keyword = 'umkm, umkm padukuhan sawahan, umkm sawahan sidomoyo, produk, industri, ekonomi, usaha mikro, unggulan, usaha lokal, lokal, pemberdayaan masyarakat, warga sawahan, wirausaha';

        return view('website.umkm.index', [
            "title" => "UMKM",
            "description" => $description,
            "keywords" => $keyword,
            "data" => $data,
        ]);
    }

    public function detail($slug) {
        $data = Umkm::where('slug', $slug)->first();
        $title = $data->umkm_name;

        $processedBody = str_replace("\t", "", $data->description);
        $processedBody = str_replace("\n", "\n\n", $processedBody);

        $product = UmkmProduct::where('umkm_id', $data->id)->get()->map(function ($item) {
            $item->prosessed_deskripsi = str_replace("\t", "", $item->description);
            return $item;
        });;
        $account = UmkmAccount::where('umkm_id', $data->id)->get();

        $others = Umkm::where('published', true)
        ->where('slug', '!=', $slug)
        ->inRandomOrder() // Randomize the order
        ->limit(10)
        ->get();

        $description = Str::limit($processedBody, 200, '...');
        $keyword = implode(", ", $data->tags);

        return view('website.umkm.detail', [
            "title" => $title . " | UMKM",
            "umkm" => $data,
            "body" => $processedBody,
            "products" => $product,
            "accounts" => $account,
            "others" => $others,
            "description" => $description,
            "keywords" => $keyword,
        ]);
    }
}
