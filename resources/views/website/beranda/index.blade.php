@extends('website.layouts.main')

@section('container')

{{-- <h1>{{ $title }}</h1> --}}

<div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
    <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0, 16, 34, 0.7); z-index: 1;"></div>

    @if(count($images) > 1)
        <!-- Indicators -->
        <div class="carousel-indicators">
            @foreach($images as $index => $image)
                <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="{{ $index }}"
                    class="{{ $index === 0 ? 'active' : '' }}"
                    aria-current="{{ $index === 0 ? 'true' : '' }}"
                    aria-label="Slide {{ $index + 1 }}">
                </button>
            @endforeach
        </div>
    @endif

    @if (count($images) > 0)
    <!-- Carousel Items -->
    <div class="carousel-inner">
        @foreach($images as $index => $image)
            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                <img src="{{ asset('storage/' . $image) }}" class="d-block w-100" alt="Slide {{ $index + 1 }}">
                <div class="container">
                    <div class="carousel-caption" style="color:#f5f5f5;">
                        <h1 class="display-4 fst-italic">Selamat Datang</h1>
                        <h3 class="lead">Website Padukuhan Sawahan</h3>
                        <p class="lead" style="margin: 5px 0 0 0">Sidomoyo, Godean, Sleman, Daerah Istimewa Yogyakarta</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    @else
    <!-- Placeholder for No Images -->
    <div class="carousel-inner">
        <div class="carousel-item active">
            <div class="image-placeholder d-block w-100" style="background-color: #001022; height: 100%;"></div>
            <div class="container">
                <div class="carousel-caption" style="color:#f5f5f5;">
                    <h1 class="display-4 fst-italic">Selamat Datang</h1>
                    <h3 class="lead">Website Padukuhan Sawahan</h3>
                    <p class="lead" style="margin: 5px 0 0 0">Sidomoyo, Godean, Sleman, Daerah Istimewa Yogyakarta</p>
                </div>
            </div>
        </div>
    </div>
    @endif

    @if(count($images) > 1)
        <!-- Controls -->
        <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    @endif
</div>

@if (!empty($sambutan))
<div class="container px-4">
    <div class="sambutan row flex-lg-row-reverse align-items-center py-5">
        {{-- <div class="col-10 col-sm-7 col-lg-4 align-items-center col-auto d-none d-lg-block">
            <img class="rounded" src="img/image-placeholder.png" class="d-block mx-lg-auto img-fluid" alt="Thumbnail Infografis" width="100%" height="100%" loading="lazy" style="object-fit: cover; object-position: center;">
        </div> --}}
        <div class="col-lg-12">
            <h1>Sambutan Kepala Dukuh Sawahan</h1>
            <hr>
            <p>{!! str($sambutan)->markdown()->sanitizeHtml() !!}</p>
        </div>
    </div>
</div>
@endif

@if ($beritas->count())
<div class="b-example-divider"></div>
<div class="container position-relative">
    <div class="sambutan row pt-4 pb-5 my-2">
        <div class="px-4">
            <h1 class="mb-3">Berita Terkini Padukuhan Sawahan</h1>
            <div class="col-12 text-center">
                <a href="/berita" class="see-more btn btn-dark position-absolute" style="font-size: 14px; font-weight: 500; background-color: #052659">Lihat Berita Lainnya</a>
            </div>
            <hr>
        </div>
            @foreach ($beritas as $index => $berita)
                <div class="col-md-6">
                    <div class="row g-0 border rounded overflow-hidden flex-md-row mb-2 shadow-sm h-md-250 position-relative">
                        <div class="col p-4 d-flex flex-column position-static">
                        <h3 class="mb-0" style="font-size: 20px; font-weight: 600">{{ $berita->title }}</h3>
                        <div class="my-1 text-muted" style="font-size: 14px">{{ $berita->updated_id }}</div>
                        <p class="card-text mb-auto" style="font-size: 14px; font-weight: 400;">{{ $berita->deskripsi_thumbnail }}</p>
                        <a href="/berita/{{ $berita->slug }}" class="stretched-link" style="font-size: 14px;">Baca Selengkapnya...</a>
                        </div>
                        <div class="col-auto d-none d-lg-block">
                            <img width="200" height="250" src="{{ $berita->thumbnail ? asset('storage/' . $berita->thumbnail[0]) : asset('img/image-placeholder.png') }}" alt="{{ $berita->title }}" style="object-fit: cover; object-position: center;">
                        </div>
                    </div>
                </div>
            @endforeach

    </div>
</div>
@endif

@if ($umkms->count())
<div class="b-example-divider"></div>
<div class="container position-relative">
    <div class="sambutan row pt-4 pb-5 my-2">
        <div class="px-4">
            <h1 class="mb-3">UMKM Padukuhan Sawahan</h1>
            <div class="col-12 text-center">
                <a href="/umkm" class="see-more btn btn-dark position-absolute" style="font-size: 14px; font-weight: 500; background-color: #052659">Lihat UMKM Lainnya</a>
            </div>
            <hr>
        </div>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3 mt-2 pt-0">
            @foreach ($umkms as $umkm)
            <div class="col m-0">
                <div class="card shadow-sm" style="height: 100%;">
                <div class="position-absolute px-3 py-2 text-white rounded" style="background-color: rgba(5, 38, 89, 0.8); font-weight:600;">{{ $umkm->umkmCategory->name }}</div>
                <div class="px-4 pt-4">
                    <img class="card-img-top rounded" width="100%" height="225" src="{{ $umkm->thumbnail ? asset('storage/' . $umkm->thumbnail) : asset('img/image-placeholder.png') }}" alt="" style="object-fit: cover; object-position: center;
                    box-shadow: 0px 0px 1px 1px rgba(5, 38, 89, 0.2);
                    ">
                    <div class="umkm card-body px-2 py-3">
                    <h5 class="card-title">{{ $umkm->umkm_name }}</h5>
                        <p class="card-text">{{ $umkm->deskripsi_thumbnail }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                        <a href="/umkm/{{ $umkm->slug }}" class="stretched-link" style="font-size: 14px; font-weight: 500">Lihat Selengkapnya</a>
                        </div>
                    </div>
                </div>
                </div>
            </div>
            @endforeach
        </div>

    </div>
</div>
@endif

@if (!empty($lokasi))
<div class="b-example-divider"></div>
<div class="container px-4">
    <div class="row flex-lg-row align-items-center py-5">
        <div class="sambutan col-lg-5">
            <h1>Lokasi</h1>
            <p>Padukuhan Sawahan, Kelurahan Sidomoyo, Kecamatan Godean, Kabupaten Sleman, Provinsi Daerah Istimewa Yogyakarta</p>
        </div>
        <div class="col-12 col-sm-8 col-lg-7">
            {!! $lokasi !!}
        </div>
    </div>
</div>
@endif

@endsection
