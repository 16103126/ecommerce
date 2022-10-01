@extends('layouts.admin')

@section('title', __('Edit Role'))
    
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
                    <a href="{{ route('admin.dashboard.index') }}">{{__('Dashboard')}}</a>
                  </li>
                  <li class="breadcrumb-item {{ Request::is('admin/role') ? 'active' : '' }}">
                    <a href="{{ route('admin.role.index') }}">{{__('Manage role')}}</a>
                  </li>
                  <li class="breadcrumb-item {{ Request::is('admin/role/edit', $role->id) ? 'active' : '' }}">
                    <a href="{{ route('admin.role.edit', $role->id) }}">{{__('Edit Role')}}</a>
                  </li>
                </ol>
              </nav>
            </div>
          </div>
          <div class="card mb-4">
              <div class="card-header d-flex justify-content-center mt-3">
                  <h4 class="d-flex justify-content-center text-primary">{{__('Edit Role')}}</h4>
              </div>
              <div class="card-body">
                  <form action="{{ route('admin.role.update', $role->id) }}" method="POST" enctype="multipart/form-data">
                      @csrf

                      @include('partials.message.error')
                      @include('partials.message.success')
                      @include('partials.message.message')

                      <div class="mb-3">
                          <label class="form-label" for="name">{{__('Name')}}</label>
                          <input type="text" name="name" class="form-control" id="name" value="{{$role->name}}" required>
                      </div>

                      <div class="row">
                        <h3 class="text-primary">@lang('Permission')</h3>
                        @php
                            $permission = explode(', ',$role->permission);
                        @endphp
                        <div class="col-md-6">
                            <div class="form-check form-switch mb-2">
                              <label class="form-check-label text-primary" for="manageOrder">@lang('Manage Order')</label>
                              <input class="form-check-input" name="permission[]" value="manage order" type="checkbox" id="manageOrder" {{in_array('manage order', $permission) ? 'checked' : ''}}>
                            </div>
                            <div class="form-check form-switch mb-2">
                              <label class="form-check-label text-primary" for="manageOrder">@lang('Manage Category')</label>
                              <input class="form-check-input" name="permission[]" value="manage category" type="checkbox" id="manageCategory" {{in_array('manage category', $permission) ? 'checked' : ''}}>
                            </div>
                            <div class="form-check form-switch mb-2">
                              <label class="form-check-label text-primary" for="manageProduct">@lang('Manage Product')</label>
                              <input class="form-check-input" name="permission[]" value="manage product" type="checkbox" id="manageProduct" {{in_array('manage product', $permission) ? 'checked' : ''}}>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-check form-switch mb-2">
                              <label class="form-check-label text-primary" for="manageOrder">@lang('Manage User')</label>
                              <input class="form-check-input" name="permission[]" value="manage user" type="checkbox" id="manageUser" {{in_array('manage user', $permission) ? 'checked' : ''}}>
                            </div>
                            <div class="form-check form-switch mb-2">
                              <label class="form-check-label text-primary" for="manageOrder">@lang('Manage Language')</label>
                              <input class="form-check-input" name="permission[]" value="manage language" type="checkbox" id="manageLanguage" {{in_array('manage language', $permission) ? 'checked' : ''}}>
                            </div>
                            <div class="form-check form-switch mb-2">
                              <label class="form-check-label text-primary" for="manageOrder">@lang('Manage Payment')</label>
                              <input class="form-check-input" name="permission[]" value="manage payment" type="checkbox" id="managePayment" {{in_array('manage payment', $permission) ? 'checked' : ''}}>
                            </div>
                          </div>
                        </div>
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

@push('js')


    
@endpush