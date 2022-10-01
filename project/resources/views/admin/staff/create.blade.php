@extends('layouts.admin')

@section('title', __('Create Staff'))
    
@section('content')

<div class="container mt-3">
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
                  <li class="breadcrumb-item {{ Request::is('admin/staff') ? 'active' : '' }}">
                    <a href="{{ route('admin.staff.index')}}">{{__('Manage Staff')}}</a>
                  </li>
                  <li class="breadcrumb-item {{ Request::is('admin/staff/create') ? 'active' : '' }}">
                    <a href="{{ route('admin.staff.create')}}">{{__('Add Staff')}}</a>
                  </li>
                </ol>
              </nav>
            </div>
          </div>

            <div class="card mb-4">
                <div class="card-header d-flex justify-content-center mt-3">
                    <h4 class="d-flex justify-content-center text-primary">{{__('Add Staff')}}</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.staff.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        @include('partials.message.error')
                        @include('partials.message.success')
                        @include('partials.message.message')

                        <div class="mb-3">
                            <label class="form-label" for="name">{{__('Name')}}</label>
                            <input type="text" name="name" class="form-control" id="name" placeholder="{{__('Enter Role')}}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="username">{{__('Username')}}</label>
                            <input type="text" name="username" class="form-control" id="username" placeholder="{{__('Enter Username')}}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="email">{{__('Email')}}</label>
                            <input type="text" name="email" class="form-control" id="email" placeholder="{{__('Enter email')}}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="password">{{__('Password')}}</label>
                            <input type="password" name="password" class="form-control" id="password" placeholder="{{__('Enter password')}}" required>
                        </div>

                        <div class="mb-3">
                            <select class="form-select" aria-label="Default select example" name="role_id">
                                @foreach ($roles as $role)
                                    <option value="{{$role->id}}">{{$role->name}}</option>
                                @endforeach
                              </select>
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