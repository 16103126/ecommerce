@extends('layouts.admin')

@section('title', __('Edit Payment'))
    
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
                        <li class="breadcrumb-item {{ Request::is('admin/payment/index') ? 'active' : '' }}">
                        <a href="{{ route('admin.payment.index')}}">{{__('Manage payment')}}</a>
                        </li>
                        <li class="breadcrumb-item {{ url()->current() ? 'active' : '' }}">
                        <a href="{{ route('admin.payment.edit', $payment->id)}}">{{__('Update payment')}}</a>
                        </li>
                    </ol>
                    </nav>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header d-flex justify-content-center mt-3">
                    <h3 class="d-flex justify-content-center text-primary">{{__('Update payment')}}</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.payment.update', $payment->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        @include('partials.message.error')
                        @include('partials.message.success')
                        @include('partials.message.message')

                        <div class="mb-3">
                            <label class="form-label" for="name">{{__('Name')}}</label>
                            <input type="text" name="name" class="form-control" id="name" value="{{ $payment->name }}">
                        </div>

                        @if ($payment->key)
                            <div class="mb-3">
                                <label class="form-label" for="key">{{__('key')}}</label>
                                <input type="text" name="key" class="form-control" id="key" value="{{ $payment->key }}">
                            </div>
                        @endif

                        @if ($payment->secret)
                            <div class="mb-3">
                                <label class="form-label" for="secret">{{__('secret')}}</label>
                                <input type="text" name="secret" class="form-control" id="secret" value="{{ $payment->secret }}">
                            </div>
                        @endif

                        @if ($payment->payment_no)
                        <div class="mb-3">
                            <label class="form-label" for="payment_no">{{__('payment number')}}</label>
                            <input type="number" name="payment_no" class="form-control" id="payment_no" value="{{ $payment->payment_no }}">
                        </div>
                        @endif

                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary mt-3">{{__('Update')}}</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('js')


    
@endpush