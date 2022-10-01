@extends('layouts.admin')

@section('title', __('Edit Product'))
    
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
                        <li class="breadcrumb-item {{ Request::is('admin/product/index') ? 'active' : '' }}">
                        <a href="{{ route('admin.product.index')}}">{{__('Manage Product')}}</a>
                        </li>
                        <li class="breadcrumb-item {{ url()->current() ? 'active' : '' }}">
                        <a href="{{ route('admin.product.edit', $product->id)}}">{{__('Edit Product')}}</a>
                        </li>
                    </ol>
                    </nav>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header d-flex justify-content-center mt-3">
                    <h3 class="d-flex justify-content-center text-primary">{{__('Edit Product')}}</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        @include('partials.message.error')
                        @include('partials.message.success')
                        @include('partials.message.message')

                        <div class="mb-3">
                            <label class="form-label" for="name">{{__('Name')}}</label>
                            <input type="text" name="name" class="form-control" id="name" value="{{ $product->name }}">
                        </div>

                        <div class="mb-3">
                            <label for="categorySelect" class="form-label">{{__('Select Category')}}</label>
                            <select id="category" name="category_id" class="form-select">
                                <option>{{__('Select Category')}}</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ $category->id == $product->category_id ? 'selected' : '' }} data-href="{{ route('admin.subcategory.load', $category->id) }}" id="subCategory">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="subcategory" class="form-label">{{__('Select Sub Category')}}</label>
                            <select id="subcategory" name="subcategory_id" class="form-select">
                                {{-- <option>{{__('Select Sub Category')}}</option> --}}
                                @foreach ($product->category->subcategories as $subcategory)
                                    <option value="{{ $subcategory->id }}" {{ $subcategory->id == $product->subcategory_id ? 'selected' : ''}}>{{ $subcategory->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="childcategory" class="form-label">{{__('Select ChildCategory')}}</label>
                            <select id="childcategory" name="childcategory_id" class="form-select">
                                {{-- <option>{{__('Select childCategory')}}</option> --}}
                                @foreach ($product->subcategory->childcategories as $childcategory)
                                    <option value="{{ $childcategory->id }}" {{ $childcategory->id == $product->childcategory_id ? 'selected' : ''}}>{{ $childcategory->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="slug">{{__('Slug')}}</label>
                            <input type="text" name="slug" class="form-control" id="slug" value="{{ $product->slug }}">
                        </div>

                        <div class="mb-3">
                            <label for="formFile" class="form-label">{{__('Image')}}</label>
                            <img src="{{ asset('assets/admin/image/products/'.$product->image) }}" alt="" width="50px">
                            <input class="form-control" name="image" type="file" id="imageUrl">
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="details">{{__('Description')}}</label>
                            <textarea name="details" class="form-control" id="details" rows="5" >{{ $product->details }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="small_details">{{__('Short Description')}}</label>
                            <textarea name="small_details" class="form-control" id="small_details" rows="5"> {{ $product->small_details }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="orginal_price" class="form-label">{{__('Orginal Price')}}</label>
                            <input class="form-control" name="orginal_price" type="number" id="orginal_price" value="{{ $product->orginal_price}}">
                        </div>

                        <div class="mb-3">
                            <label for="selling_price" class="form-label">{{__('Selling Price')}}</label>
                            <input class="form-control" name="selling_price" type="number" id="selling_price" value="{{ $product->selling_price}}">
                        </div>

                        <div class="mb-3">
                            <label for="tax" class="form-label">{{__('Tax')}}</label>
                            <input class="form-control" name="tax" type="number" id="tax" value="{{ $product->tax}}">
                        </div>

                        <div class="mb-3">
                            <label for="quantity" class="form-label">{{__('Quantity')}}</label>
                            <input class="form-control" name="quantity" type="number" id="quantity" value="{{ $product->quantity }}">
                        </div>

                        <div class="mb-3">
                            <input class="form-check-input" name="trending" type="checkbox" {{ $product->trending == 1 ? 'checked' : '' }}>
                            <label class="form-check-label" for="defaultCheck3"> Trending </label>
                        </div>

                        <div class="mb-3">
                            <label for="tag" class="form-label">{{__('Tag')}}</label>
                            <input class="form-control" name="tag" type="text" id="tag" value="{{ $product->tag }}">
                        </div>

                        <div class="mb-3">
                            <label for="meta_title" class="form-label">{{__('Meta Title')}}</label>
                            <input class="form-control" name="meta_title" type="text" id="meta_title" value="{{ $product->meta_title }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="meta_description">{{__('Meta Description')}}</label>
                            <textarea name="meta_description" class="form-control" id="meta_description" rows="5">{{ $product->meta_description }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="meta_keywords" class="form-label">{{__('Meta Keywords')}}</label>
                            <input class="form-control" name="meta_keywords" type="text" id="meta_keywords" value="{{ $product->meta_keywords }}">
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

    $(document).on('change','#subcategory',function () {
        let link = $(this).find(':selected').attr('data-href');
        if(link != "")
        {
        $('#childcategory').load(link);
        $('#childcategory').prop('disabled',false);
        }
    });

</script>
    
@endpush