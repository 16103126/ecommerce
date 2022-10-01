@extends('user.auth.master')

@section('title', __('Password Reset Form'))
    
@section('content')
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner py-4">
            <!-- Forgot Password -->
            <div class="card">
            <div class="card-body">
                <!-- Logo -->
                <div class="app-brand justify-content-center">
                    <h3 class="demo text-body fw-bolder text-primary">{{__('Reset Password')}}</h3>
                </div>
                <!-- /Logo -->
                <form id="formAuthentication" class="mb-3" action="{{ route('user.password.reset') }}" method="POST">
                    @csrf
                    @include('partials.message.error')
                    @include('partials.message.success')
                    @include('partials.message.message')

                    <input type="hidden" class="form-control" id="token" name="token" value="{{ $user->token }}"/>

                    <div class="mb-3 form-password-toggle">
                        <label class="form-label" for="password">{{__('Password')}}</label>
                        <div class="input-group input-group-merge">
                            <input type="password"id="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password"/>
                            <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                        </div>
                    </div>
        
                    <div class="mb-3 form-password-toggle">
                        <label class="form-label" for="password_confirmation">{{__('Confirm Password')}}</label>
                        <div class="input-group input-group-merge">
                            <input type="password" id="password_confirmation" class="form-control" name="password_confirmation" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password"/>
                            <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                        </div>
                    </div>

                    <button class="btn btn-primary d-grid w-100">{{__('Reset')}}</button>
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
