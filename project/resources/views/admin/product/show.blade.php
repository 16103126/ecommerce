@extends('layouts.admin')

@section('title', __('Product Details'))
    
@section('content')

<div class="container mt-5">
    <div class="row">
        <div class="col-md-1">

        </div>
        <div class="col-md-10">

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
                        <a href="{{ route('admin.product.show', $product->id)}}">{{__('Product Details')}}</a>
                        </li>
                    </ol>
                    </nav>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header d-flex justify-content-center mt-3">
                    <h3 class="d-flex justify-content-center text-primary">{{__('Product Details')}}</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td width="20%">{{__('Name')}}</td>
                                <td>{{ $product->name }}</td>
                            </tr>
                            <tr>
                                <td width="20%">{{__('Category')}}</td>
                                <td>{{ $product->category->name }}</td>
                            </tr>
                            @if ($product->subcategory_id)
                            <tr>
                                <td width="20%">{{__('SubCategory')}}</td>
                                <td>{{ $product->subcategory->name }}</td>
                            </tr>
                            @endif
                            @if ($product->childcategory_id)
                            <tr>
                                <td width="20%">{{__('Child Category')}}</td>
                                <td>{{ $product->childcategory->name }}</td>
                            </tr>
                            @endif
                            <tr>
                                <td width="20%">{{__('Image')}}</td>
                                <td><img src="{{ asset('assets/admin/image/products/'.$product->image) }}" alt="" width="100px"></td>
                            </tr>
                            <tr>
                                <td width="20%">{{__('Description')}}</td>
                                <td>{{ $product->details }}</td>
                            </tr>
                            <tr>
                                <td width="20%">{{__('Price')}}</td>
                                <td>{{ $product->price }}</td>
                            </tr>
                            @if($product->quantity > 0)
                            <tr>
                                <td width="20%">{{__('Quantity')}}</td>
                                <td>{{ $product->quantity }}</td>
                            </tr>
                            @endif
                            <tr>
                                <td width="20%">{{__('Stock')}}</td>
                                @if ($product->quantity > 0)
                                    <td>{{__('Available')}}</td>
                                    @else
                                    <td><span class="badge rounded-pill bg-label-danger">{{__('Out of stock')}}</span></td>
                                @endif
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('js')

    
@endpush