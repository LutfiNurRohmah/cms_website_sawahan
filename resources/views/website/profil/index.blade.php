@extends('website.layouts.main')

@section('container')

{{-- <h1>{{ $title }}</h1> --}}
@if (!empty($profil->deskripsi) ||
!empty($profil->sejarah) ||
!empty($profil->visi) ||
!empty($profil->misi) ||
!empty($profil->thumbnail_deskripsi) ||
!empty($profil->thumbnail_sejarah) ||
!empty($profil->struktur_pemerintahan))
@if (!empty($profil['deskripsi']))
<div class="container px-4">
    <div class="row flex-lg-row align-items-center py-5">
        @if (!empty($profil['thumbnail_deskripsi']))
            <div class="col-10 col-sm-8 col-lg-3">
                <img src="storage/{{ $profil->thumbnail_deskripsi }}" class="d-block mx-lg-auto img-fluid" alt="Thumbnail Deskripsi" width="100%" loading="lazy">
            </div>
            <div class="col-lg-9">
                <h1>Deskripsi Padukuhan</h1>
                <p>{!! str($prosessed[0])->markdown()->sanitizeHtml() !!}</p>
            </div>
        @else
        <div>
            <h1>Deskripsi Padukuhan</h1>
            <p>{!! str($prosessed[0])->markdown()->sanitizeHtml() !!}</p>
        </div>
        @endif
    </div>
</div>
<div class="b-example-divider"></div>
@endif

@if (!empty($profil['sejarah']))
<div class="container px-4">
    <div class="row flex-lg-row-reverse align-items-center py-5">
        @if (!empty($profil['thumbnail_sejarah']))
        <div class="col-10 col-sm-8 col-lg-3">
            <img src="storage/{{ $profil->thumbnail_sejarah }}" class="d-block mx-lg-auto img-fluid" alt="Bootstrap Themes" width="100%" loading="lazy">
        </div>
        <div class="col-lg-9">
            <h1>Sejarah Padukuhan</h1>
            <p>{!! str($prosessed[1])->markdown()->sanitizeHtml() !!}</p>
        </div>
        @else
        <div>
            <h1>Sejarah Padukuhan</h1>
            <p>{!! str($prosessed[1])->markdown()->sanitizeHtml() !!}</p>
        </div>
        @endif
    </div>
</div>
<div class="b-example-divider"></div>
@endif

@if (!empty($profil['visi']) || !empty($profil['misi']))
    <div class="container px-4">
        <div class="row flex-lg-row-reverse align-items-center py-5">
            @if (!empty($profil['visi']))
            <h1>Visi</h1>
            <p>{!! str($prosessed[2])->markdown()->sanitizeHtml() !!}</p>
            @endif
            @if (!empty($profil['misi']))
            <h1>Misi</h1>
            <p>{!! str($prosessed[3])->markdown()->sanitizeHtml() !!}</p>
            @endif
        </div>
    </div>
    <div class="b-example-divider"></div>
@endif
@if (!empty($profil['struktur_pemerintahan']))
    <div class="container px-4">
        <div class="row flex-lg-row-reverse align-items-center py-5">
          <div class="col-lg-12">
            <h1>Struktur Pemerintahan</h1>
            <img src="storage/{{ $profil->struktur_pemerintahan }}" class="d-block mx-lg-auto img-fluid" alt="Struktur Pemerintahan" width="80%" loading="lazy">
          </div>
        </div>
    </div>
    <div class="b-example-divider"></div>
@endif
@if (!empty($profil['peta_lokasi']))
<div class="container px-4">
    <div class="row flex-lg-row align-items-center py-5">
        <div class="col-lg-5">
            <h1>Lokasi</h1>
            <p>Padukuhan Sawahan, Kelurahan Sidomoyo, Kecamatan Godean, Kabupaten Sleman, Provinsi Daerah Istimewa Yogyakarta</p>
        </div>
        <div class="peta col-12 col-sm-12 col-lg-7">
            {!! $profil->peta_lokasi !!}
        </div>
    </div>
</div>
@endif
@else
<div class="container mt-4">
    <h3>Data belum tersedia</h3>
</div>
@endif
@endsection
