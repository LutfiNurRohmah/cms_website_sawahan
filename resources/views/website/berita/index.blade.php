@extends('website.layouts.main')

@section('container')

{{-- <h1>{{ $title }}</h1> --}}
<div class="container">
    @if ($data->count())

    @if (!empty($data) && count($data) > 0)

    <div class="p-4 p-md-5 my-4 text-white rounded" style="position: relative; overflow: hidden;
    background-image: url('{{ !empty($data[0]->thumbnail) ? asset('storage/' . $data[0]->thumbnail[0]) : '#001022' }}');
    background-size: cover; background-position: center;">

    <!-- Dark overlay -->
    <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0, 16, 34, 0.7); z-index: 1;"></div>

    <!-- Content -->
    <div class="col-md-8 px-0" style="position: relative; z-index: 2;">
        <h1 class="display-5 fst-italic">{{ $data[0]->title }}</h1>
        <p class="lead my-3">{{ $data[0]->deskripsi_thumbnail }}</p>
        <p class="lead mb-0"><a href="/berita/{{ $data[0]->slug }}" class="stretched-link text-white fw-bold">Baca Selengkapnya...</a></p>
    </div>
    </div>

    @endif
    @if (!empty($data) && count($data) > 1)
      <div class="row mb-2">
        @foreach ($data as $index => $berita)
            @if ($index !== 0)
            <div class="col-md-6">
              <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
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
            @endif
        @endforeach
      </div>
      @endif
    @else
    <h3 class="text-center py-3">Belum Ada Berita</h3>
    @endif

</div>
@endsection
