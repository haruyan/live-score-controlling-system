<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top text-white">
  <div class="container">
    <div class="navbar-wrapper">
      <a class="navbar-brand" href="javascript:void()">{{ $title }}</a>
    </div>
    <div class="collapse navbar-collapse justify-content-end">
      <ul class="navbar-nav">
        {{-- <li class="nav-item{{ $activePage == 'register' ? ' active' : '' }}">
          <a href="{{ route('register') }}" class="nav-link">
            <i class="material-icons">person_add</i> {{ __('Register') }}
          </a>
        </li> --}}
        @auth
          <li class="nav-item">
            <a href="{{ route('match.liveIndex') }}" class="nav-link">
              <i class="material-icons">arrow_left</i> {{ __('Back') }}
            </a>
          </li>
        @else
          <li class="nav-item">
            <a href="{{ route('guest.Live') }}" class="nav-link">
              <i class="material-icons">arrow_left</i> {{ __('Back') }}
            </a>
          </li>
        @endauth
      </ul>
    </div>
  </div>
</nav>
<!-- End Navbar -->