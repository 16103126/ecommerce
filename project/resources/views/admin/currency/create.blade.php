@extends('layouts.admin')

@section('title', __('Add Currency'))
    
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
                      <li class="breadcrumb-item {{ Request::is('admin/currency/index') ? 'active' : '' }}">
                        <a href="{{ route('admin.currency.index')}}">{{__('Manage Currency')}}</a>
                      </li>
                      <li class="breadcrumb-item {{ Request::is('admin/currency/create') ? 'active' : '' }}">
                        <a href="{{ route('admin.currency.create')}}">{{__('Add Currency')}}</a>
                      </li>
                    </ol>
                  </nav>
                </div>
              </div>

            <div class="card mb-4">
                <div class="card-header d-flex justify-content-center mt-3">
                    <h3 class="d-flex justify-content-center text-primary">{{__('Add Currency')}}</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.currency.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        @include('partials.message.error')
                        @include('partials.message.success')
                        @include('partials.message.message')

                        <div class="mb-3">
                            <label class="form-label" for="name">{{__('Name')}}</label>
                            <input type="text" name="name" class="form-control" id="name" required placeholder="{{__('Enter currency name')}}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="sign" >{{__('Sign')}}</label>
                            <input type="text" name="sign" class="form-control" id="sign" placeholder="{{__('Enter currency sign')}}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="value" >{{__('Value')}}</label>
                            <input type="number" name="value" class="form-control" id="value" placeholder="{{__('Enter currency value')}}" required>
                        </div>

                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary mt-3">{{__('Submit')}}</button>
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