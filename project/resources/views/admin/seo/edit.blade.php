@extends('layouts.admin')

@section('title', __('Edit Seo'))
    
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
                  <li class="breadcrumb-item {{ Request::is('admin/seo/edit', $data->id) ? 'active' : '' }}">
                    <a href="{{ route('admin.seo.edit', $data->id) }}">{{__('Edit Seo')}}</a>
                  </li>
                </ol>
              </nav>
            </div>
          </div>
          <div class="card mb-4">
              <div class="card-header d-flex justify-content-center mt-3">
                  <h4 class="d-flex justify-content-center text-primary">{{__('Edit Seo')}}</h4>
              </div>
              <div class="card-body">
                  <form action="{{ route('admin.seo.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    @include('partials.message.error')
                    @include('partials.message.success')
                    @include('partials.message.message')

                    <div class="mb-3">
                        <label class="form-label" for="meta_keyword">{{__('Meta Keyword')}}</label>
                        <input type="text" name="meta_keyword" class="form-control" id="meta_keyword" value="{{$data->meta_keyword}}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="meta_description">{{__('Meta Descriptions')}}</label>
                        <input type="text" name="meta_description" class="form-control" id="meta_description" value="{{$data->meta_description}}">
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