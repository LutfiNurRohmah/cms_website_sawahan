@extends('website.layouts.main')

@section('container')

{{-- <h1>{{ $title }}</h1> --}}

<div class="container px-4">
    <div class="row flex-lg-row-reverse align-items-center py-5">
        <div class="col-10 col-sm-7 col-lg-3 align-items-center">
            <img class="rounded" src="img/infografis.png" class="d-block mx-lg-auto img-fluid" alt="Thumbnail Infografis" width="100%" loading="lazy">
        </div>
        <div class="col-lg-9">
            <h1>Infografis Kependudukan</h1>
            <p>{{ $description }}</p>
        </div>
    </div>
</div>
<div class="b-example-divider"></div>

<div class="container my-5">
    <h2 class="mb-4 pop-text">Jumlah Penduduk dan Kepala Keluarga</h2>
    <div class="tot-populasi row g-4">
        <div class="col-md-4">
                <div class="d-flex card-custom">
                    <div class="card-body">
                        <h5 class="card-title text-large">Total Penduduk</h5>
                        <p class="card-text">{{ $infografis[0] }}</p>
                    </div>
                    <div class="card-img">
                      <img src="img/tot_pop.png" alt="..." width="100%" height="100%">
                    </div>
                </div>
        </div>
        <div class="col-md-4">
                <div class="d-flex card-custom">
                    <div class="card-body">
                        <h5 class="card-title text-large">Total Kepala Keluarga</h5>
                        <p class="card-text">{{ $infografis[1] }}</p>
                    </div>
                    <div class="card-img">
                      <img src="img/tot_kk.png" alt="..." width="100%" height="100%">
                    </div>
                </div>
        </div>
        <div class="col-md-4">
                <div class="d-flex card-custom">
                    <div class="card-body">
                        <h5 class="card-title text-large">Total Perempuan</h5>
                        <p class="card-text">{{ $infografis[3] }}</p>
                    </div>
                    <div class="card-img">
                      <img src="img/tot_p.png" width="100%" height="100%">
                    </div>
                </div>
        </div>
        <div class="col-md-4">
                <div class="d-flex card-custom">
                    <div class="card-body">
                        <h5 class="card-title text-large">Total Laki-Laki</h5>
                        <p class="card-text">{{ $infografis[2] }}</p>
                    </div>
                    <div class="card-img">
                      <img src="img/tot_l.png" width="100%" height="100%">
                    </div>
                </div>
        </div>
    </div>
</div>
<div class="b-example-divider"></div>

<div class="container my-5">
    <h2 class="mb-4 pop-text">Persebaran Penduduk Berdasarkan Usia dan Jenis Kelamin</h2>
    <div class="d-flex flex-column align-items-center">
        <div class="col-md-8">
            <canvas id="populationPyramid"></canvas>
        </div>
    </div>
</div>

<div class="b-example-divider"></div>

<div class="container my-5">
    <h2 class="mb-4 pop-text">Persebaran Penduduk Berdasarkan Wilayah</h2>
    {{-- <div class="d-flex flex-column align-items-center"> --}}
        <div class="chart-populasi row align-items-center">
            <div class="col-md-5 px-5">
                <canvas id="populationChart"></canvas>
            </div>
            <div class="col-md-4">
                <h5>Keterangan:</h5>
                @foreach ($population[0] as $index => $label)
                    <p>{{ $label }} = {{ $population[1][$index] }} orang</p>
                @endforeach
            </div>
        </div>
    {{-- </div> --}}
</div>

<div class="b-example-divider"></div>

<div class="container my-5">
    <h2 class="mb-4 pop-text">Persebaran Penduduk Berdasarkan Pendidikan</h2>
    <div class="d-flex flex-column align-items-center">
        <div class="col-md-8">
            <canvas id="educationChart"></canvas>
        </div>
    </div>
</div>

<div class="b-example-divider"></div>

<div class="container my-5">
    <h2 class="mb-4 pop-text">Persebaran Penduduk Berdasarkan Pekerjaan</h2>
    <div class="d-flex flex-column align-items-center">
        <div class="col-md-8">
            <canvas id="jobChart"></canvas>
        </div>
    </div>
</div>

<div class="b-example-divider"></div>

