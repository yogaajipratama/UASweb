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
    @if(session()->has('forbidAdminPage'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      {{ session('forbidAdminPage') }}
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
            <div class="col-lg-6">
                <table class="table table-hover">
                    <thead class="table-head">                    
                        <tr class="head-title">
                            <th scope="col" class="col-num">No.</th>
                            <th scope="col">@lang('defaultUsr')</th>
                            <th scope="col">@lang('defaultPwd')</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="col-num">1</td>
                            <td>SuperAdmin</td>
                            <td>SuperAdmin</td>
                        </tr>
                        <tr>
                            <td class="col-num">2</td>
                            <td>Admin</td>
                            <td>Admin</td>
                        </tr>
                        <tr>
                            <td class="col-num">3</td>
                            <td>UserDosen</td>
                            <td>UserDosen</td>
                        </tr>
                        <tr>
                            <td class="col-num">4</td>
                            <td>UserMahasiswa</td>
                            <td>UserMahasiswa</td>
                        </tr>
                    </tbody>       
                </table>            
            </div>
        </li>
    </ol>



</div>





@endsection

