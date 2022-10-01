@extends('layouts.admin')

@section('title', __('Password Reset'))
    
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
                        <li class="breadcrumb-item {{ url()->current() ? 'active' : '' }}">
                        <a href="{{ route('admin.reset.password', $admin->id)}}">{{__('Password Reset')}}</a>
                        </li>
                    </ol>
                    </nav>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header d-flex justify-content-center mt-3">
                    <h3 class="d-flex justify-content-center text-primary">{{__('Password Reset')}}</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.password.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        @include('partials.message.error')
                        @include('partials.message.success')
                        @include('partials.message.message')

                        <div class="mb-3">
                            <label class="form-label" for="curr_password">{{__('Current Password')}}</label>
                            <input type="password" name="curr_password" class="form-control" id="curr_password" placeholder="Enter Current Password">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="new_password">{{__('New Password')}}</label>
                            <input type="password" name="new_password" class="form-control" id="new_password" placeholder="Enter New Password">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="password_confirmation">{{__('Confirm Password')}}</label>
                            <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="Re-type Password">
                        </div>
                        <button type="submit" class="btn btn-primary">@lang('Reset')</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('js')

<script>


</script>
    
@endpush