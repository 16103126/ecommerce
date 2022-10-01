@extends('layouts.frontend')

@section('title', __('Ecommerce'))

@section('content')

@include('partials.frontend.slider')

    <div class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <div class="list-group shadow">
                        <button type="button" class=" btn btn-danger" aria-current="true">
                            <h4>{{__('Category')}}</h4>
                        </button>
                        @foreach ($categories as $cate)
                        <a href="{{route('category', $cate->slug)}}" class="list-group-item {{ Request::is('category/'.$cate->slug) ? 'active' : ''}}">{{$cate->name}}</a>
                        @endforeach
                    </div>
                </div>
                <div class="col-sm-8">
                    <h2>{{__('Featured Products')}}</h2>
                    <hr>
                    <div class="row">
                        @if ($category->products->where('trending', 1)->count() < 1)
                            <div class="card shadow">
                                <div class="card-body">
                                    <h5>{{__('No, Product found for this category.')}}</h5>
                                </div>
                            </div>
                        @endif
                        @foreach ($category->products->where('trending', 1) as $product)
                            <div class="col-md-3">
                                <div class="card shadow">
                                    <img src="{{ asset('assets/admin/image/products/'. $product->image) }}" alt="" style="height: 150px;">
                                    <div class="card-body">
                                        <h5>{{ $product->name }}</h5>
                                        <span class="float-start">{{currencySign()}}{{ $product->selling_price * currencyValue()}}</span>
                                        <span class="float-end"><s>{{currencySign()}}{{ $product->orginal_price * currencyValue()}}</s></span>
                                        <a href="{{ route('product.details', $product->slug) }}" class="btn btn-primary d-flex justify-content-center mt-5">{{__('View Details')}}</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('js')
@endpush
