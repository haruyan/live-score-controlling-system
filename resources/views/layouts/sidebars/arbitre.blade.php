<ul class="nav">
    <li class="nav-item{{ ($activePage == 'match-all' || $activePage == 'match-live') ? ' active' : '' }}">
    <a class="nav-link collapsed" data-toggle="collapse" href="#collapse2" aria-expanded="false">
        <i class="material-icons">sports_kabaddi</i>
        <p>{{ __('Match') }}
        <b class="caret"></b>
        </p>
    </a>
    <div class="collapse show" id="collapse2">
        <ul class="nav">
        <li class="nav-item{{ $activePage == 'match-all' ? ' active' : '' }}">
            <a class="nav-link" href="{{ route('match.index') }}">
            <span class="sidebar-mini"> &nbsp; </span>
            <span class="sidebar-normal">{{ __('All') }} </span>
            </a>
        </li>
        <li class="nav-item{{ $activePage == 'match-live' ? ' active' : '' }}">
            <a class="nav-link" href="{{ route('match.liveIndex') }}">
            <span class="sidebar-mini"> &nbsp; </span>
            <span class="sidebar-normal"> {{ __('Live') }} </span>
            </a>
        </li>
        </ul>
    </div>
    </li>
    <li class="nav-item">
    <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
        <i class="material-icons">exit_to_app</i>
        <p>{{ __('Logout') }}</p>
    </a>
    </li>
</ul>