@extends('layouts.main')

@section('header')
    @include('partials.navbar')
@endsection

@section('content')
<div class="row justify-content-center mt-3">
    <div class="col-lg-6 ">
      @if(session()->has('edit_failed'))
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
          {{ session('edit_failed') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      @endif
        <main class="form-student-add">
            <form action="/Students/{{ $student->student_id }}" method="post">
              @method('put')  
              @csrf
              <h1 class="h3 mb-3 fw-normal text-center">@lang('studentUpdate')</h1>
              <div class="form-floating">
                <div class="radio-sex d-flex justify-content-start">
                    <div class="radio-wrapper">
                        <input type="Radio" name="sex" value="0"
                            class="r-bullet" required {{ ($student->sex == 0) ? 'checked' : '' }} ><span>@lang('male')</span>
                    </div>
                    <div class="radio-wrapper">
                        <input type="Radio" name="sex" value="1"
                            class="r-bullet"required {{ ($student->sex == 1) ? 'checked' : '' }}><span>@lang('female')</span>
                    </div>
                    <div class="radio-wrapper">
                        <input type="Radio" name="sex" value="2"
                            class="r-bullet" required {{ ($student->sex == 2) ? 'checked' : '' }}><span>@lang('other')</span>
                    </div>
                </div>
                @error('sex')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="form-floating">
                <input type="text" maxlength="10" minlength="5" name="nim" class="input-form form-control @error('nim') is-invalid @enderror" id="nim" placeholder="1234567891"  value="{{ old('nim',$student->nim) }}" required>
                <label for="nim">@lang('nim')</label>
                @error('nim')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="form-floating">
                <input type="text" name="name" maxlength="100" class="input-form form-control @error('name') is-invalid @enderror" id="name" placeholder="name" maxlength="20" value="{{ old('name',$student->name) }}" required>
                <label for="name">@lang('studentName')</label>
                @error('name')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div> 
              
              <div class="form-floating">
                <input type="email" name="email" class="input-form form-control @error('email') is-invalid @enderror" id="email" placeholder="name@example.com"  value="{{ old('email',$student->email) }}" required>
                <label for="email">@lang('emailAddress')</label>
                @error('email')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>       
        
              <div class="form-floating">
                <input type="text" name="tlp" maxlength="15" class="input-form form-control @error('tlp') is-invalid @enderror" id="tlp" placeholder="tlp" value="{{ old('tlp',$student->tlp) }}"  required>
                <label for="tlp">@lang('phone')</label>
                @error('tlp')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              
              <div class="form-floating">
                <select name="kdprodi" class="input-form kprodi">
                    <option selected value> @lang('selectProdi')</option>
                    @foreach ( $departments as $dept )
                        <option value="{{ $dept->kdprodi }}"  {{ ($student->kdprodi == $dept->kdprodi) ? 'selected' : '' }} >{{ $dept->dept_name }} | {{ $dept->kdprodi }}</option>
                    @endforeach
                </select>
                <label for="kdprodi" class="label-prodi">@lang('kdprodi')</label>
                @error('kdprodi')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>


              <button class="w-100 btn btn-lg btn-primary" type="submit">@lang('save')</button>
            </form>
            
        </main>
    </div>
</div>
@endsection