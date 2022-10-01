@extends('layouts.admin')

@section('title', __('Manage Category'))
    
@section('content')

<div class="container mt-3">
    <div class="row">
        <div class="col-md-3">

        </div>

        <div class="col-md-6">

          <div class="card mb-3">
            <div class="card-body">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-style2 mb-0">
                  <li class="breadcrumb-item {{ Request::is('admin/dashboard') ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard.index')}}">{{__('Dashboard')}}</a>
                  </li>
                  <li class="breadcrumb-item {{ Request::is('admin/category') ? 'active' : '' }}">
                    <a href="{{ route('admin.category.index')}}">{{__('Manage Category')}}</a>
                  </li>
                  <li class="breadcrumb-item {{ Request::is('admin/category/create') ? 'active' : '' }}">
                    <a href="{{ route('admin.category.create')}}">{{__('Add Category')}}</a>
                  </li>
                </ol>
              </nav>
            </div>
          </div>

            <div class="card mb-4">
                <div class="card-header d-flex justify-content-center mt-3">
                    <h4 class="d-flex justify-content-center text-primary">{{__('Add Category')}}</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.category.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        @include('partials.message.error')
                        @include('partials.message.success')
                        @include('partials.message.message')

                        <div class="mb-3">
                            <label class="form-label" for="name">{{__('Name')}}</label>
                            <input type="text" name="name" class="form-control" id="name" placeholder="{{__('Enter category')}}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="slug">{{__('Slug')}}</label>
                            <input type="text" name="slug" class="form-control" id="slug" placeholder="{{__('Enter slug')}}" required>
                        </div>

                        <div class="mb-3">
                            <label for="formFile" class="form-label" >{{__('Image')}}</label>
                            <img src="" alt="" id="imagePreview" width="100px;">
                            <input class="form-control" name="image" type="file" id="imageUrl" required>
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


    
@endpush