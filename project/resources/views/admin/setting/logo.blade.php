@extends('layouts.admin')

@section('title', __('Logo Setting'))
    
@section('content')

<div class="container mt-5">
    <div class="row">
        <div class="col-md-4">

        </div>
        <div class="col-md-4">

            <div class="card">
                <div class="card-header d-flex justify-content-center">
                    <h3 class="d-flex justify-content-center text-primary ">{{__('Logo')}}</h3>
                </div>
                {{-- <hr class=""> --}}
                <div class="card-body">
                    <form action="{{ route('admin.setting.logo.update', $logo->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        @include('partials.message.error')
                        @include('partials.message.success')
                        @include('partials.message.message')

                        <div class="mb-3">
                            <div class="d-flex justify-content-center">
                              <img src="{{ asset('assets/admin/images/logo/'.$logo->logo) }}" alt="" width="100px">
                            </div>
                            <label for="formFile" class="form-label">{{__('Logo')}}</label>
                            <input class="form-control" name="logo" type="file" id="imageUrl" required>
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