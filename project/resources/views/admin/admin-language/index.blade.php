@extends('layouts.admin')

@section('title', __('Manage Admin Pannel Language'))
    
@section('content')


<div class="container mt-5">

  <div class="card mb-3">
    <div class="card-body">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style2 mb-0">
          <li class="breadcrumb-item {{ Request::is('admin/dashboard') ? 'active' : '' }}">
            <a href="{{ route('admin.dashboard.index')}}">{{__('Dashboard')}}</a>
          </li>
          <li class="breadcrumb-item {{ Request::is('admin/adminlanguage/index') ? 'active' : '' }}">
            <a href="{{ route('admin.adminlanguage.index')}}">{{__('Manage Admin Pannel Language')}}</a>
          </li>
        </ol>
      </nav>
    </div>
  </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="container mt-5">
                  <a href="{{ route('admin.adminlanguage.create') }}" class="btn btn-primary ml-2"><i class='bx bxs-message-square-add'></i>&nbsp;{{__('Add Language')}}</a>
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
                            <th>{{__('Status')}}</th>
                            <th>{{__('Actions')}}</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($languages as $key => $language)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $language->language }}</td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-{{ $language->is_default == 1 ? 'success' : 'danger' }} rounded-pill btn-success {{ $language->is_default == 0 ? 'dropdown-toggle' : '' }}" data-bs-toggle="{{ $language->is_default == 1 ? '' : 'dropdown' }}" aria-expanded="false">
                                          {{ $language->is_default == 1 ? __('Default') : __('Set Default') }}
                                        </button>
                                        <ul class="dropdown-menu" style="">
                                          @if ($language->is_default == 0)
                                          <li><a class="dropdown-item" href="{{ route('admin.adminlanguage.status', ['id1' => $language->id,  'id2' => 1]) }}"">{{__('Set Default')}}</a></li>
                                          @endif
                                        </ul>
                                    </div>
                                </td>
                                <td>
                                    <a href="{{ route('admin.adminlanguage.edit', $language->id) }}" class="btn btn-sm btn-info"><span class="bx bxs-edit"></span></a>
                                    <a href="{{ route('admin.adminlanguage.delete', $language->id) }}" class="btn btn-sm btn-danger" id="deleteConfirm"><i class="bx bx-message-square-x"></i></a>
                                </td>
                            </tr>
                        @endforeach
                      </tbody>
                    </table>
                    <div class="d-flex justify-content-center mt-3">
                      {{ $languages }}
                    </div>
                  </div>
                </div>
              </div>
        </div>
    </div>
</div>

@endsection

@push('js')

<script>
    
    $(document).on('click','#deleteButon', function (event) {
        event.preventDefault();
        let url = $(this).attr('action');
        swal({
            title: 'Are you sure?',
            text: 'This record and it`s details will be permanantly deleted!',
            icon: 'warning',
            buttons: ["Cancel", "Yes!"],
        }).then(function(value) {
            if (value) {
               $('form').submit();
            }
        });
    });

</script>

@endpush




{{-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

$('.delete-confirm').on('click', function (event) {
    event.preventDefault();
    const url = $(this).attr('href');
    swal({
        title: 'Are you sure?',
        text: 'This record and it`s details will be permanantly deleted!',
        icon: 'warning',
        buttons: ["Cancel", "Yes!"],
    }).then(function(value) {
        if (value) {
            window.location.href = url;
        }
    });
}); --}}