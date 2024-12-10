<?php

namespace App\Http\Controllers;

use App\Models\AgeGender;
use App\Models\PopulationDistribution;
use App\Models\TotalPopulation;
use Illuminate\Http\Request;

class InfografisController extends Controller
{
    public function index() {

        $data = AgeGender::select('age_group', 'total_male', 'total_female')->get();
        $labels = $data->pluck('age_group')->toArray();
        $maleData = $data->pluck('total_male')->map(fn($value) => -$value)->toArray();
        $femaleData = $data->pluck('total_female')->toArray();

        $data2 = TotalPopulation::select('rt_name', 'total_population')->get();
        $labels2 = $data2->pluck('rt_name')->toArray();
        $values2 = $data2->pluck('total_population')->toArray();

        $tot_population = TotalPopulation::sum('total_population');
        $tot_kk = TotalPopulation::sum('total_kk');
        $tot_male = TotalPopulation::sum('total_male');
        $tot_female = TotalPopulation::sum('total_female');

        $educationData = PopulationDistribution::where('category', 'Pendidikan')->get();
        $labels3 = $educationData->pluck('sub_category')->toArray(); // Sub-categories as labels
        $values3 = $educationData->pluck('total')->toArray();

        $jobData = PopulationDistribution::where('category', 'Pekerjaan')->get();
        $labels4 = $jobData->pluck('sub_category')->toArray(); // Sub-categories as labels
        $values4 = $jobData->pluck('total')->toArray();

        // $marriedData = PopulationDistribution::where('category', 'Status Perkawinan')->get();
        // $labels5 = $marriedData->pluck('sub_category')->toArray(); // Sub-categories as labels
        // $values5 = $marriedData->pluck('total')->toArray();

        $religionData = PopulationDistribution::where('category', 'Agama')->get();
        $labels6 = $religionData->pluck('sub_category')->toArray(); // Sub-categories as labels
        $values6 = $religionData->pluck('total')->toArray();

        return view('website.infografis.index', [
            "title" => "Infografis",
            "description" => "Infografis ini memberikan gambaran visual mengenai data kependudukan di wilayah Padukuhan Sawahan. Informasi mencakup jumlah penduduk, distribusi usia, rasio gender, tingkat pendidikan, dan mata pencaharian masyarakat. Infografis ini bertujuan untuk memudahkan masyarakat dan pihak terkait dalam memahami karakteristik demografi serta potensi yang ada di wilayah ini.",
            "keywords" => "infografis, penduduk, kependudukan, sawahan, persebaran penduduk, distribusi usia, pendidikan, pekerjaan, mata pencaharian, data, jumlah penduduk, ringkasan",
            "agegender" => [$labels, $maleData, $femaleData],
            "population" => [$labels2, $values2],
            "infografis" => [$tot_population, $tot_kk, $tot_male, $tot_female],
            "education" => [$labels3, $values3],
            "job" => [$labels4, $values4],
            // "married" => [$labels5, $values5],
            "religion" => [$labels6, $values6],
        ]);
    }
}
