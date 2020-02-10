<div class="wrapper ">
  {{-- @include('layouts.navbars.sidebar') --}}
  <div class="sidebar" data-color="green" data-background-color="green" data-image="{{ asset('material') }}/img/sidebar-1.jpg">
    <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"
  
        Tip 2: you can also add an image using data-image tag
    -->
    <div class="logo">
      <a href="/home" class="simple-text logo-normal">
        PETANQUE LIVE
      </a>
    </div>
    <div class="sidebar-wrapper">
        @if(Auth::user()->role == 'admin')
          @include('layouts.sidebars.admin')
        @elseif(Auth::user()->role == 'arbitre')
          @include('layouts.sidebars.arbitre')
        @endif
    </div>
  </div>
  <div class="main-panel" id="app">
    @include('layouts.navbars.auth')
    @yield('content')
  </div>
</div>