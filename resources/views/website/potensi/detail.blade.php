@extends('website.layouts.main')

@section('container')

{{-- <h1>{{ $title }}</h1> --}}
<div class="container-fluid">
<div class="row">
    <div class="detail col-md-9">
      <article class="blog-post mb-2">
        <h2 class="blog-post-title">{{ $data->category }}</h2>
        <p class="blog-post-meta">Diunggah pada {{ $updated }}</p>
        @if (count($data->thumbnail))
        <div id="myCarousel" class="carousel slide mb-4" data-bs-ride="carousel">
            @if(count($data->thumbnail) > 1)
                <!-- Indicators -->
                <div class="carousel-indicators">
                    @foreach($data->thumbnail as $index => $image)
                        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="{{ $index }}"
                            class="{{ $index === 0 ? 'active' : '' }}"
                            aria-current="{{ $index === 0 ? 'true' : '' }}"
                            aria-label="Slide {{ $index + 1 }}">
                        </button>
                    @endforeach
                </div>
            @endif

            <!-- Carousel Items -->
            <div class="carousel-inner">
                @foreach($data->thumbnail as $index => $image)
                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                        <img src="/storage/{{ $image }}" class="d-block w-100" alt="Slide {{ $index + 1 }}" style="height: 100%; object-fit: cover; object-position: center;">
                    </div>
                @endforeach
            </div>

            @if(count($data->thumbnail) > 1)
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
        @endif
        <p>{!! str($body)->markdown()->sanitizeHtml() !!}</p>
      </article>


    </div>

    <div class="col-md-3 bg-light" >
      <div class="position-sticky" style="top: 4rem;">
        <div class="p-4"  >
          <h5 class="mb-3" style="font-weight: 600">Potensi Lainnya</h5>
          <ul class="list-unstyled">
            @foreach ($others as $other)
                <li class="d-flex align-items-center mb-3">
                    <img src="{{ $other->thumbnail ? asset('storage/' . $other->thumbnail[0]) : asset('img/image-placeholder.png') }}"
                         alt="{{ $other->category }}"
                         style="width: 40px; height: 40px; object-fit: cover; border-radius: 5px; margin-right: 10px;">
                    <div>
                        <a href="/potensi-padukuhan/{{ $other->slug }}" style="text-decoration: none;"><h6 class="mb-1"><i>{{ $other->category }}</i></h6></a>
                    </div>
                </li>
            @endforeach
        </ul>
        </div>

      </div>
    </div>

</div>
</div>
  @endsection
