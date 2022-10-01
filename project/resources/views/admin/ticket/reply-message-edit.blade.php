@extends('layouts.admin')

@section('title', __('Edit Reply'))
    
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
              <a href="{{ route('admin.ticket.message.reply.edit', $reply->id)}}">{{__('Edit Reply')}}</a>
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
                    <h4 class="d-flex justify-content-center text-primary">{{__('Edit Reply')}}</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.ticket.message.reply.update', $reply->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        @include('partials.message.error')
                        @include('partials.message.success')
                        @include('partials.message.message')

                        <div class="mb-3">
                            <label class="form-label" for="reply">{{__('Reply')}}</label>
                            <textarea name="reply" id="reply" rows="5" class="form-control">{{$reply->reply}}</textarea>
                        </div>

                        <div class="mb-3">
                            <input type="file" name="file" class="form-control" id="file">
                            @if ($reply->file)
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