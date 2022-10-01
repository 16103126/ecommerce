@extends('user.auth.master')

@section('title', __('User Registration'))

@section('content')
<div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
      <div class="authentication-inner">
        <!-- Register Card -->
        <div class="card">
          <div class="card-body">
            <!-- Logo -->
            <div class="app-brand justify-content-center">
              <a href="index.html" class="app-brand-link gap-2">
                <span class="app-brand-logo demo">
                    <h3 class="demo text-body fw-bolder text-primary">{{__('Register')}}</h3>
                </span>
              </a>
            </div>
            <!-- /Logo -->

            <form id="formAuthentication" class="mb-3" action="{{ route('user.register') }}" method="POST">
              @csrf

              <div class="d-none" id="errorMsg">
                <div class="alert alert-danger alert-dismissible" role="alert" >
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  <p id="errorText"></p>
                </div>
              </div>

              <div class="d-none" id="successMsg">
                <div class="alert alert-success alert-dismissible" role="alert" >
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  <p id="successText"></p>
                </div>
              </div>

              <div class="mb-3">
                <label for="name" class="form-label">{{__('Name')}}</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="{{__('Enter your name')}}" autofocus/>
              </div>

              <div class="mb-3">
                <label for="username" class="form-label">{{__('Username')}}</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="{{__('Enter your username')}}" autofocus/>
              </div>

              <div class="mb-3">
                <label for="email" class="form-label">{{__('Email')}}</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="{{__('Enter your email')}}" autofocus/>
              </div>

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

              <div class="mb-3">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="terms-conditions" name="terms" />
                  <label class="form-check-label" for="terms-conditions">
                    {{__('I agree to')}} 
                    <a href="javascript:void(0);">{{__('privacy policy & terms')}}</a>
                  </label>
                </div>
              </div>

              <button class="btn btn-primary d-grid w-100">{{__('Sign up')}}</button>
            </form>

            <p class="text-center">
              <span>{{__('Already have an account?')}}</span>
              <a href="auth-login-basic.html">
                <span>{{__('Sign in instead')}}</span>
              </a>
            </p>
          </div>
        </div>
        <!-- Register Card -->
      </div>
    </div>
  </div>

@endsection

@push('js')
<script>

  "use strict";

  $(document).ready(function(){

    $('form').on('submit', function(e){

      e.preventDefault();

      let url = $(this).attr('action');
      let method = $(this).attr('method');

      $.ajax({
        url          : url,
        type         : method,
        data         : new FormData(this),
        cache        : false,
        processData  : false,
        contentType  : false,

        success      : function(response){
          if(response.errors){
            $('#errorMsg').removeClass('d-none')
            $('#successMsg').addClass('d-none');
            $.each(response.errors, function(index, error){
              $('#errorText').html(error);
            });
          }else{
            $('#errorMsg').addClass('d-none')
            $('#successMsg').removeClass('d-none');
            $('#successTest').html(response);
          }
        }
      });

    });

  });

</script>
@endpush


