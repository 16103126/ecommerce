@extends('layouts.frontend')

@section('title', __('Cart Item'))

@section('content')

<div id="loader">
    <img src="{{asset('assets/frontend/images/loader/loader.gif')}}" alt="">
</div> 
<div class="py-5">
    <div class="container">
        <div class="row justify-content-center" style="margin-bottom: 20%">
            @php
            $total_price = 0;
            @endphp
            <div class="col-md-8">
                @if ($cartItems == null)
                    <div class="card shadow">
                        <div class="card-body">
                            <h4 style="font-family: 'Roboto Condensed'; font-size: 2rem;">{{__('Cart is empty.')}}</h4 class="justify-content-center">
                        </div>
                    </div>
                @else
                <div class="card shadow">
                   <div class="card-body ">
                    @include('partials.message.error')
                    @include('partials.message.success')
                    @include('partials.message.message')
                    <table class="table table-striped table-bordered">
                        <thead>
                          <tr>
                            <th scope="col">@lang('Product Image')</th>
                            <th scope="col">@lang('Product Name') </th>
                            <th scope="col">@lang('Product Price') </th>
                            <th scope="col">@lang('Quantity')</th>
                            <th scope="col">@lang('Action')</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($cartItems as $id => $items)
                            @php
                            $price = $items['product_price'] *  $items['product_quantity'];
                            $total_price += $price;
                            @endphp
                            <tr>
                                <form action="{{ route('cart.update', $id) }}" method="POST">
                                    <td width="20%"><img width="50px" src="{{ asset('assets/admin/image/products/'. $items['product_image']) }}" alt="" width="100px"></td>
                                    <td width="20%"><h6>{{ $items['product_name'] }}</h6></td>
                                    <td width="20%"><h6>{{currencySign()}}{{ $items['product_price'] * currencyValue()}}</h6></td>
                                    <td width="20%">
                                        @csrf
                                        <div class="input-group quantity">
                                            <input type="hidden" name="id" value="{{ $id }}">
                                            <input type="hidden" value="{{ DB::table('products')->where('id', $id)->first()->quantity }}" class="qtyVal">
                                            <span class="input-group-text sub">-</span>
                                            <input type="text" name="quantity" value="{{ $items['product_quantity'] }}" class="form-control val">
                                            <span class="input-group-text add">+</span>
                                        </div>
                                    </td>
                                    <td width="20%">
                                        <div class="d-grid gap-2 d-md-block">
                                            <button type="submit" class="btn btn-primary ">@lang('Update')</button>
                                            <a href="{{ route('cart.remove', $id) }}" class="btn btn-danger ">X</a>
                                        </div>
                                    </td>
                                </form>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="">
                        <p style="font-weight: bold" class="float-start">@lang('Total Price:') {{currencySign()}}{{ $total_price * currencyValue() }}</p>
                        <a href="{{ route('checkout') }}" class="btn btn-success float-end">@lang('Process to Checkout')</a>
                    </div>
                   </div>
               </div>
               @endif
            </div>
        </div>
    </div>
</div>

@endsection

@push('js') 
    <script>
        
        $(window).on('load', function() { 
            $("#loader").fadeOut(5000);  
        });

        $(document).ready(function(){

            $('.sub').on('click', function(){
                let value = parseInt($(this).parents('.quantity').find('.val').val());
                if(!isNaN(value) && value > 1)
                {
                    $(this).parents('.quantity').find('.val').val(value - 1)
                }
            });
        
            $(document).on('click','.add', function(){
                let value = parseInt($(this).parents('.quantity').find('.val').val());
                let quantity = parseInt($(this).parents('.quantity').find('.qtyVal').val());
                if(!isNaN(value) && value < quantity)
                {
                    $(this).parents('.quantity').find('.val').val(value + 1);
                }
            });

        });
    </script>
@endpush
