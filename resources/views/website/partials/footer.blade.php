<footer>
    <div class="container-fluid">
        <div style="display: flex; flex-direction: column; gap: 20px;">
            <!-- Section: Information -->
            <div>
                <h3 class="footer-title">
                    {{ $contact_information->name ?? 'Padukuhan Sawahan' }}
                   </h3>
                <p class="footer-address">
                    {{ $contact_information->address ?? 'Kelurahan Sidomoyo, Kecamatan Godean, Kabupaten Sleman, Provinsi Daerah Istimewa Yogyakarta' }}
                </p>
            </div>

            <div class="social-media-icons">
                @foreach ( $social_media as $sosmed )
                <a href="{{ $sosmed->link ?? '#' }}" class="icon">
                    <img class="sosmed-logo" src="/storage/{{ $sosmed->logo ?? '' }}" alt="{{ $sosmed->platform_name ?? '' }}">
                </a>
                @endforeach
            </div>

            <hr style="border: 4px solid white; margin: 0;">

            <!-- Section: Contact Info -->
            <div class="foo" style="display: flex; justify-content: space-between; flex-wrap: wrap;">
                <div class="footer-contact" style="flex: 4; min-width: 200px;">
                    @if (!empty($contact_information->phone))
                    <p style="margin: 5px 0;">
                        <img class="contact-logo" src="/img/phone-call.png" alt="Phone">
                        {{ $contact_information->phone }}
                    </p>
                    @endif
                    @if (!empty($contact_information->email))
                    <p style="margin: 5px 0;">
                        <img class="contact-logo" src="/img/mail.png" alt="Email">
                        {{ $contact_information->email }}
                    </p>
                    @endif
                </div>
                <div style="flex: 3; display: flex;">
                    <div class="footer-list">
                        <ul style="list-style: none; margin: 0, 10p; padding: 0; display: flex; flex-direction: column; gap: 5px;">
                            <li><a href="/" style="color: white; text-decoration: none;">Beranda</a></li>
                            <li><a href="/profil-padukuhan" style="color: white; text-decoration: none;">Profil</a></li>
                            <li><a href="/infografis" style="color: white; text-decoration: none;">Infografis</a></li>
                        </ul>
                    </div>
                    <div class="footer-list">
                        <ul style="list-style: none; margin: 0; padding: 0; display: flex; flex-direction: column; gap: 5px;">
                            <li><a href="/umkm" style="color: white; text-decoration: none;">UMKM</a></li>
                            <li><a href="/potensi-padukuhan" style="color: white; text-decoration: none;">Potensi</a></li>
                        </ul>
                    </div>
                    <div class="footer-list">
                        <ul style="list-style: none; margin: 0; padding: 0; display: flex; flex-direction: column; gap: 5px;">
                            <li><a href="/berita" style="color: white; text-decoration: none;">Berita</a></li>
                            <li><a href="/kegiatan" style="color: white; text-decoration: none;">Kegiatan</a></li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
</footer>
<div class="container-fluid copyright">
    <div class="col-md-12 text-center">
        <p class="mb-0">&copy; Copyright 2024 by KKNM 19348 UNY</p>
    </div>
</div>
