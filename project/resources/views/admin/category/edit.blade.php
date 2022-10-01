@extends('layouts.admin')

@section('title', __('Edit Category'))
    
@section('content')

<div class="container mt-5">
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
                        <li class="breadcrumb-item {{ url()->current() ? 'active' : '' }}">
                        <a href="{{ route('admin.category.edit', $category->id)}}">{{__('Edit Category')}}</a>
                        </li>
                    </ol>
                    </nav>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header d-flex justify-content-center mt-3">
                    <h3 class="d-flex justify-content-center text-primary">{{__('Edit Category')}}</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.category.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        @method('PUT')

                        @include('partials.message.error')
                        @include('partials.message.success')
                        @include('partials.message.message')

                        <div class="mb-3">
                            <label class="form-label" for="name">{{__('Name')}}</label>
                            <input type="text" name="name" class="form-control" id="name" value="{{ $category->name }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="slug">{{__('Slug')}}</label>
                            <input type="text" name="slug" class="form-control" id="slug" value="{{ $category->slug }}">
                        </div>

                        <div class="mb-3">
                            <label for="formFile" class="form-label">{{__('Image')}}</label>
                            <img src="{{ asset('assets/admin/image/category/'.$category->image) }}" alt="" id="imagePreview" width="100px;">
                            <input class="form-control" name="image" type="file" id="imageUrl">
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