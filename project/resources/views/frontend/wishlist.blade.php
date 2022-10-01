@extends('layouts.frontend')

@section('title', __('Product Wishlist'))

@section('content')

    <div class="container mt-5">
        @include('partials.message.error')
        @include('partials.message.success')
        @include('partials.message.message')
    </div>

    <div class="py-5">
        <div class="container">
            <div class="card shadow p-3">
                @if ($wishlists->count() < 1)
                <h2>@lang('You have no wishlist.')</h2>
                @else
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>@lang('Product Image')</th>
                            <th>@lang('Product Name')</th>
                            <th>@lang('Selling Price')</th>
                            <th>@lang('Stock Status')</th>
                            <th>@lang('Action')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($wishlists as $wishlist)
                            <tr>
                                <td>
                                    <img src="{{ asset('assets/admin/image/products/'.$wishlist->product->image) }}" alt="" width="50px">
                                </td>
                                <td>{{ $wishlist->product->name }}</td>
                                <td>{{ currencySign() }}{{ $wishlist->product->selling_price * currencyValue()}}</td>
                                <td>{{ $wishlist->product->quantity < 1 ? __('Out of Stock') : __('In Stock') }}</td>
                                <td>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <form action="{{ route('cart.store')}}" method="POST" id="addToCart">
                                                @csrf
                                                <input type="hidden" name="quantity" value="1" class="form-control">
                                                <input type="hidden" name="product_id" value="{{ $wishlist->product->id }}">
                                                <input type="hidden" name="product_name" value="{{ $wishlist->product->name }}">
                                                <input type="hidden" name="product_price" value="{{ $wishlist->product->selling_price}}">
                                                <input type="hidden" name="product_image" value="{{ $wishlist->product->image }}">
                                                <button type="submit" class="btn btn-primary">@lang('Add to Cart')</button>
                                            </form>
                                        </div>
                                        <div class="col-md-2">
                                            <a href="{{ route('wishlist.remove', $wishlist->id)}}" class="btn btn-danger">@lang('Remove')</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @endif
            </div>
        </div>
    </div>

@endsection

@push('js')
    <script>
        $(document).ready(function(){
            $('#addToCart').on('submit', function(e){
                e.preventDefault();
                let url = $(this).attr('action');
                let method = $(this).attr('method');

                $.ajax({
                    url : url,
                    type : method,
                    data : new FormData(this),
                    processData: false,
                    contentType: false,
                    cache: false,

                    success: function(response){
                        alert(response.status);
                        location.reload();
                    }
                });

            });
        });
    </script>
@endpush