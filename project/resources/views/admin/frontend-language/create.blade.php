@extends('layouts.admin')

@section('title', __('Add Website Language'))
    
@section('content')

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-3">
                <div class="card-body">
                  <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-style2 mb-0">
                      <li class="breadcrumb-item {{ Request::is('admin/dashboard') ? 'active' : '' }}">
                        <a href="{{ route('admin.dashboard.index')}}">{{__('Dashboard')}}</a>
                      </li>
                      <li class="breadcrumb-item {{ Request::is('admin/frontendlanguage/index') ? 'active' : '' }}">
                        <a href="{{ route('admin.frontendlanguage.index')}}">{{__('Manage Frontend Language')}}</a>
                      </li>
                      <li class="breadcrumb-item {{ Request::is('admin/frontendlanguage/create') ? 'active' : '' }}">
                        <a href="{{ route('admin.frontendlanguage.create')}}">{{__('Add Website Language')}}</a>
                      </li>
                    </ol>
                  </nav>
                </div>
              </div>

            <div class="card mb-4">
                <div class="card-header d-flex justify-content-center mt-3">
                    <h3 class="d-flex justify-content-center text-primary">{{__('Add Language')}}</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.frontendlanguage.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        @include('partials.message.error')
                        @include('partials.message.success')
                        @include('partials.message.message')

                        <div class="row">
                            <div class="col-md-2">
                                <label class="form-label" for="language">{{__('Lamguage Name')}}</label>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <input type="text" name="language" class="form-control" id="name" required placeholder="{{__('Enter Language Name')}}">
                                </div>
                            </div>
                        </div>
                        
                        <div class="language mt-5">
                            <div class="row">
                                <div class="col-md-5">
                                    <input type="text" name="keys[]" class="form-control" id="mailLanguage" required placeholder="{{__('Enter Main Language')}}">
                                </div>
                                <div class="col-md-5">
                                    <input type="text" name="values[]" class="form-control" id="name" required placeholder="{{__('Enter Translate Language')}}">
                                </div>
                            </div>
                            <br>
                        </div>

                        <div class="d-flex justify-content-right">
                            <button type="button" class="btn btn-icon btn-outline-primary float-center" id="addBtn">
                                <i class='bx bx-plus-medical'></i>
                            </button>
                        </div>

                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary mt-3">{{__('Submit')}}</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('js')

<script>
    $(document).ready(function(){
        let html = `<div class="languageField"><div class="row ">
                        <div class="col-md-5">
                            <input type="text" name="keys[]" class="form-control" id="mailLanguage" required placeholder="{{__('Enter Main Language')}}">
                        </div>
                        <div class="col-md-5">
                            <input type="text" name="values[]" class="form-control" id="name" required placeholder="{{__('Enter Translate Language')}}">
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-icon btn-outline-danger removeBtn">
                                <i class='bx bx-minus' ></i>
                            </button>
                        </div>
                    </div><br></div>`;

        $('#addBtn').click(function(){
            $('.language').append(html);
        });

        $("body").on("click",".removeBtn",function(){   
          $(this).parents(".languageField").remove();
          $(this).find('br').remove();
        //   $('br').remove();
      });  

        // $('.removeBtn').click(function(){
        //     alert('ok')
        // });
    });

</script>
    
@endpush