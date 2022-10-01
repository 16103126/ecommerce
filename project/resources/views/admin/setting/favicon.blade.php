@extends('layouts.admin')

@section('title', __('Favicon Setting'))
    
@section('content')

<div class="container mt-5">
    <div class="row">
        <div class="col-md-4">

        </div>
        <div class="col-md-4">

            {{-- <div class="card mb-3">
                <div class="card-body">
                  <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-style2 mb-0">
                      <li class="breadcrumb-item {{ Request::is('admin/dashboard') ? 'active' : '' }}">
                        <a href="{{ route('admin.dashboard.index')}}">{{__('Dashboard')}}</a>
                      </li>
                      <li class="breadcrumb-item {{ Request::is('admin/product/index') ? 'active' : '' }}">
                        <a href="{{ route('admin.product.index')}}">{{__('Manage Product')}}</a>
                      </li>
                      <li class="breadcrumb-item {{ Request::is('admin/product/create') ? 'active' : '' }}">
                        <a href="{{ route('admin.product.create')}}">{{__('Add Product')}}</a>
                      </li>
                    </ol>
                  </nav>
                </div>
              </div> --}}

            <div class="card border border-primary border-1">
                <div class="card-header d-flex justify-content-center">
                    <h3 class="d-flex justify-content-center text-primary ">{{__('Favicon')}}</h3>
                </div>
                {{-- <hr class=""> --}}
                <div class="card-body">
                    <form action="{{ route('admin.setting.favicon.update', $favicon->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        @include('partials.message.error')
                        @include('partials.message.success')
                        @include('partials.message.message')

                        <div class="mb-3" >
                            <div class="d-flex justify-content-center">
                              <img src="{{ asset('assets/admin/images/favicon/'.$favicon->favicon) }}" alt="" width="100px">
                            </div>
                            <label for="formFile" class="form-label">{{__('Favicon')}}</label>
                            <input class="form-control" name="favicon" type="file" id="imageUrl" required>
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

<script>

    $(document).on('change','#category',function () {
        let link = $(this).find(':selected').attr('data-href');
        if(link != "")
        {
        $('#subcategory').load(link);
        $('#subcategory').prop('disabled',false);
        }
    });

    $(document).on('change','#subcategory',function () {
        let link = $(this).find(':selected').attr('data-href');
        if(link != "")
        {
        $('#childcategory').load(link);
        $('#childcategory').prop('disabled',false);
        }
    });

</script>
    
@endpush