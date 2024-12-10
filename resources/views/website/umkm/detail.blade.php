@extends('website.layouts.main')

@section('container')

{{-- <h1>{{ $title }}</h1> --}}
<div class="container-fluid">
<div class="row">
    <div class="detail col-md-9">
        <div class="row align-items-center pb-3" style="display: flex; flex-wrap: wrap; justify-content: center;">
                <div class="col-12 col-md-8 col-lg-5 p-4">
                        <img src="{{ $umkm->thumbnail ? asset('storage/' . $umkm->thumbnail) : asset('img/image-placeholder.png') }}" class="d-block mx-lg-auto img-fluid rounded" alt="Thumbnail Deskripsi" loading="lazy" style="max-height: 320px; box-shadow: 0px 0px 2px 2px rgba(5, 38, 89, 0.2);">
                </div>
                <div class="col-lg-7">
                    <h2 style="font-weight: 600">{{ $umkm->umkm_name }}</h2>
                    <div class="table-responsive">
                        <table class="table align-middle">
                            <tr>
                                <th>Kategori</th>
                                <td>:</td>
                                <td colspan="2">{{ $umkm->umkmCategory->name }}</td>
                            </tr>
                            <tr>
                                <th>Pemilik</th>
                                <td>:</td>
                                <td colspan="2">{{ $umkm->owner }}</td>
                            </tr>
                            @if (!empty($umkm->address))
                            <tr>
                                <th>Alamat</th>
                                <td>:</td>
                                <td>
                                    @if (!empty($umkm->maps))
                                    <a href="{{ $umkm->maps ? $umkm->maps : '#' }}" target="_blank"><img src="/img/maps.png" alt="Map Alamat UMKM" height="40px"></a>
                                    @endif
                                </td>
                                <td>{{ $umkm->address }}</td>
                            </tr>
                            @endif
                            @if (!empty($umkm->contact))
                            <tr>
                                <th>Kontak</th>
                                <td>:</td>
                                <td colspan="2"><a href="{{ $umkm->contact ? 'https://wa.me/' .$umkm->contact : '#' }}" target="_blank"><img src="/img/contact.png" alt="" height="35px"></a></td>
                            </tr>
                            @endif
                            @if (!empty($accounts) && count($accounts) > 0)
                            <tr>
                                <th>Social Media Ecommerce</th>
                                <td>:</td>
                                <td colspan="2">
                                    @foreach ($accounts as $account)
                                        <a href="{{ $account->link ? $account->link : '#' }}" target="_blank"><img height="40px" src="/img/instagram.png" alt=""></a>
                                    @endforeach
                                </td>
                            </tr>
                            @endif
                        </table>
                    </div>
                </div>
        </div>
        <div class="row">
            @if (!empty($body))
            <hr>
            <div class="mb-3">
                <h5 style="font-weight: 600">Deskripsi Tambahan</h5>
                <p>{!! str($body)->markdown()->sanitizeHtml() !!}</p>
            </div>
            @endif
            @if (!empty($products) && count($products) > 0)
            <hr>
            <div class="">
                <h5 style="font-weight: 600; padding: 0 0 10px 0">Katalog Produk UMKM</h5>

                <div class="row row-cols-2 row-cols-sm-2 row-cols-md-3 g-4 mb-1">
                    @foreach ($products as $product)
                    <div class="col col-md-3 col-sm-6">
                      <div class="card-product card shadow-sm" style="height: 100%;" data-description="{{ $product->prosessed_deskripsi }}" data-price="{{ $product->price }}"
                        data-image="{{ $product->thumbnail ? asset('storage/' . $product->thumbnail) : asset('img/image-placeholder.png') }}">
                        <img class="card-img-top" width="100%" height="180" src="{{ $product->thumbnail ? asset('storage/' . $product->thumbnail) : asset('img/image-placeholder.png') }}" alt="" style="object-fit: cover; object-position: center;">
                        <div class="card-body">
                        <h6 class="card-title" style="font-weight:700;margin:0; padding:0">{{ $product->name }}</h6>
                          <div class="d-flex justify-content-between align-items-center">
                            <p style="padding: 0; margin:0; font-size: 16px; font-weight:600">Rp{{ $product->price }}</p>
                          </div>
                        </div>
                      </div>
                    </div>
                    @endforeach
                    <div class="toast-container position-fixed top-50 start-50 translate-middle p-5">
                        <div id="productToast" class="toast p-3" role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="false" style="background-color: #f5f5f5;">
                          <div class="toast-header">
                            <img id="toastImage" src="" class="rounded me-2" alt="Product Image" style="width: 100px; height: 100px; object-fit: cover;">
                            <h5 id="toastTitle" class="me-auto mx-2">Product Name</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                          </div>
                          <div id="toastBody" class="toast-body">
                            <p id="toastDescription">Product description goes here.</p>
                            <h5 id="toastPrice" style="font-weight: 700;">$0.00</h5>
                          </div>
                        </div>
                      </div>
                  </div>


            </div>
            @endif
        </div>
    </div>
    <div class="col-md-3 bg-light" >
        <div class="position-sticky" style="top: 4rem;">
          <div class="p-4"  >
            <h5 class="mb-3" style="font-weight: 600">UMKM Lainnya</h5>
            <ul class="list-unstyled">
              @foreach ($others as $other)
                  <li class="d-flex align-items-center mb-3">
                      <img src="{{ $other->thumbnail ? asset('storage/' . $other->thumbnail) : asset('img/image-placeholder.png') }}"
                           alt="{{ $other->umkm_name }}"
                           style="width: 35px; height: 35px; object-fit: cover; border-radius: 5px; margin-right: 10px;">
                      <div>
                          <a href="/umkm/{{ $other->slug }}" style="font-size:16px"><h6 class="">{{ $other->umkm_name }}</h6></a>
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

@section('script')
<script>
    // Select all product cards
    document.querySelectorAll('.card-product').forEach(card => {
      card.addEventListener('click', function () {
        // Get product data
        const title = this.querySelector('.card-title').textContent;
        const description = this.dataset.description || 'No description available';
        const price = this.dataset.price || 'Price not available';
        const imageSrc = this.dataset.image || '/img/image-placeholder.png';

        // Set toast content
        document.getElementById('toastTitle').textContent = title;
        document.getElementById('toastDescription').textContent = description;
        document.getElementById('toastPrice').textContent = price;
        document.getElementById('toastImage').src = imageSrc;

        // Show the toast
        const toastElement = document.getElementById('productToast');
        const toast = new bootstrap.Toast(toastElement);
        toast.show();
      });
    });
  </script>


@endsection
