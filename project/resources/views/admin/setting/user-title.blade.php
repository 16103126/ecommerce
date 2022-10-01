@extends('layouts.admin')

@section('title', __('User Title Setting'))
    
@section('content')

<div class="container mt-5">
    <div class="row">
        <div class="col-md-4">

        </div>
        <div class="col-md-4">

            <div class="card">
                <div class="btn btn-primary p-2 btn-buy-now card-header d-flex justify-content-center">
                    <h4 class=" d-flex justify-content-center text-white ">{{__('USER TITLE')}}</h4>
                </div>
                <div class="card-body border border-primary border-2 p-4" style="margin-top: -1%">
                    <form action="{{ route('admin.setting.user.title.update', $title->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        @include('partials.message.error')
                        @include('partials.message.success')
                        @include('partials.message.message')

                        <div class="mb-3">
                            <label for="formFile" class="form-label">{{__('User Title')}}</label>
                            <input class="form-control" name="title" type="text" value="{{ $title->user_title }}" required>
                        </div>

                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary d-block mt-3">{{__('Update')}}</button>
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