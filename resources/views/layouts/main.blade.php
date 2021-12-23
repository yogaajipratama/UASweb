<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@lang('kelompok')  {{ isset($title) ? " | " .$title : '' }}</title>
    
      <link rel="icon" href="laravel-ico.svg" type="image/svg+xml">
    {{-- <link rel="icon" href="/assets/ico/bootstrap/collection-fill.svg"> --}}
    
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/flag-icons.min.css">
    <link rel="stylesheet" href="/assets/css/style.css">
    
    <script src="/assets/js/bootstrap.min.js"></script>
    <script src="/assets/js/popper.min.js"></script>
    <script src="/assets/js/jquery-3.6.0.slim.min.js"></script>
    
    
    @if(isset($links))
        @foreach($links as $l)
            {!! $l !!}
        @endforeach
    @endif 

</head>
<body>
    
    <div class="header">
        @yield('header')
    </div>

    <div class="container content">
        @yield('content')
    </div>
    
    <div class="container">
        <div class='mt-5 mb-3 footer d-flex justify-content-center'>
            <p class="text-center text-muted d-inline me-2">&copy; {{ (now()->year == '2021') ? (now()->year) : '2021-'(now()->year)}}</p>
            <a clsss="d-inline" href='/reset'>   @lang('reset')</a>
        </div>
    </div>

</body>
</html>