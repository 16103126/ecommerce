@extends('layouts.admin')

@section('title', __('Edit Child Category'))
    
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
                        <li class="breadcrumb-item {{ Request::is('admin/childcategory') ? 'active' : '' }}">
                        <a href="{{ route('admin.childcategory.index')}}">{{__('Manage Child Category')}}</a>
                        </li>
                        <li class="breadcrumb-item {{ url()->current() ? 'active' : '' }}">
                        <a href="{{ route('admin.childcategory.edit', $childcategory->id)}}">{{__('Edit Child Category')}}</a>
                        </li>
                    </ol>
                    </nav>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header d-flex justify-content-center mt-3">
                    <h3 class="d-flex justify-content-center text-primary">{{__('Edit Child Category')}}</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.childcategory.update', $childcategory->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        @method('PUT')

                        @include('partials.message.error')
                        @include('partials.message.success')
                        @include('partials.message.message')

                        <div class="mb-3">
                            <label class="form-label" for="name">{{__('Name')}}</label>
                            <input type="text" name="name" class="form-control" id="name" value="{{ $childcategory->name }}">
                        </div>

                        <div class="mb-3">
                            <label for="category" class="form-label">{{__('Select Category')}}</label>
                            <select id="category" class="form-select">
                                <option>{{__('Select Category')}}</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ $category->id == $childcategory->subcategory->category_id ? 'selected' : '' }} data-href="{{ route('admin.subcategory.load', $category->id) }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="subcategory" class="form-label">{{__('Select Sub Category')}}</label>
                            <select id="subcategory" name="subcategory_id" class="form-select">
                                <option>{{__('Select Subcategory')}}</option>
                                @foreach ($childcategory->subcategory->category->subcategories as $subcategory)
                                    <option value="{{ $subcategory->id }}" {{ $subcategory->id == $childcategory->subcategory_id ? 'selected' : ''}}>{{ $subcategory->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="slug">{{__('Slug')}}</label>
                            <input type="text" name="slug" class="form-control" id="slug" value="{{ $childcategory->slug }}">
                        </div>

                        <div class="mb-3">
                            <label for="formFile" class="form-label">{{__('Image')}}</label>
                            <img src="{{ asset('assets/admin/image/childcategory/'.$childcategory->image) }}" alt="" id="imagePreview" width="100px;">
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

<script>
    $(document).on('change','#category',function () {
    let link = $(this).find(':selected').attr('data-href');
    if(link != "")
    {
      $('#subcategory').load(link);
      $('#subcategory').prop('disabled',false);
    }
});
</script>
    
@endpush