{{-- <div class="container my-5">
    <h2 class="mb-4 pop-text">Persebaran Penduduk Berdasarkan Status Perkawinan</h2>
    <div class="tot-populasi row">
        <div class="col-md-4">
            <div class="d-flex card-custom">
                <div class="card-body">
                    <h5 class="card-title text-large">Kawin Tercatat</h5>
                    <p class="card-text">{{ $married[1][1] }}</p>
                </div>
                <div class="card-img">
                    <img src="img/kawin.png" alt="..." width="100%" height="100%">
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="d-flex card-custom">
                <div class="card-body">
                    <h5 class="card-title text-large">Kawin Tidak Tercatat</h5>
                    <p class="card-text">{{ $married[1][2] }}</p>
                </div>
                <div class="card-img">
                    <img src="img/kawin_tidak_tercatat.png" alt="..." width="100%" height="100%">
                </div>
            </div>
        </div>
        <div class="col-md-4">
                <div class="d-flex card-custom">
                    <div class="card-body">
                        <h5 class="card-title text-large">Cerai Mati</h5>
                        <p class="card-text">{{ $married[1][3] }}</p>
                    </div>
                    <div class="card-img">
                        <img src="img/cerai_mati.png" width="100%" height="100%">
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="d-flex card-custom">
                    <div class="card-body">
                        <h5 class="card-title text-large">Cerai Hidup</h5>
                        <p class="card-text">{{ $married[1][4] }}</p>
                    </div>
                    <div class="card-img">
                        <img src="img/cerai_hidup.png" width="100%" height="100%">
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                    <div class="d-flex card-custom">
                        <div class="card-body">
                            <h5 class="card-title text-large">Belum Kawin</h5>
                            <p class="card-text">{{ $married[1][0] }}</p>
                        </div>
                        <div class="card-img">
                          <img src="img/belum_kawin.png" width="100%" height="100%">
                        </div>
                    </div>
            </div>
    </div>
</div>
<div class="b-example-divider"></div> --}}

<div class="container my-5">
    <h2 class="mb-4 pop-text">Persebaran Penduduk Berdasarkan Agama</h2>
    <div class="tot-populasi row">
        <div class="col-md-3">
            <div class="d-flex card-custom">
                <div class="card-body">
                    <h5 class="card-title text-large">Islam</h5>
                    <p class="card-text">{{ $religion[1][0] }}</p>
                </div>
                <div class="card-img">
                    <img src="img/islam.png" alt="..." height="115">
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="d-flex card-custom">
                <div class="card-body">
                    <h5 class="card-title text-large">Kristen</h5>
                    <p class="card-text">{{ $religion[1][1] }}</p>
                </div>
                <div class="card-img">
                    <img src="img/kristen.png" alt="..." height="115">
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="d-flex card-custom">
                <div class="card-body">
                    <h5 class="card-title text-large">Katolik</h5>
                    <p class="card-text">{{ $religion[1][2] }}</p>
                </div>
                <div class="card-img">
                    <img src="img/katolik.png" alt="..." height="115">
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="d-flex card-custom">
                <div class="card-body">
                    <h5 class="card-title text-large">Hindu</h5>
                    <p class="card-text">{{ $religion[1][3] }}</p>
                </div>
                <div class="card-img">
                    <img src="img/hindu.png" alt="..." height="115">
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="d-flex card-custom">
                <div class="card-body">
                    <h5 class="card-title text-large">Budha</h5>
                    <p class="card-text">{{ $religion[1][4] }}</p>
                </div>
                <div class="card-img">
                    <img src="img/budha.png" alt="..." height="115">
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="d-flex card-custom">
                <div class="card-body">
                    <h5 class="card-title text-large">Konghucu</h5>
                    <p class="card-text">{{ $religion[1][5] }}</p>
                </div>
                <div class="card-img">
                    <img src="img/konghucu.png" alt="..." height="115">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var infografis = @json($agegender);
    var population = @json($population);
    var education = @json($education);
    var job = @json($job);
</script>
<script src="/js/populationpiramid.js"></script>
<script src="/js/population.js"></script>
<script src="/js/educationchart.js"></script>
<script src="/js/jobchart.js"></script>
@endsection
