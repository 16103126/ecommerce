@extends('layouts.frontend')

@section('title', __('Checkout Page'))

@section('content')


<div class="py-5">
    <div class="container">
        <div class="row justify-content-center" style="margin-bottom: 20%">
            <div class="row">
                <div class="col-md-8">
                    <div class="card shadow">
                        <div class="card-body">
                            @php
                            $total_price = 0
                            @endphp
                            <form action="" method="POST">
                                @csrf
                                @include('partials.message.error')
                                @include('partials.message.success')
                                @include('partials.message.message')

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="name">@lang('Name')</label>
                                            <input type="text" name="name" value="{{ Auth::guard('web')->user()->name}}" class="form-control">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="name">@lang('Phone number')</label>
                                            <input type="text" name="phone_no" value="{{ Auth::guard('web')->user()->phone_no}}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="name">@lang('Email')</label>
                                            <input type="email" name="email" value="{{ Auth::guard('web')->user()->email}}" class="form-control">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="name">@lang('Shipping Address')</label>
                                            <input type="text" name="shipping_address" value="{{ Auth::guard('web')->user()->shipping_address}}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="name">@lang('Country')</label>
                                            <input type="text" name="country" value="{{ Auth::guard('web')->user()->country}}" class="form-control">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="name">@lang('Zip Code')</label>
                                            <input type="text" name="zipcode" value="{{ Auth::guard('web')->user()->zipcode}}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="name">@lang('State')</label>
                                            <input type="text" name="state" value="{{ Auth::guard('web')->user()->state}}" class="form-control">
                                            <input type="hidden" name="total_price" value="{{ $total_price }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="">@lang('Select Payment Method') </label>
                                    <select name="payment_id" id="" class="form-control">
                                        <option >@lang('Select Payment')</option>
                                        @foreach ($payments as $payment)
                                            <option value="{{ $payment->id  }}" data-payment="{{ $payment->name }}" data-target="{{ $payment->payment_no }}"> {{ $payment->name }} </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="d-none mt-5" id="stripe">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label for="cvvNumber" class="form-label">@lang('CVV')</label>
                                                <input type="number" autocomplete="off" name="cvvNumber" placeholder="ex. 311" class="form-control" id="cvvNumber" size="4">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label for="card_no" class="form-label">@lang('Card number')</label>
                                                <input type="number" autocomplete="off" name="card_no" class="form-control" id="card_no" size="20">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label for="ccExpireMonth" class="form-label">@lang('Expired Month')</label>
                                                <input type="number" autocomplete="off" name="ccExpireMonth" placeholder="MM" class="form-control" id="ccExpireMonth" size="4" >
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label for="ccExpireYear" class="form-label">@lang('Expired Year')</label>
                                                <input type="number" autocomplete="off" name="ccExpireYear" placeholder="YY" class="form-control" id="ccExpireYear" size="4" >
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-none mt-5" id="mobileMoney">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <h4>@lang('Payment number#') <span class="paymNo"></span></h4>
                                                <br>
                                                <label for="transaction_id" class="form-label">@lang('Transaction ID')</label>
                                                <input type="text" name="transaction_id" class="form-control" >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <button type="submit" class="btn btn-primary">@lang('Submit')</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow">
                        <div class="card-body">
                            <h5>@lang('Order Details')</h5>
                            <hr>
                            @if (Session::has('cartItem'))
                            @php
                                $total_price = 0
                            @endphp
                                    <table class="table table-bordered" style="font-size: 15px;">
                                        <thead>
                                            <tr>
                                                <th>@lang('Name')</th>
                                                <th>@lang('Quantity')</th>
                                                <th>@lang('Tax')</th>
                                                <th>@lang('Price')</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach (Session::get('cartItem') as $id => $cartItem)
                                            <tr>
                                                <td>{{ $cartItem['product_name'] }}</td>
                                                <td> {{ $cartItem['product_quantity']}}</td> 
                                                <td>{{ currencySign() }}{{ $tax = ((DB::table('products')->where('id', $id)->first()->tax) *  $cartItem['product_quantity']) * currencyValue()}}</td>
                                                <td>{{ currencySign() }}{{ (($cartItem['product_price'] * $cartItem['product_quantity']) + $tax)  * currencyValue()}}</td>
                                            </tr>
                                            @php
                                                $total_price += (($cartItem['product_price'] * $cartItem['product_quantity']) + $tax);
                                            @endphp
                                            @endforeach
                                        </tbody>
                                    </table>
                            @endif

                            <p><span style="font-weight: bold">@lang('Total Price:')</span> {{ currencySign() }}{{ $total_price * currencyValue()}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('js')
<script>
    $(document).ready(function(){
        $('select').on('change', function(){

            let payment = $(this).find(':selected').attr('data-payment');
            let payment_no = $(this).find(':selected').attr('data-target');
            
            if(payment == 'Stripe')
            {
                $('#stripe').removeClass('d-none');
                $('#mobileMoney').addClass('d-none');
                $('form').prop('action', '{{ route('stripe.store') }}');
            }

            if(payment == 'Cash On Deliver')
            {
                $('#stripe').addClass('d-none');
                $('#mobileMoney').addClass('d-none');
                $('form').prop('action', '{{ route('cash.store') }}');
            }

            if(payment == 'Mobile Money')
            {
                $('.paymNo').html(payment_no);
                $('#mobileMoney').removeClass('d-none');
                $('#stripe').addClass('d-none');
                $('form').prop('action', '{{ route('mobile.store') }}');
            }
            
        });
    });
</script>
@endpush