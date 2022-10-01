@extends('layouts.user')

@section('title', __('Order Details'))

@section('content')

<div class="container mt-5">
    <div class="card text-dark">
        <div class="card-body">
            <div class="row">
                <div class="col-md-10">
                    <h4 class="fw-bold text-dark">@lang('My Order Details')</h4>
                </div>
                <div class="col-md-2">
                    <a href="{{ route('user.order.pdf', $order->id) }}" class="btn btn-success">@lang('Print')</a>
                </div>
            </div>
            <hr>
            <p class="text-dark"><span class="fw-bold">@lang('Order No#:')</span> {{ $order->order_number }}</p>
            <p class="text-dark"><span class="fw-bold">@lang('Order Date:')</span> {{ $order->created_at->format('d M, Y.  H:i A') }}</p>

            <div class="row mt-5">
                <div class="col-md-6">
                    <h5 class="fw-bold text-dark">@lang('Shippng Address')</h5>
                    <table>
                        <tr>
                            <td>@lang('Name')</td>
                            <td class="ms-2"><span class="ms-2">:</span></td>
                            <td class="ms-2"><span class="ms-2">{{ $order->user->name}}</span></td>
                        </tr>
                        <tr>
                            <td>@lang('Email')</td>
                            <td><span class="ms-2">:</span></td>
                            <td><span class="ms-2">{{ $order->email}}</span></td>
                        </tr>
                        <tr>
                            <td>@lang('Phone')</td>
                            <td><span class="ms-2">:</span></td>
                            <td><span class="ms-2">{{ $order->phone_no}}</span></td>
                        </tr>
                        <tr>
                            <td>@lang('Shipping address')</td>
                            <td><span class="ms-2">:</span></td>
                            <td><span class="ms-2">{{ $order->shipping_address }}</span></td>
                        </tr>
                        <tr>
                            <td>@lang('County')</td>
                            <td><span class="ms-2">:</span></td>
                            <td><span class="ms-2">{{ $order->country }}</span></td>
                        </tr>
                        <tr>
                            <td>@lang('State')</td>
                            <td><span class="ms-2">:</span></td>
                            <td><span class="ms-2">{{ $order->state }}</span></td>
                        </tr>
                        <tr>
                            <td>@lang('Zip code')</td>
                            <td><span class="ms-2">:</span></td>
                            <td><span class="ms-2">{{ $order->zipecode }}</span></td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <h5 class="fw-bold text-dark">@lang('Payment Information')</h5>
                    <table>
                        <tr>
                            <td>@lang('Payment status')</td>
                            <td class="ms-2"><span class="ms-2">:</span></td>
                            <td class="ms-2"><span class="ms-2">
                                @if ($order->payment_status == 1)
                                <span class="badge bg-success">@lang('Paid')</span>
                                @else
                                <span class="badge bg-danger">@lang('Unpaid')</span>
                                @endif
                            </span></td>
                        </tr>
                        <tr>
                            @php
                                $amount = 0;
                                foreach($order->orderDetails as $oorder)
                                {
                                    $price = ($oorder->quantity * $oorder->price) + ($oorder->quantity * $oorder->tax);
                                }

                                $amount += $price * currencyValue();
                            @endphp
                            <td>@lang('Paid amount')</td>
                            <td><span class="ms-2">:</span></td>
                            <td><span class="ms-2">{{ currencySign() }}{{ $amount }}</span></td>
                        </tr>
                        <tr>
                            <td>@lang('Payment method')</td>
                            <td><span class="ms-2">:</span></td>
                            <td><span class="ms-2">{{ $order->payment->name}}</span></td>
                        </tr>
                        <tr>
                            <td>@lang('Transaction ID')</td>
                            <td><span class="ms-2">:</span></td>
                            <td><span class="ms-2">{{ $order->transaction_id }}</span></td>
                        </tr>
                    </table>
                </div>
            </div>
            <h5 class="mt-5 fw-bold text-dark">@lang('Ordered Product')</h5>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th style="color: black">@lang('ID#')</th>
                        <th style="color: black">@lang('Product Name')</th>
                        <th style="color: black">@lang('Quantity')</th>
                        <th style="color: black">@lang('Price')</th>
                        <th style="color: black">@lang('Tax')</th>
                        <th style="color: black">@lang('Total Price')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->orderDetails as $oorder)
                        <tr>
                            <td style="color: black">{{$oorder->id}}</td>
                            <td style="color: black">{{$oorder->name}}</td>
                            <td style="color: black">{{$oorder->quantity}}</td>
                            <td style="color: black">{{ currencySign() }}{{$oorder->price * currencyValue()}}</td>
                            <td style="color: black">{{ currencySign() }}{{$oorder->tax * currencyValue()}}</td>
                            <td style="color: black">{{ currencySign() }}{{(($oorder->price * $oorder->quantity) + $oorder->tax) * currencyValue()}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection



