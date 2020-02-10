<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top text-white">
  <div class="container">
    <div class="navbar-wrapper">
      {{-- <a class="navbar-brand" href="/">{{ $title }}</a> --}}
    </div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
      <span class="sr-only">Toggle navigation</span>
      <span class="navbar-toggler-icon icon-bar"></span>
      <span class="navbar-toggler-icon icon-bar"></span>
      <span class="navbar-toggler-icon icon-bar"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end">
      <ul class="navbar-nav">
        {{-- <li class="nav-item{{ $activePage == 'register' ? ' active' : '' }}">
          <a href="{{ route('register') }}" class="nav-link">
            <i class="material-icons">person_add</i> {{ __('Register') }}
          </a>
        </li> --}}
        <li class="nav-item{{ $activePage == 'guest-live' ? ' active' : '' }}">
          <a href="{{ route('guest.Live') }}" class="nav-link">
            <i class="material-icons">sports_kabaddi</i> {{ __('Live') }}
          </a>
        </li>
        <li class="nav-item{{ $activePage == 'guest-all' ? ' active' : '' }}">
          <a href="{{ route('guest.All') }}" class="nav-link">
            <i class="material-icons">event_available</i> {{ __('All Match') }}
          </a>
        </li>
        <li class="nav-item{{ $activePage == 'login' ? ' active' : '' }}">
          <a href="{{ route('login') }}" class="nav-link">
            <i class="material-icons">fingerprint</i> {{ __('Login') }}
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<!-- End Navbar -->