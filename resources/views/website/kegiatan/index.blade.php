@extends('website.layouts.main')

@section('container')

{{-- <h1>{{ $title }}</h1> --}}

<div class="container">

<div class="p-4 p-md-5 my-4 text-white rounded" style="position: relative; overflow: hidden;
    background-image: url('/img/kegiatan.png');
    background-size: cover; background-position: center;">

    <!-- Dark overlay -->
    <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0, 16, 34, 0.7); z-index: 1;"></div>

    <!-- Content -->
    <div class="col-md-12 px-0" style="position: relative; z-index: 2;">
        <h1 class="display-6 fst-italic">Kegiatan Rutin Padukuhan Sawahan</h1>
        <p class="col-md-8 my-3">Temukan berbagai informasi menarik tentang aktivitas rutin yang mempererat kebersamaan warga, melestarikan tradisi, dan mendukung kemajuan Padukuhan Sawahan.</p>
    </div>
</div>

@if ($data->count())
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
        @foreach ($data as $kegiatan)
        <div class="col mb-3">
          <div class="card shadow-sm" style="height: 100%;">
            <img class="card-img-top" width="100%" height="180" src="{{ $kegiatan->thumbnail ? asset('/storage/' . $kegiatan->thumbnail[0]) : asset('/img/image-placeholder.png') }}" alt="{{ $kegiatan->name }}" style="object-fit: cover; object-position: center;">
            <div class="card-body py-3">
            <h5 class="card-title mb-0" style="font-size: 22px; font-weight: 600">{{ $kegiatan->name }}</h5>
              <p class="card-text" style="font-size: 12px; font-weight: 400; margin: 3px 0;">{{ $kegiatan->deskripsi_thumbnail }}</p>
              <div class="d-flex justify-content-between align-items-center">
                <a href="/kegiatan/{{ $kegiatan->slug }}" class="stretched-link" style="font-size: 14px; font-weight: 500">Lihat Selengkapnya</a>
              </div>
            </div>
          </div>
        </div>
        @endforeach
      </div>
@else
<h3 class="text-center pb-3">Belum Ada Data Kegiatan</h3>
@endif
    </div>
@endsection
