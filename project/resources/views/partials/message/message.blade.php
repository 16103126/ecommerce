@if(session('message'))
    <div class="alert alert-info alert-dismissible" role="alert">
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        <p>{{session('message')}}</p>
    </div>
@endif