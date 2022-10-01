@extends('layouts.admin')

@section('title', __('Pending Order'))
    
@section('content')

<div class="container mt-5">
    <div class="card mb-3">
        <div class="card-body">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-style2 mb-0">
              <li class="breadcrumb-item {{ Request::is('admin/dashboard') ? 'active' : '' }}">
                <a href="{{ route('admin.dashboard.index')}}">{{__('Dashboard')}}</a>
              </li>
              <li class="breadcrumb-item {{ Request::is('admin/pending/order') ? 'active' : '' }}">
                  <a href="{{ route('admin.pending.order')}}">{{__('Pending Order')}}</a>
              </li>
            </ol>
          </nav>
        </div>
      </div>
  
      <div class="row">
          <div class="col-md-12">
              <div class="card">
                  <div class="container mt-5">
                   <h5>@lang('Pending Order')</h5>
                  </div>
                  <div class="card-body">
                    @include('partials.message.success')
                    @include('partials.message.error')
                    @include('partials.message.message')
                    <div class="table-responsive text-nowrap">
                      <table class="table table-bordered table-hover">
                        <thead>
                          <tr>
                              <th>{{__('Order')}}</th>
                              <th>{{__('Date')}}</th>
                              <th>{{__('Total Price')}}</th>
                              <th>{{__('Status')}}</th>
                              <th>{{__('Actions')}}</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($orders as $key => $order)
                              <tr>
                                  <td>{{ $order->order_number }}</td>
                                  <td>{{ $order->created_at->format('d M, Y.  H:i A') }}</td>
                                  @php
                                      $total_price = 0;
                                      foreach ($order->orderDetails as $key => $oorder) {
                                          $price = ($oorder->quantity * $oorder->price) + ($oorder->tax * $oorder->quantity);
                                      }
                                  @endphp
                                  <td>{{ currencySign() }}{{ $total_price += $price * currencyValue() }}</td>
                                  <td>
                                      @if ($order->status == 0)
                                      <span class="badge bg-info">@lang('Pending')</span>
                                      @else
                                      <span class="badge bg-danger">@lang('Complete')</span>
                                      @endif
                                  </td>
                                  <td>
                                    <div class="dropdown">
                                        <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                          @lang('Action')
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                          <li><a class="dropdown-item" href="{{ route('admin.order.details', $order->id) }}">@lang('Details')</a></li>
                                         @if ($order->status == 0)
                                         <li><a class="dropdown-item" href="{{ route('admin.order.status', ['id1' => $order->id, 'id2' => 1])}}">@lang('Order complete')</a></li>
                                         @endif
                                        </ul>
                                      </div>
                                  </td>
                              </tr>
                          @endforeach
                        </tbody>
                      </table>
                      <div class="d-flex justify-content-center mt-3">
                        {{ $orders->links() }}
                      </div>
                    </div>
                  </div>
                </div>
          </div>
      </div>
  </div>

@endsection