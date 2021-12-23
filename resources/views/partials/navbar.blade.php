
<nav class="navbar navbar-expand-lg navbar-dark bg-dark-grey fixed-top">
    <div class="container">
      <a class="navbar-brand" href="/">@lang('kelompok')</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <div class="btn-group">
          <button class="btn btn-primary bg-dark-grey btn-sm dropdown-toggle btn-lang" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            @if(app()->getLocale() == 'id')
            <span class="flag-icon flag-icon-id"></span> ID
            @elseif (app()->getLocale() == 'en')
            <span class="flag-icon flag-icon-us"></span> EN
            @endif
            </button>
          <ul class="dropdown-menu" id="lang-menu">
            @if(app()->getLocale() == 'id')
            <li><a class="dropdown-item" href="{{ url('locale/en') }}"><span class="flag-icon flag-icon-us"></span> EN</a></li>
            @elseif (app()->getLocale() == 'en')
            <li><a class="dropdown-item" href="{{ url('locale/id') }}"><span class="flag-icon flag-icon-id"></span> ID</a></li>
            @endif
          </ul>
        </div>
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link {{ Request::is('/') ? 'active' :''}}" href="/">@lang('home')</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ Request::is('Students') ? 'active' :''}}" href="/Students">@lang('students')</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ Request::is('Departments') ? 'active' :''}}" href="/Departments">@lang('departments')</a>
          </li>          
        </ul> 

        @if(Request::is('login'))
          @include('partials.navbar_login')
        @elseif(Request::is('register'))
        @include('partials.navbar_register')
        @else
          @include('partials.navbar_default')
        @endif

      </div>
    </div>
</nav>
