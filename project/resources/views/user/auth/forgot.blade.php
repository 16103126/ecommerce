@extends('user.auth.master')

@section('title', __('Password Forgot Form'))
    
@section('content')
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner py-4">
            <!-- Forgot Password -->
            <div class="card">
            <div class="card-body">
                <!-- Logo -->
                <div class="app-brand justify-content-center">
                    <h3 class="demo text-body fw-bolder text-primary">{{__('Forgot Password')}}"</h3>
                </div>
                <!-- /Logo -->
                {{-- <h4 class="mb-2">Forgot Password? 🔒</h4> --}}
                <p class="mb-4">{{__('Enter your email and we will send you instructions to reset your password')}}</p>
                <form id="formAuthentication" class="mb-3" action="{{ route('user.forgot') }}" method="POST">
                    @csrf
                    @include('partials.message.error')
                    @include('partials.message.success')
                    @include('partials.message.message')
                <div class="mb-3">
                    <label for="email" class="form-label">{{__('Email')}}</label>
                    <input  type="text" class="form-control" id="email" name="email" placeholder="{{__('Enter your email')}}" autofocus/>
                </div>
                <button class="btn btn-primary d-grid w-100">{{__('Send Reset Link')}}</button>
                </form>
                <div class="text-center">
                <a href="{{ route('user.login.form') }}" class="d-flex align-items-center justify-content-center">
                    <i class="bx bx-chevron-left scaleX-n1-rtl bx-sm"></i>
                    {{__('Back to login')}}
                </a>
                </div>
            </div>
            </div>
            <!-- /Forgot Password -->
        </div>
        </div>
    </div>
@endsection
