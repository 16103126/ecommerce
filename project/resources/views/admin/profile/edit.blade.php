@extends('layouts.admin')

@section('title', __('Edit Profile'))
    
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
                        <a href="{{ route('admin.profile.edit', $admin->id)}}">{{__('Edit Profile')}}</a>
                        </li>
                    </ol>
                    </nav>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header d-flex justify-content-center mt-3">
                    <h3 class="d-flex justify-content-center text-primary">{{__('Edit Profile')}}</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.profile.update', $admin->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        @include('partials.message.error')
                        @include('partials.message.success')
                        @include('partials.message.message')

                        <div class="mb-3">
                            <label class="form-label" for="name">{{__('Name')}}</label>
                            <input type="text" name="name" class="form-control" id="name" value="{{ $admin->name }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="username">{{__('User Name')}}</label>
                            <input type="text" name="username" class="form-control" id="username" value="{{ $admin->username }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="about">{{__('About')}}</label>
                            <textarea name="about" id="about" rows="5" class="form-control">{{ $admin->about }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="image">{{__('Image')}}</label>
                            <img src="{{ asset('assets/admin/image/profile/'.$admin->image) }}" alt="" width="100" class="rounded-circle">
                            <input type="file" name="image" class="form-control" id="image">
                        </div>
                        <button type="submit" class="btn btn-primary">@lang('Update')</button>
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