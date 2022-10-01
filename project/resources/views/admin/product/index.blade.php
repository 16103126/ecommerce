@extends('layouts.admin')

@section('title', __('Manage Product'))
    
@section('content')


<div class="container mt-5">

  <div class="card mb-3">
    <div class="card-body">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style2 mb-0">
          <li class="breadcrumb-item {{ Request::is('admin/dashboard') ? 'active' : '' }}">
            <a href="{{ route('admin.dashboard.index')}}">{{__('Dashboard')}}</a>
          </li>
          <li class="breadcrumb-item {{ Request::is('admin/product/index') ? 'active' : '' }}">
            <a href="{{ route('admin.product.index')}}">{{__('Manage Product')}}</a>
          </li>
        </ol>
      </nav>
    </div>
  </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="container mt-5">
                  <a href="{{ route('admin.product.create') }}" class="btn btn-primary ml-2"><i class='bx bxs-message-square-add'></i>&nbsp;{{__('Add Product')}}</a>
                </div>
                <div class="card-body">
                  @include('partials.message.success')
                  @include('partials.message.error')
                  @include('partials.message.message')
                  <div class="table-responsive text-nowrap">
                    <table class="table table-bordered table-hover">
                      <thead>
                        <tr>
                            <th>{{__('S.l')}}</th>
                            <th>{{__('Name')}}</th>
                            <th>{{__('Slug')}}</th>
                            <th>{{__('Image')}}</th>
                            <th>{{__('Price')}}</th>
                            <th>{{__('Quantity')}}</th>
                            <th>{{__('status')}}</th>
                            <th>{{__('Actions')}}</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($products as $key => $product)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->slug }}</td>
                                <td>
                                    <img src="{{ asset('assets/admin/image/products/'.$product->image) }}" alt="" width="100px">
                                </td>
                                <td>{{ $product->selling_price }}</td>
                                <td>{{ $product->quantity }}</td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-{{ $product->status == 1 ? 'success' : 'danger' }} rounded-pill btn-success dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                          {{ $product->status == 1 ? __('Active') : __('Deactive') }}
                                        </button>
                                        <ul class="dropdown-menu" style="">
                                          <li><a class="dropdown-item" href="{{ route('admin.product.status', ['id1' => $product->id,  'id2' => 1]) }}">{{__('Active')}}</a></li>
                                          <li><a class="dropdown-item" href="{{ route('admin.product.status', ['id1' => $product->id,  'id2' => 0]) }}"">{{__('Deactive')}}</a></li>
                                        </ul>
                                    </div>
                                </td>
                                <td>
                                    <a href="{{ route('admin.product.edit', $product->id) }}" class="btn btn-sm btn-info"><span class="bx bxs-edit"></span></a>
                                    <a href="{{ route('admin.product.show', $product->id) }}" class="btn btn-sm btn-success"><i class='bx bx-show' ></i></a>
                                    <a href="{{ route('admin.product.delete', $product->id) }}" class="btn btn-sm btn-danger" id="deleteConfirm"><i class='bx bx-message-square-x' ></i></span></a>
                                </td>
                            </tr>
                        @endforeach
                      </tbody>
                    </table>
                    <div class="d-flex justify-content-center mt-3">
                      {{ $products->links() }}
                    </div>
                  </div>
                </div>
              </div>
        </div>
    </div>
</div>

@endsection

@push('js')


@endpush



