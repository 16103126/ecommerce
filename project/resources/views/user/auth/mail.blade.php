@extends('user.auth.master')

@section('title', 'Password Forgot Form')
    
@section('content')
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner py-4">
            <!-- Forgot Password -->
            <div class="card">
            <div class="card-body">
                <!-- Logo -->
                <div class="app-brand justify-content-center">
                    <h3 class="demo text-body fw-bolder text-primary">{{__('Password Reset Token')}}</h3>
                </div>
                <!-- /Logo -->
                {{-- <p>Your password reset token is {{ $token }}</p> --}}
                <div class="text-center">
                <a href="{{ route('user.password.reset.form', $token) }}" class="d-flex align-items-center justify-content-center">
                    <i class="bx bx-chevron-left scaleX-n1-rtl bx-sm"></i>
                    {{__('Please, click here for reset your password.')}}
                </a>
                </div>
            </div>
            </div>
            <!-- /Forgot Password -->
        </div>
        </div>
    </div>
@endsection
