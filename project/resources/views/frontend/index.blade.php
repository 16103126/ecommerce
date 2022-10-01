@extends('layouts.frontend')

@section('title', $setting->frontend_title)

@section('content')

@include('partials.frontend.slider')
    <div id="loader">
        <img src="{{asset('assets/frontend/images/loader/loader.gif')}}" alt="" >
    </div> 
    <div class="py-5">
        <div class="container">
            <div class="row d-none" id="first">
                <div class="col-sm-3">
                    <div class="list-group shadow">
                        <button type="button" class="list-group-item list-group-item-action active danger" aria-current="true">
                            <h5>{{__('Category')}}</h5>
                        </button>
                        @foreach ($categories as $category)
                        <a href="{{route('category', $category->slug)}}" class="list-group-item list-group-item-action">{{$category->name}}</a>
                        @endforeach
                    </div>
                </div>
                <div class="col-sm-8">
                    <h3 class="mb-3">{{__('Featured Products')}}</h3>
                    <hr>
                    <div class="row">
                        @foreach ($trendingProducts as $product)
                            <div class="col-md-3">
                                <div class="card shadow">
                                    <img src="{{ asset('assets/admin/image/products/'. $product->image) }}" alt="">
                                    <div class="card-body">
                                        <h6 class="fw-bold">{{ $product->name }}</h6>
                                        <span class="float-start"> {{currencySign() }}{{ $product->selling_price * currencyValue() }}</span>
                                        <span class="float-end"><s>{{currencySign() }}{{ $product->orginal_price * currencyValue() }}</s></span>
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
<script type="text/javascript">

    $(window).on('load', function() { 
        $("#loader").fadeOut(3000, function(){
            $('#first').removeClass('d-none');
        });
    });
    
 </script>  
@endpush
