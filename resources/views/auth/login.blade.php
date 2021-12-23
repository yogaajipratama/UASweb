@extends('layouts.main')

@section('header')
    @include('partials.navbar')
@endsection

@section('content')
<div class="row justify-content-center mt-3">
    <div class="col-lg-5 ">
      @if(session()->has('logError'))
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('logError') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      @endif  
      @if(session()->has('forbidPage'))
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('forbidPage') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      @endif  
      <main class="form-signin">
            <form action="/login" method="post">
              @csrf
                <h1 class="h3 mb-3 fw-normal text-center">@lang('signin_msg')</h1>
          
              <div class="form-floating">
                <input type="text" name="email_user" class="form-control @error('email_user') is-invalid @enderror" id="email" placeholder="name@example.com" value="{{ old('email_user') }}" autofocus required> 
                <label for="email_user">@lang('emailOrUser')</label>
                @error('email_user')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="form-floating">
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Password"  required>
                <label for="password">@lang('password')</label>
                <div class="eye-container">
                  <div class="eye-show show">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                      <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                      <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                    </svg>
                  </div>
                  <div class="eye-hide hide">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-eye-slash-fill" viewBox="0 0 16 16">
                      <path d="m10.79 12.912-1.614-1.615a3.5 3.5 0 0 1-4.474-4.474l-2.06-2.06C.938 6.278 0 8 0 8s3 5.5 8 5.5a7.029 7.029 0 0 0 2.79-.588zM5.21 3.088A7.028 7.028 0 0 1 8 2.5c5 0 8 5.5 8 5.5s-.939 1.721-2.641 3.238l-2.062-2.062a3.5 3.5 0 0 0-4.474-4.474L5.21 3.089z"/>
                      <path d="M5.525 7.646a2.5 2.5 0 0 0 2.829 2.829l-2.83-2.829zm4.95.708-2.829-2.83a2.5 2.5 0 0 1 2.829 2.829zm3.171 6-12-12 .708-.708 12 12-.708.708z"/>
                    </svg>
                  </div>
                </div>
                @error('password')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
          
              
              <button class="w-100 btn btn-lg btn-primary" type="submit">@lang('signin')</button>
            </form>
            <small class="d-block text-center mt-3">@lang('notRegister') <a href="/register">@lang('registerNow')!</a></small>
        </main>
    </div>
</div>  
@endsection