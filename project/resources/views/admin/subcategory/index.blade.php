@extends('layouts.admin')

@section('title', __('Manage Sub Category'))
    
@section('content')


<div class="container mt-5">

  <div class="card mb-3">
    <div class="card-body">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style2 mb-0">
          <li class="breadcrumb-item {{ Request::is('admin/dashboard') ? 'active' : '' }}">
            <a href="{{ route('admin.dashboard.index')}}">{{__('Dashboard')}}</a>
          </li>
          <li class="breadcrumb-item {{ Request::is('admin/subcategory') ? 'active' : '' }}">
            <a href="{{ route('admin.subcategory.index')}}">{{__('Manage SubCategory')}}</a>
          </li>
        </ol>
      </nav>
    </div>
  </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="container mt-5">
                  <a href="{{ route('admin.subcategory.create') }}" class="btn btn-primary ml-2"><i class='bx bxs-message-square-add'></i>&nbsp;{{__('Add SubCategory')}}</a>
                </div>
                <div class="card-body">
                  @include('partials.message.success')
                  @include('partials.message.error')
                  @include('partials.message.message')
                  <div class="table-responsive text-nowrap">
                    <table class="table table-bordered table-hover">
                      <thead>
                        <tr>
                            <th>{{ __('S.l') }}</th>
                            <th>{{ __('Name') }}</th>
                            <th>{{ __('Slug') }}</th>
                            <th>{{ __('Category') }}</th>
                            <th>{{ __('Status') }}</th>
                            <th>{{ __('Actions') }}</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($subcats as $key => $subcat)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $subcat->name }}</td>
                                <td>{{ $subcat->slug }}</td>
                                <td>{{ $subcat->category->name }}</td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-{{ $subcat->status == 1 ? 'success' : 'danger' }} rounded-pill btn-success dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                          {{ $subcat->status == 1 ? __('Active') : __('Deactive') }}
                                        </button>
                                        <ul class="dropdown-menu" style="">
                                          <li><a class="dropdown-item" href="{{ route('admin.subcategory.status', ['id1' => $subcat->id,  'id2' => 1]) }}">{{ __('Active') }}</a></li>
                                          <li><a class="dropdown-item" href="{{ route('admin.subcategory.status', ['id1' => $subcat->id,  'id2' => 0]) }}">{{ __('Deactive') }}</a></li>
                                        </ul>
                                    </div>
                                </td>
                                <td>
                                    <a href="{{ route('admin.subcategory.edit', $subcat->id) }}" class="btn btn-sm btn-info"><span class="bx bxs-edit"></span></a>
                                    <a href="{{ route('admin.subcategory.delete', $subcat->id) }}" class="btn btn-sm btn-danger" id="deleteConfirm"><i class="bx bx-message-square-x"></i></a>
                                    {{-- <form action="{{ route('admin.subcategory.destroy', $subcat->id) }}" method="POST">
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
                      {{ $subcats->links() }}
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

// $(document).on('click','#deleteButon', function (event) {
//         event.preventDefault();
//         let url = $(this).attr('action');
//         // swal({
//         //     title: 'Are you sure?',
//         //     text: 'This record and it`s details will be permanantly deleted!',
//         //     icon: 'warning',
//         //     buttons: ["Cancel", "Yes!"],
//         // }).then(function(value) {
//         //     if (value) {
//         //      alert('ok')
//         //     }
//         // });
//     });
    
    // $(document).on('click','#deleteButon', function (event) {
    //     event.preventDefault();
    //     let url = $(this).attr('action');
    //     swal({
    //         title: 'Are you sure?',
    //         text: 'This record and it`s details will be permanantly deleted!',
    //         icon: 'warning',
    //         buttons: ["Cancel", "Yes!"],
    //     }).then(function(value) {
    //         if (value) {
    //           $('form').on('submit', function(e){

    //               e.preventDefault();
    //               let url = $(this).attr('action');
    //               let method = $(this).attr('method');

    //               $.ajax({

    //                 url          : url,
    //                 type         : method,
    //                 data         : new FormData(this),
    //                 cache        : false,
    //                 processData  : false,
    //                 contentType  : false,

    //               });

    //           });
    //         }
    //     });
    // });

</script>

@endpush

{{-- $(document).on('click','#deleteButon', function () {
  swal({
      title: 'Are you sure?',
      text: 'This record and it`s details will be permanantly deleted!',
      icon: 'warning',
      buttons: ["Cancel", "Yes!"],
  }).then(function(value) {
      if (value) {

        $('form').on('submit', function(e){
        e.preventDefault();
        let url = $(this).attr('action');
        let method = $(this).attr('method');

        $.ajax({

          url          : url,
          type         : method,
          data         : new FormData(this),
          cache        : false,
          processData  : false,
          contentType  : false,

        });
      });
      }
      
  });

})
  
}); --}}




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