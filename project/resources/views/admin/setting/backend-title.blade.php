@extends('layouts.admin')

@section('title', __('Backend Title Setting'))
    
@section('content')

<div class="container mt-5">
    <div class="row">
        <div class="col-md-4">

        </div>
        <div class="col-md-4">

            <div class="card">
                <div class="card-header d-flex justify-content-center">
                    <h3 class="d-flex justify-content-center text-primary ">{{__('Backend Title')}}</h3>
                </div>
                {{-- <hr class=""> --}}
                <div class="card-body">
                    <form action="{{ route('admin.setting.backend.title.update', $title->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        @include('partials.message.error')
                        @include('partials.message.success')
                        @include('partials.message.message')

                        <div class="mb-3">
                            <label for="formFile" class="form-label">{{__('Backend Title')}}</label>
                            <input class="form-control" name="title" type="text" value="{{ $title->backend_title }}" required>
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