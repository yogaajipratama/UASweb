@extends('layouts.main')

@section('header')
    @include('partials.navbar')
@endsection

@section('content')
<div class="row justify-content-center mt-3">
    <div class="col-lg-5 ">
      @if(session()->has('reg_success') )
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('reg_success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      @endif
      @if(session()->has('reg_failed'))
      <div class="alert 'alert-danger' alert-dismissible fade show" role="alert">
        {{ session('reg_failed') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      @endif
      <main class="form-signin">
          <form action="/register" method="post">
              @csrf
            <h1 class="h3 mb-3 fw-normal text-center">@lang('registerForm')</h1>
            <div class="form-floating">
              <div class="radio-role d-flex justify-content-start">
                  <div class="radio-wrapper">
                      <input type="Radio" name="role" value="2"
                          class="r-bullet" required><span>@lang('lecturer')</span>
                  </div>
                  <div class="radio-wrapper">
                      <input type="Radio" name="role" value="3"
                          class="r-bullet"required><span>@lang('student')</span>
                  </div>                  
              </div>
              @error('role')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="form-floating">
              <input type="text" name="username" class="form-control rounded-top @error('username') is-invalid @enderror" id="username" placeholder="username" maxlength="20" value="{{ old('username') }}" required>
              <label for="username">@lang('username')</label>
              @error('username')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="form-floating">
              <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="name@example.com"  value="{{ old('email') }}" required>
              <label for="email">@lang('emailAddress')</label>
              @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="form-floating">
              <input type="password" name="password" class="form-control rounded-bottom mb-3 @error('password') is-invalid @enderror" id="password" placeholder="Password" required>
              <label for="password">@lang('password')</label>
              @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <button class="w-100 btn btn-lg btn-primary" type="submit">@lang('register')</button>
          </form>
          <small class="d-block text-center mt-3">@lang('alreadyLog') <a href="/login">@lang('signin')!</a></small>
      </main>
    </div>
</div>
@endsection