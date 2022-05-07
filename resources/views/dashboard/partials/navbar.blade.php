<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">

    {{-- awal dari hak akses admin --}}
    @if (auth()->user()->role == 'admin')
    <a class="navbar-brand" href="/dashboard">Admin</a>
    @else
    <a class="navbar-brand" href="/dashboard">Resepsionis</a>
    @endif
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">

      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        @can('admin')

        <li class="nav-item">
          <a class="nav-link {{ ($active === 'Tipe Kamar') ? 'active' : '' }}" aria-current="page"
            href="/dashboard/tipeKamar">Tipe Kamar</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ ($active === 'Fasilitas Kamar') ? 'active' : '' }}"
            href="/dashboard/fasilitasKamar">Fasilitas Kamar</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ ($active === 'Fasilitas Hotel') ? 'active' : '' }}"
            href="/dashboard/fasilitasHotel">Fasilitas Hotel</a>
        </li>
        @endcan
        {{-- akhir dari hak akses admin --}}

        {{-- awal dari hak akses resepsionis --}}
        @can('resepsionis')
        <li class="nav-item">
          <a class="nav-link {{ ($active === 'Data Reservasi') ? 'active' : '' }}" aria-current="page"
            href="/dashboard/reservasi">Data Reservasi</a>
        </li>
        @endcan
        {{-- akhir dari hak akses resepsionis --}}
      </ul>


      <ul class="navbar-nav ms-auto">
        @auth
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
            aria-expanded="false">
            Welcome back, {{ auth()->user()->username }}
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">

            <form action="/logout" method="POST">
              @csrf
              <button type="submit" class="dropdown-item">Logout</button>
            </form>
        </li>
      </ul>
      </li>
      @endauth
      </ul>
    </div>
  </div>
</nav>