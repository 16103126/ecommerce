@extends('layouts.frontend')

@section('title', __('Product Details'))

@section('content')

    <div class="container mt-5">
        @include('partials.message.error')
        @include('partials.message.success')
        @include('partials.message.message')
    </div>

    <div id="loader">
        <img src="{{asset('assets/frontend/images/loader/loader.gif')}}" alt="">
    </div> 

    <div class="py-5">
        <div class="container">
            <div class="row">
                <div class="card shadow">
                    <div class="row">
                        <div class="col-md-3 border-end">
                            <img src="{{ asset('assets/admin/image/products/'. $product->image) }}" alt="" width="150px">
                        </div>
                        <div class="col-md-9 mt-3">
                            <h2>{{ $product->name }}
                                @if ($product->trending == 1)
                                <span class="float-end badge bg-danger" style="font-size: 16px;">{{__('Trending')}}</span>
                                @endif
                            </h2>
                            <hr>
                            <span class="me-3">{{__('Orginal Price:')}} <s>{{currencySign()}}{{ $product->orginal_price * currencyValue()}}</s></span>
                            <span class="fw-bold">{{__('Selling Price:')}} {{currencySign()}}{{ $product->selling_price * currencyValue()}}</span>
                            <p class="mt-3">{{ $product->details }}</p>
                            <hr>
                            @if ($product->quantity > 0)
                                <span class="badge bg-success">{{__('In Stock')}}</span>
                            @else
                                <span class="badge bg-danger">{{__('Out of Stock')}}</span>
                            @endif
                            <div class="row mt-3">
                                <div class="col-md-4">
                                    <label for="quantity">@lang('Quantity')</label>
                                    <div class="input-group text-center mb-3">
                                        <span class="input-group-text sub">-</span>
                                        <input type="text" name="quantity" value="1" class="form-control val" data-quantity="{{ $product->quantity }}">
                                        <span class="input-group-text add">+</span>
                                        <input type="hidden" value="{{ $product->id }}" id="productId">
                                        <input type="hidden" value="{{ $product->name }}" id="productName">
                                        <input type="hidden" value="{{ $product->selling_price}}" id="productPrice">
                                        <input type="hidden" value="{{ $product->image }}" id="productImage">
                                        <input type="hidden" value="{{ route('cart.store') }}" id="cartUrl">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <button class="btn btn-success mt-4 me-3 addToCart">@lang('Add to Cart')</button>
                                </div>
                                <div class="col-md-4">
                                    <form action="{{ route('wishlist.add') }}" method="Post">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <button type="submit" class="btn btn-primary mt-4">@lang('Add to Wishlist')</button>
                                    </form>
                                </div>
                            </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-4">
                            <form action="{{ route('rating') }}" method="Post">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="hidden" name="rating" value="" id="ratingValue">
                                <h3 class="mb-4">@lang('Rating')</h3>
                                <h1 class="ms-5">
                                    <span type="submit" class="@if(DB::table('ratings')->where('user_id', Auth::guard('web')->user()->id)->where('product_id', $product->id)->first()){{ DB::table('ratings')->where('user_id', Auth::guard('web')->user()->id)->where('product_id', $product->id)->first()->rating == 1 ? 'text-danger' : '' }} @endif" id="rating1">1. *</span><br>
                                    <span type="submit" class="@if(DB::table('ratings')->where('user_id', Auth::guard('web')->user()->id)->where('product_id', $product->id)->first()){{ DB::table('ratings')->where('user_id', Auth::guard('web')->user()->id)->where('product_id', $product->id)->first()->rating == 2 ? 'text-danger' : '' }} @endif" id="rating2">2. * *</span><br>
                                    <span type="submit" class="@if(DB::table('ratings')->where('user_id', Auth::guard('web')->user()->id)->where('product_id', $product->id)->first()){{ DB::table('ratings')->where('user_id', Auth::guard('web')->user()->id)->where('product_id', $product->id)->first()->rating == 3 ? 'text-danger' : '' }} @endif" id="rating3">3. * * *</span><br>
                                    <span type="submit" class="@if(DB::table('ratings')->where('user_id', Auth::guard('web')->user()->id)->where('product_id', $product->id)->first()){{ DB::table('ratings')->where('user_id', Auth::guard('web')->user()->id)->where('product_id', $product->id)->first()->rating == 4 ? 'text-danger' : '' }} @endif" id="rating4">4. * * * *</span><br>
                                    <span type="submit" class="@if(DB::table('ratings')->where('user_id', Auth::guard('web')->user()->id)->where('product_id', $product->id)->first()){{ DB::table('ratings')->where('user_id', Auth::guard('web')->user()->id)->where('product_id', $product->id)->first()->rating == 5 ? 'text-danger' : '' }} @endif" id="rating5">5. * * * * *</span>
                                </h1>
                                <button type="submit" class="btn btn-primary mb-3 ms-5">@lang('Submit')</button>
                            </form>
                        </div>
                        <div class="col-md-6 border-start">
                            @if ($comment)
                            <h3 class="mb-4">@lang('Comment')</h3>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <p class="mt-2">{{Auth::guard('web')->user()->name}}</p>
                                    <img src="{{asset('assets/user/img/users/'.Auth::guard('web')->user()->image)}}" width="50px" alt="" class="rounded-circle">
                                    <p>{{$comment->created_at->diffForHumans()}}</p>
                                </div>
                                <div class="col-md-8">
                                    <div class="card mt-2">
                                        <div class="card-body">
                                            <p >{{$comment->comment}}</p>
                                            <a class="btn" id="reply1">@lang('Reply')</a>
                                            <a class="btn edit">@lang('Edit')</a>
                                            <a href="{{route('comment.delete', $comment->id)}}" class="btn">@lang('Delete')</a>
                                            <form action="{{route('reply')}}" method="POST" id="replyForm" class="d-none">
                                                @csrf
                                                <input type="hidden" name="comment_id" value="{{$comment->id}}">
                                                <textarea name="reply" id="" rows="5" class="form-control mb-2"></textarea>
                                                <button type="submit" class="btn btn-primary mb-3">@lang('Reply')</button>
                                            </form>
                                            <form action="{{route('comment.update', $comment->id)}}" method="POST" id="editForm" class="d-none">
                                                @csrf
                                                <textarea name="comment" id="" rows="5" class="form-control mb-2">{{$comment->comment}}</textarea>
                                                <button type="submit" class="btn btn-primary mb-3">@lang('Update')</button>
                                            </form>
                                        </div>
                                    </div>
                                    @foreach ($comment->replies as $reply)
                                        <div class="card mt-2 ms-5 mb-2">
                                            <div class="card-body" id="commentReply">
                                                <p class="mt-2">{{$reply->reply}}</p>
                                                <a class="btn reply1">@lang('Reply')</a>
                                                <a class="btn edit1">@lang('Edit')</a>
                                                <a href="{{route('reply.delete', $reply->id)}}" class="btn">@lang('Delete')</a>
                                                <form action="{{route('reply')}}" method="POST" class="d-none replyForm1">
                                                    @csrf
                                                    <input type="hidden" name="comment_id" value="{{$comment->id}}">
                                                    <textarea name="reply" id="" rows="5" class="form-control mb-2"></textarea>
                                                    <button type="submit" class="btn btn-primary mb-3">@lang('Reply')</button>
                                                </form>
                                                <form action="{{route('reply.update', $reply->id)}}" method="POST" id="editForm1" class="d-none">
                                                    @csrf
                                                    <textarea name="reply" id="" rows="5" class="form-control mb-2">{{$reply->reply}}</textarea>
                                                    <button type="submit" class="btn btn-primary mb-3">@lang('Update')</button>
                                                </form>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            @else
                            <form action="{{ route('comment') }}" method="Post">
                                @csrf
                                <div class="form-group">
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <textarea name="comment" rows="5" class="form-control"></textarea>
                                </div>
                                <br>
                                <button type="submit" class="btn btn-primary mb-3">@lang('Submit')</button>
                            </form>
                            @endif
                            
                        </div>
                    </div>
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
                let value = parseInt($('.val').val());
                if(!isNaN(value) && value > 1)
                {
                    $('.val').val(value - 1);
                }
            });

            $('.add').on('click', function(){
                let qty = $('.val').data('quantity');
                let value = parseInt($('.val').val());
                if(!isNaN(value) && value < qty)
                {
                    $('.val').val(value + 1);
                }
            });

            $('.addToCart').on('click', function(e){
                e.preventDefault();

                let product_id = $('#productId').val();
                let product_price = $('#productPrice').val();
                let product_name = $('#productName').val();
                let product_image = $('#productImage').val();
                let quantity = $('.val').val();
                let url      = $('#cartUrl').val();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    method : 'POST',
                    url    :  url,
                    data   : {
                        'product_id' : product_id,
                        'quantity'   : quantity,
                        'product_price' : product_price,
                        'product_name' : product_name,
                        'product_image' : product_image
                    },

                    success: function(response){
                        alert(response.status);
                        location.reload();
                    }
                });
            });
            
        });

        $(document).ready(function(){

            $('#rating1').on('click', function(){
                $('#ratingValue').val(1);
                $('#rating1').addClass('text-danger');
                $('#rating2').removeClass('text-danger');
                $('#rating3').removeClass('text-danger');
                $('#rating4').removeClass('text-danger');
                $('#rating5').removeClass('text-danger');
            });

            $('#rating2').on('click', function(){
                $('#ratingValue').val(2);
                $('#rating2').addClass('text-danger');
                $('#rating1').removeClass('text-danger');
                $('#rating3').removeClass('text-danger');
                $('#rating4').removeClass('text-danger');
                $('#rating5').removeClass('text-danger');
            });

            $('#rating3').on('click', function(){
                $('#ratingValue').val(3);
                $('#rating3').addClass('text-danger');
                $('#rating1').removeClass('text-danger');
                $('#rating2').removeClass('text-danger');
                $('#rating4').removeClass('text-danger');
                $('#rating5').removeClass('text-danger');
                
            });

            $('#rating4').on('click', function(){
                $('#ratingValue').val(4);
                $('#rating4').addClass('text-danger');
                $('#rating1').removeClass('text-danger');
                $('#rating3').removeClass('text-danger');
                $('#rating2').removeClass('text-danger');
                $('#rating5').removeClass('text-danger');
            });

            $('#rating5').on('click', function(){
                $('#ratingValue').val(5);
                $('#rating5').addClass('text-danger');
                $('#rating1').removeClass('text-danger');
                $('#rating3').removeClass('text-danger');
                $('#rating4').removeClass('text-danger');
                $('#rating2').removeClass('text-danger');
            });

        });

        $(document).ready(function(){
            $('#reply1').on('click', function(e){
                e.preventDefault()
                $('#replyForm').removeClass('d-none');
                $('#editForm').addClass('d-none');
            });
        });

        $(document).ready(function(){
            $('.edit').on('click', function(){
                $('#editForm').removeClass('d-none');
                $('#replyForm').addClass('d-none');
            });
        });

        $(document).ready(function(){
            $('.reply1').on('click', function(){
                $(this).parent('#commentReply').find('.replyForm1').removeClass('d-none');
                $(this).parent('#commentReply').find('#editForm1').addClass('d-none');
            });
        });

        $(document).ready(function(){
            $('.edit1').on('click', function(){
                $(this).parent('#commentReply').find('#editForm1').removeClass('d-none');
                $(this).parent('#commentReply').find('.replyForm1').addClass('d-none');
            });
        });


    </script>

@endpush

