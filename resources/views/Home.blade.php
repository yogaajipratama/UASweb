@extends('layouts.main')

@section('header')
    @include('partials.navbar')
@endsection

@section('content')

<div class="landing mt-3">
    @if(session()->has('logSuccess'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ session('logSuccess') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif  

    <h1 class="text-center fw-bold">@lang('webTitle')</h1>
    <p>
        {{-- @auth
            @lang('log-as') <span class="userlog">{{ auth()->user()->username }}</span> 
        @else
            @lang('notLog')
        @endauth --}}
        @if(session()->has('user'))
            @lang('log-as') <span class="userlog">{{ session('user')->username }}</span> 
        @else
            @lang('notLog')
        @endif
           
    </p>
    <hr>
    <p>@lang('mainBrag')</p>
    <hr>
    <p>@lang('team')</p>
    <ol class="bold-list">
        <li>UTOROADJI TUNGGUL ANGGORO (2020081077)</li>
        <li>YOGA AJI PRATAMA (2020081078)</li>
        <li>JHON ERIKSON (2020081073)</li>
    </ol>
    <hr>
    <p>@lang('fitur')</p>
    <ol class="bold-list">
        <li>@lang('dualLang')</li>
        <li>@lang('logSystem')</li>
        <li>@lang('combineStyle')</li>
        <li>@lang('usingJS')</li>
        <li>@lang('crud')</li>
        <li>
            @lang('dbOntheFly')
            <ul>
                <li>@lang('defaultUsr')</li> 
                <li>@lang('defaultPwd')</li> 
            </ul>
        </li>
    </ol>



</div>





@endsection

