@extends('user.auth.master')

@section('title', __('User Login'))
    
@section('content')
<div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
      <div class="authentication-inner">
        <!-- Register -->
        <div class="card">
          <div class="card-body">
            <!-- Logo -->
            <div class="app-brand justify-content-center">
              <h3 class="demo text-body fw-bolder text-primary">{{__('Login')}}</h3>
            </div>
            
            <!-- /Logo -->

            <form id="formAuthentication" class="mb-3" action="{{ route('user.login') }}" method="POST">
              @csrf
              @include('partials.message.success')
              @include('partials.message.error')
              @include('partials.message.message')
              <div class="mb-3">
                <label for="email" class="form-label">{{__('Email')}}</label>
                <input type="text" class="form-control" id="email" name="email" placeholder="{{__('Enter your email')}}" autofocus/>
              </div>
              <div class="mb-3 form-password-toggle">
                <div class="d-flex justify-content-between">
                  <label class="form-label" for="password">{{__('Password')}}</label>
                  <a href="{{ route('user.forgot.form') }}">
                    <small>{{__('Forgot Password?')}}</small>
                  </a>
                </div>
                <div class="input-group input-group-merge">
                  <input type="password" id="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password"/>
                  <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                </div>
              </div>
              <div class="mb-3">
                <div class="form-check">
                  <input class="form-check-input" name="remember_me" type="checkbox" id="remember-me" />
                  <label class="form-check-label" for="remember-me"> {{__('Remember Me')}} </label>
                </div>
              </div>
              <div class="mb-3">
                <button class="btn btn-primary d-grid w-100" type="submit">{{__('Sign in')}}</button>
              </div>
            </form>

            <p class="text-center">
              <span>{{__('New on our platform?')}}</span>
              <a href="{{ route('user.register.form') }}">
                <span>{{__('Create an account')}}</span>
              </a>
            </p>
          </div>
        </div>
        <!-- /Register -->
      </div>
    </div>
  </div>  


@endsection

@push('js')

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>

<script>

  "use strict";

  $(document).ready(function(){
    
    let remember = $.cookie('remember');

    if (remember == 'true') 
        {
            // $('#remember-me').attr('checked', 'checked');
            let email = $.cookie('email');
            let password = $.cookie('password');

            $('#email').val(email);
            $('#password').val(password);
        }

        $("form").submit(function() {

              if ($('#remember-me').val() == 'on') {
                  let email = $('#email').val();
                  let password = $('#password').val();

                  // set cookies to expire in 14 days
                  $.cookie('email', email, { expires: 14 });
                  $.cookie('password', password, { expires: 14 });
                  $.cookie('remember', true, { expires: 14 });                
              }
              else
              {
                  // reset cookies
                  $.cookie('email', null);
                  $.cookie('password', null);
                  $.cookie('remember', null);
              }
        });


  });

</script>
    
@endpush
