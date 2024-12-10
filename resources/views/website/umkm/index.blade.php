@extends('website.layouts.main')

@section('container')

{{-- <h1>{{ $title }}</h1> --}}
<div class="album px-2 py-3">
<div class="container">
<div class="umkm-desc px-4 pt-2 text-center">
    <h2 class="display-6 fw-bold">UMKM Padukuhan Sawahan</h2>
    <div class="col-lg-8 mx-auto">
        <p class="mb-4">Temukan berbagai produk unggulan UMKM Padukuhan Sawahan sebagai langkah mendukung perekonomian lokal dan pemberdayaan masyarakat.</p>
    </div>
    </div>
<div class="row justify-content-center">
<div class="col-md-6 col-sm-6">
<form action="/umkm">
    <div class="input-group mb-4">
        <input type="text" class="form-control" placeholder="Cari UMKM..." name="search" value="{{ request('search') }}">
        <button class="btn btn-dark" style="background-color: #052659; text-color: #f5f5f5" type="submit">Search</button>
      </div>
</form>
</div>
</div>
</div>
@if ($data->count())
<div class="container">
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
      @foreach ($data as $umkm)
      <div class="col">
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
                  <a href="/umkm/{{ $umkm->slug }}" class="stretched-link" style="font-size: 12px; font-weight: 500">Lihat Selengkapnya</a>
                </div>
              </div>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
@else
<h3 class="text-center">Tidak Ada Data UMKM</h3>
@endif
</div>
@endsection
