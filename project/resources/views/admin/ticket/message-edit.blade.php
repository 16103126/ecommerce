@extends('layouts.admin')

@section('title', __('Edit Message'))
    
@section('content')

<div class="container mt-5">
    <div class="card mb-3">
      <div class="card-body">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb breadcrumb-style2 mb-0">
            <li class="breadcrumb-item {{ Request::is('admin/dashboard') ? 'active' : '' }}">
              <a href="{{ route('admin.dashboard.index')}}">{{__('Dashboard')}}</a>
            </li>
            <li class="breadcrumb-item {{ Request::is('admin/ticket/index') ? 'active' : '' }}">
                <a href="{{ route('admin.ticket.index')}}">{{__('Ticket')}}</a>
              </li>
            <li class="breadcrumb-item {{ url()->current() ? 'active' : '' }}">
              <a href="{{ route('admin.ticket.message.edit', $message->id)}}">{{__('Edit Message')}}</a>
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
                    <h4 class="d-flex justify-content-center text-primary">{{__('Edit Ticket')}}</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.ticket.message.update', $message->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        @include('partials.message.error')
                        @include('partials.message.success')
                        @include('partials.message.message')

                        <div class="mb-3">
                            <label class="form-label" for="message">{{__('Message')}}</label>
                            <textarea name="message" id="message" rows="5" class="form-control">{{$message->message}}</textarea>
                        </div>

                        <div class="mb-3">
                            <input type="file" name="file" class="form-control" id="file">
                            @if ($message->file)
                            <i class='bx bx-file display-1 text-primary'></i>
                            @endif
                        </div>

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