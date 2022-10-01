@extends('layouts.admin')

@section('title', __('Manage Role'))
    
@section('content')

<div class="container mt-5">
  <div class="card mb-3">
    <div class="card-body">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style2 mb-0">
          <li class="breadcrumb-item {{ Request::is('admin/dashboard') ? 'active' : '' }}">
            <a href="{{ route('admin.dashboard.index')}}">{{__('Dashboard')}}</a>
          </li>
          <li class="breadcrumb-item {{ Request::is('admin/role*') ? 'active' : '' }}">
            <a href="{{ route('admin.role.index')}}">{{__('Manage Role')}}</a>
          </li>
        </ol>
      </nav>
    </div>
  </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="container mt-5">
                  <a href="{{ route('admin.role.create') }}" class="btn btn-primary ml-2"><i class='bx bxs-message-square-add'></i>&nbsp;{{__('Add Role')}}</a>
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
                            <th>{{__('Permission')}}</th>
                            <th>{{__('Actions')}}</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($roles as $key => $role)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $role->name }}</td>
                                <td>{{ $role->permission }}</td>
                                <td>
                                    <a href="{{ route('admin.role.edit', $role->id) }}" class="btn btn-sm btn-info"><span class="bx bxs-edit"></span></a>
                                    <a href="{{ route('admin.role.delete', $role->id) }}" class="btn btn-sm btn-danger" id="deleteConfirm"><i class="bx bx-message-square-x"></i></a>
                                </td>
                            </tr>
                        @endforeach
                      </tbody>
                    </table>
                    <div class="d-flex justify-content-center mt-3">
                      {{ $roles->links() }}
                    </div>
                  </div>
                </div>
              </div>
        </div>
    </div>
</div>

@endsection
