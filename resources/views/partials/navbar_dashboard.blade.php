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
      

      <ul class="navbar-nav ms-auto">
        <div class="avatar d-inline">
          <img src="{{ session('user')->avatar ?? '/assets/img/default.png' }}" alt="profile picture" width="25" height="25">
        </div>
        <li class="nav-item dropdown d-inline">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            {{ session('user')->username }}
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li>          
                <a class="dropdown-item" href="/">
                  <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-house-door-fill" viewBox="0 0 16 16">
                    <path d="M6.5 14.5v-3.505c0-.245.25-.495.5-.495h2c.25 0 .5.25.5.5v3.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5z"/>
                  </svg>
                  @lang('home')
                </a>            
            </li>
            <hr>
            <li>          
                <a class="dropdown-item" href="/logout">
                  <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z"/>
                    <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
                  </svg> 
                  @lang('logout')
                </a>            
            </li>
          </ul>
        </li>        
      </ul>

    </div>
  </div>
</nav>