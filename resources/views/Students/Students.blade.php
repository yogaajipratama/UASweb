@extends('layouts.main')

@section('header')
    @include('partials.navbar')
@endsection

@section('content')

<div class="mt-3 d-flex justify-content-center">
    <div class="col-lg-8">
        <button type="button" class="btn btn-primary btn-lg mb-3">
            <a href="/Students/create" class="link-new">
                @lang('addNew')
            </a>     
        </button>
        @if(session()->has('del_success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          {{ session('del_success') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif  
        @if(session()->has('del_failed'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          {{ session('del_failed') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif  
        @if(session()->has('edit_success') )
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('edit_success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        
        <table class="table table-hover">
            <thead class="table-head">
                <tr>
                    <th scope="row" colspan="8" class="first-row table-title">
                        @lang('studentTable')
                    </th>
                </tr>
                <tr class="head-title">
                    <th scope="col" class="col-num">No.</th>
                    <th scope="col">@lang('nim')</th>
                    <th scope="col">@lang('name')</th>
                    <th scope="col">@lang('kdprodi')</th>
                    <th scope="col">@lang('action')</th>
                </tr>
            </thead>
            <tbody>
                @if ($students->count() > 0)
                    @foreach ( $students as $student )
                    <tr>
                        <td class="col-num">
                           {{ $loop->iteration }} 
                        </td>
                        <td class="col-nim">
                            {{ $student->nim }} 
                        </td>
                        <td class="col-nama">
                            {{ $student->name }} 
                        </td>                    
                        <td class="col-kdprodi">    
                            {{ $student->kdprodi }} 
                        </td>
                        <td class="col-act">
                            <form action="/Students/{{ $student->student_id }}" method="get" class="d-inline">
                                @csrf
                                <button class="badge bg-success border-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="currentColor" class="bi bi-file-earmark-text-fill" viewBox="0 0 16 16">
                                        <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zM4.5 9a.5.5 0 0 1 0-1h7a.5.5 0 0 1 0 1h-7zM4 10.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 1 0-1h4a.5.5 0 0 1 0 1h-4z"/>
                                      </svg>
                                </button>
                            </form>
                            <form action="/Students/{{ $student->student_id }}" method="post" class="d-inline">
                                @method('delete')
                                @csrf
                                <button class="badge bg-danger border-0" onclick="return confirm('@lang('delConfirm')')" >
                                    <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                        <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                                    </svg>
                                </button>
                            </form>
                            <form action="/Students/{{ $student->student_id }}/edit" method="get" class="d-inline">
                                @csrf
                                <button type="submit" class="badge bg-info border-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                    </svg>
                                </button>
                            </form>
                        </td>
                    </tr>               
                    @endforeach
                @else
                    <tr>
                        <th scope="row" colspan="5">@lang('noData')</th>
                    </tr>
                @endif
            </tbody>
    
        </table>

    </div>


</div>

@endsection

