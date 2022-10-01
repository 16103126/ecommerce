@extends('layouts.user')

@section('title', __('Ticket'))
    
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
          </ol>
        </nav>
      </div>
    </div>
  
      <div class="row">
          <div class="col-md-12">
              <div class="card">
                  <div class="container mt-5">
                    <a href="{{ route('user.ticket.create') }}" class="btn btn-info">@lang('Add Ticket')</a>
                  </div>
                  <div class="card-body">
                    @include('partials.message.success')
                    @include('partials.message.error')
                    @include('partials.message.message')
                    <div class="table-responsive text-nowrap">
                      <table class="table table-bordered table-hover">
                        <thead>
                          <tr>
                              <th>{{__('Subject')}}</th>
                              <th>{{__('Message')}}</th>
                              <th>{{__('Time')}}</th>
                              <th>{{__('Actions')}}</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($tickets as $key => $ticket)
                              <tr>
                                  <td>{{ $ticket->subject }}</td>
                                  <td>{{ $ticket->message }}</td>
                                  <td>{{ $ticket->created_at->diffForHumans()}}</td>
                                  <td>
                                    <a href="{{ route('user.ticket.message', $ticket->id)}}" class="btn btn-info btn-sm" ><i class='bx bxs-show'></i></a>
                                    <a href="{{ route('user.ticket.delete', $ticket->id) }}" class="btn btn-danger btn-sm"><i class='bx bxs-message-square-x' ></i></a>
                                  </td>
                              </tr>
                          @endforeach
                        </tbody>
                      </table>
                      <div class="d-flex justify-content-center mt-3">
                        {{ $tickets->links() }}
                      </div>
                    </div>
                  </div>
                </div>
          </div>
      </div>
  </div>

@endsection