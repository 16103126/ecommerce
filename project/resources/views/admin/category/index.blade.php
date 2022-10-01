@extends('layouts.admin')

@section('title', __('Manage Category'))
    
@section('content')


<div class="container mt-5">
  <div class="card mb-3">
    <div class="card-body">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style2 mb-0">
          <li class="breadcrumb-item {{ Request::is('admin/dashboard') ? 'active' : '' }}">
            <a href="{{ route('admin.dashboard.index')}}">{{__('Dashboard')}}</a>
          </li>
          <li class="breadcrumb-item {{ Request::is('admin/category') ? 'active' : '' }}">
            <a href="{{ route('admin.category.index')}}">{{__('Manage Category')}}</a>
          </li>
        </ol>
      </nav>
    </div>
  </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="container mt-5">
                  <a href="{{ route('admin.category.create') }}" class="btn btn-primary ml-2"><i class='bx bxs-message-square-add'></i>&nbsp;{{__('Add Category')}}</a>
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
                            <th>{{__('Status')}}</th>
                            <th>{{__('Actions')}}</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($categories as $key => $category)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->slug }}</td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-{{ $category->status == 1 ? 'success' : 'danger' }} rounded-pill btn-success dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                          {{ $category->status == 1 ? __('Active') : __('Deactive') }}
                                        </button>
                                        <ul class="dropdown-menu" style="">
                                          <li><a class="dropdown-item" href="{{ route('admin.category.status', ['id1' => $category->id,  'id2' => 1]) }}">{{__('')}}Active</a></li>
                                          <li><a class="dropdown-item" href="{{ route('admin.category.status', ['id1' => $category->id,  'id2' => 0]) }}"">{{__('')}}Deactive</a></li>
                                        </ul>
                                    </div>
                                </td>
                                <td>
                                    <a href="{{ route('admin.category.edit', $category->id) }}" class="btn btn-sm btn-info"><span class="bx bxs-edit"></span></a>
                                    <a href="{{ route('admin.category.delete', $category->id) }}" class="btn btn-sm btn-danger" id="deleteConfirm"><i class="bx bx-message-square-x"></i></a>
                                    {{-- <form action="{{ route('admin.category.destroy', $category->id) }}" method="POST">
                                      @csrf
                                      @method('DELETE')
                                      <button type="submit" id="deleteButon" class="btn btn-sm btn-danger"><i class='bx bx-message-square-x' ></i></button>
                                    </form> --}}
                                </td>
                            </tr>
                        @endforeach
                      </tbody>
                    </table>
                    <div class="d-flex justify-content-center mt-3">
                      {{ $categories->links() }}
                    </div>
                  </div>
                </div>
              </div>
        </div>
    </div>
</div>

@endsection

@push('js')
{{-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>

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
}); 

</script> --}}

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