@extends('layouts.user')

@section('title', __('Send Ticket'))
    
@section('content')

<div class="container mt-5">
    <div class="card mb-3">
      <div class="card-body">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb breadcrumb-style2 mb-0">
            <li class="breadcrumb-item {{ Request::is('user/dashboard') ? 'active' : '' }}">
              <a href="{{ route('user.dashboard.index')}}">{{__('Dashboard')}}</a>
            </li>
            <li class="breadcrumb-item {{ Request::is('user/ticket/index') ? 'active' : '' }}">
              <a href="{{ route('user.ticket.index')}}">{{__('Ticket')}}</a>
            </li>
            <li class="breadcrumb-item {{ Request::is('user/ticket/create') ? 'active' : '' }}">
              <a href="{{ route('user.ticket.create')}}">{{__('Send Ticket')}}</a>
            </li>
          </ol>
        </nav>
      </div>
    </div>
  
      <div class="row">
          <div class="col-md-3">

          </div>
          <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-center mt-3">
                    <h4 class="d-flex justify-content-center text-primary">{{__('Send Ticket')}}</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('user.ticket.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        @include('partials.message.error')
                        @include('partials.message.success')
                        @include('partials.message.message')

                        <div class="mb-3">
                            <label class="form-label" for="email">{{__('Email')}}</label>
                            <input type="email" name="email" class="form-control" id="email" placeholder="{{__('Enter receiver email')}}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="subject">{{__('Subject')}}</label>
                            <input type="text" name="subject" class="form-control" id="subject" placeholder="{{__('Enter subject')}}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="message">{{__('Message')}}</label>
                            <textarea name="message" id="message" rows="5" class="form-control" placeholder="{{__('Enter message')}}" required></textarea>
                        </div>

                        <div class="mb-3">
                            <input type="file" name="file" class="form-control" id="file">
                        </div>

                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary mt-3">{{__('Send')}}</button>
                        </div>

                    </form>
                </div>
            </div>
          </div>
      </div>
  </div>

@endsection