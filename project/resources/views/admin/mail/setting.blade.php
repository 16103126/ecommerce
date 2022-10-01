@extends('layouts.admin')

@section('title', __('Mail setting'))
    
@section('content')

<div class="container mt-5">
    <div class="row">
        <div class="col-md-3">

        </div>
        <div class="col-md-6">

            <div class="card mb-3">
                <div class="card-body">
                    <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-style2 mb-0">
                        <li class="breadcrumb-item {{ Request::is('admin/dashboard') ? 'active' : '' }}">
                        <a href="{{ route('admin.dashboard.index')}}">{{__('Dashboard')}}</a>
                        </li>
                        <li class="breadcrumb-item {{ url()->current() ? 'active' : '' }}">
                        <a href="{{ route('admin.mail.setting', $mail->id)}}">{{__('Mail Setting')}}</a>
                        </li>
                    </ol>
                    </nav>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header d-flex justify-content-center mt-3">
                    <h3 class="d-flex justify-content-center text-primary">{{__('Mail Setting')}}</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.mail.update', $mail->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        @include('partials.message.error')
                        @include('partials.message.success')
                        @include('partials.message.message')

                        <div class="mb-3">
                            <label class="form-label" for="mail_driver">{{__('Mail Driver')}}</label>
                            <input type="text" name="mail_driver" class="form-control" id="mail_driver" value="{{ $mail->mail_driver }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="mail_host">{{__('Mail Host')}}</label>
                            <input type="text" name="mail_host" class="form-control" id="mail_host" value="{{ $mail->mail_host }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="mail_port">{{__('Mail Port')}}</label>
                            <input type="text" name="mail_port" class="form-control" id="mail_port" value="{{ $mail->mail_port }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="mail_username">{{__('Mail Username')}}</label>
                            <input type="text" name="mail_username" class="form-control" id="mail_username" value="{{ $mail->mail_username }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="mail_password">{{__('Mail Password')}}</label>
                            <input type="text" name="mail_password" class="form-control" id="mail_password" value="{{ $mail->mail_password }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="mail_encryption">{{__('Mail Encryption')}}</label>
                            <input type="text" name="mail_encryption" class="form-control" id="mail_encryption" value="{{ $mail->mail_encryption }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="from_mail">{{__('From Mail')}}</label>
                            <input type="text" name="from_mail" class="form-control" id="from_mail" value="{{ $mail->from_mail }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="from_name">{{__('From Name')}}</label>
                            <input type="text" name="from_name" class="form-control" id="from_name" value="{{ $mail->from_name }}">
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


    
@endpush