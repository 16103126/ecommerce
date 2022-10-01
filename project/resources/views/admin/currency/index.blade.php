@extends('layouts.admin')

@section('title', __('Manage Currency'))
    
@section('content')


<div class="container mt-5">

  <div class="card mb-3">
    <div class="card-body">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style2 mb-0">
          <li class="breadcrumb-item {{ Request::is('admin/dashboard') ? 'active' : '' }}">
            <a href="{{ route('admin.dashboard.index')}}">{{__('Dashboard')}}</a>
          </li>
          <li class="breadcrumb-item {{ Request::is('admin/currency/index') ? 'active' : '' }}">
            <a href="{{ route('admin.currency.index')}}">{{__('Manage currency')}}</a>
          </li>
        </ol>
      </nav>
    </div>
  </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="container mt-5">
                    <a href="{{ route('admin.currency.create') }}" class="btn btn-primary ml-2"><i class='bx bxs-message-square-add'></i>&nbsp;{{__('Add Currency')}}</a>
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
                            <th>{{__('Sign')}}</th>
                            <th>{{__('Value')}}</th>
                            <th>{{__('status')}}</th>
                            <th>{{__('Actions')}}</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($currencies as $key => $currency)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $currency->name }}</td>
                                <td>{{ $currency->sign }}</td>
                                <td>{{ $currency->value }}</td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-{{ $currency->is_default == 1 ? 'success' : 'danger' }} rounded-pill btn-success {{ $currency->is_default == 0 ? 'dropdown-toggle' : '' }}" data-bs-toggle="{{ $currency->is_default == 1 ? '' : 'dropdown' }}" aria-expanded="false">
                                          {{ $currency->is_default == 1 ? __('Default') : __('Set Default') }}
                                        </button>
                                        <ul class="dropdown-menu" style="">
                                          @if ($currency->is_default == 0)
                                          <li><a class="dropdown-item" href="{{ route('admin.currency.status', ['id1' => $currency->id,  'id2' => 1]) }}"">{{__('Set Default')}}</a></li>
                                          @endif
                                        </ul>
                                    </div>
                                </td>
                                <td>
                                    <a href="{{ route('admin.currency.edit', $currency->id) }}" class="btn btn-sm btn-info"><span class="bx bxs-edit"></span></a>
                                    <a href="{{ route('admin.currency.delete', $currency->id) }}" class="btn btn-sm btn-danger"><i class="bx bx-message-square-x"></i></a>
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



