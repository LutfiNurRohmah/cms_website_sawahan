@extends('website.layouts.main')

@section('container')

{{-- <h1>{{ $title }}</h1> --}}

<div class="container">
    <div class="p-4 p-md-5 my-4 text-white rounded" style="position: relative; overflow: hidden;
        background-image: url('/img/potensi.png');
        background-size: cover; background-position: center;">

        <!-- Dark overlay -->
        <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0, 16, 34, 0.7); z-index: 1;"></div>

        <!-- Content -->
        <div class="col-md-8 px-0" style="position: relative; z-index: 2;">
            <h1 class="display-6 fst-italic">Potensi Padukuhan Sawahan</h1>
            <p class="my-3">Padukuhan Sawahan menyimpan beragam potensi yang menjadi fondasi untuk membangun kesejahteraan bersama. Kenali potensi kami dan jadilah bagian dari perjalanan menuju padukuhan yang lebih baik.</p>
        </div>
    </div>
@if ($data->count())
    <div class="row mb-2">
        @foreach ($data as $potensi)
        <div class="col-md-12">
            <div class="card row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-170 position-relative">
                <!-- Image Section with Padding -->
                <div class="col-auto d-none d-lg-block py-3 ps-3">
                    <img class="rounded" width="250" height="100%"
                         src="{{ $potensi->thumbnail ? asset('storage/' . $potensi->thumbnail[0]) : asset('img/image-placeholder.png') }}"
                         alt="{{ $potensi->category }}"
                         style="max-height: 170px; object-fit: cover; object-position: center; box-shadow: 0px 0px 1px 1px rgba(5, 38, 89, 0.2);">
                </div>

                <!-- Text Content Section -->
                <div class="col px-4 py-4 d-flex flex-column">
                    <h3 class="mb-0">{{ $potensi->category }}</h3>
                    <div class="mb-1 text-muted">{{ $potensi->updated_id }}</div>
                    <p class="card-text mb-auto" style="font-size: 12px; font-weight: 500">{{ $potensi->deskripsi_thumbnail }}</p>
                    <a href="/potensi-padukuhan/{{ $potensi->slug }}" class="stretched-link mt-2" style="font-size: 14px; font-weight: 500">Lihat Selengkapnya</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@else
    <h3 class="text-center pb-3">Belum Ada Data Potensi</h3>
@endif
</div>

@endsection
