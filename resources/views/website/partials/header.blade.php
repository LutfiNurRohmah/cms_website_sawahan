<header>
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom sticky-top">
        <div class="container-fluid mx-3">
          <a class="navbar-brand" href="/">
            <span class="navbar-logo fs-4">SAWAHAN</span>
          </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
              <li class="nav-item">
                <a class="nav-link {{ ($title === "Beranda") ? 'active' : '' }}" href="/">Beranda</a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ ($title === "Profil Padukuhan") ? 'active' : '' }}" href="/profil-padukuhan">Profil</a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ ($title === "Infografis") ? 'active' : '' }}" href="/infografis">Infografis</a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ ($title === "UMKM") ? 'active' : '' }}" href="/umkm">UMKM</a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ ($title === "Potensi Padukuhan") ? 'active' : '' }}" href="/potensi-padukuhan">Potensi</a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ ($title === "Berita") ? 'active' : '' }}" href="/berita">Berita</a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ ($title === "Kegiatan Rutin") ? 'active' : '' }}" href="/kegiatan">Kegiatan</a>
              </li>

            </ul>
          </div>
        </div>
    </nav>
</header>

