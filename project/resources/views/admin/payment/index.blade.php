@extends('layouts.admin')

@section('title', __('Manage Payment'))
    
@section('content')


<div class="container mt-5">

  <div class="card mb-3">
    <div class="card-body">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style2 mb-0">
          <li class="breadcrumb-item {{ Request::is('admin/dashboard') ? 'active' : '' }}">
            <a href="{{ route('admin.dashboard.index')}}">{{__('Dashboard')}}</a>
          </li>
          <li class="breadcrumb-item {{ Request::is('admin/payment/index') ? 'active' : '' }}">
            <a href="{{ route('admin.payment.index')}}">{{__('Manage payment')}}</a>
          </li>
        </ol>
      </nav>
    </div>
  </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
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
                            <th>{{__('status')}}</th>
                            <th>{{__('Actions')}}</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($payments as $key => $payment)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $payment->name }}</td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-{{ $payment->status == 1 ? 'success' : 'danger' }} rounded-pill btn-success dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                          {{ $payment->status == 1 ? __('Active') : __('Deactive') }}
                                        </button>
                                        <ul class="dropdown-menu" style="">
                                          <li><a class="dropdown-item" href="{{ route('admin.payment.status', ['id1' => $payment->id,  'id2' => 1]) }}">{{__('Active')}}</a></li>
                                          <li><a class="dropdown-item" href="{{ route('admin.payment.status', ['id1' => $payment->id,  'id2' => 0]) }}"">{{__('Deactive')}}</a></li>
                                        </ul>
                                    </div>
                                </td>
                                <td>
                                    <a href="{{ route('admin.payment.edit', $payment->id) }}" class="btn btn-sm btn-info"><span class="bx bxs-edit"></span></a>
                                </td>
                            </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
        </div>
    </div>
</div>

@endsection

@push('js')


@endpush



