@extends('layouts.user')

@section('title', __('Message'))
    
@section('content')

<div class="container mt-5">
    @include('partials.message.success')
    @include('partials.message.error')
    @include('partials.message.message')
    <div class="row">
        <div class="col-sm-1">

        </div>
        <div class="col-md-6">
            <div class="card shadow-none">
                <div class="card-body text-dark">
                    <div class="row">
                        <div class="col-10 border border-2 p-3 border-primary">
                            <p class="text-dark">{{$message->message}}</p>
                            @if ($message->file)
                            <a href="{{ route('user.ticket.file.download', $message->file) }}"><i class='bx bx-file display-6'></i></a>
                            @endif
                            <a href="{{ route('user.ticket.message.edit', $message->id) }}"><i class='bx bx-edit display-6'></i></a>
                            <a href="{{ route('user.ticket.delete', $message->id) }}"><i class='bx bx-message-square-x display-6'></i></a>
                        </div>
                        <div class="col-2 border border-2 p-3 border-primary">
                            <img src="{{ $message->type == 'user' ? asset('assets/user/image/profile/'.Auth::guard('web')->user()->image) : asset('assets/admin/image/profile/'.DB::table('admins')->where('id', $message->sender_id)->first()->image) }}" alt="" width="60" class="border border-3 border-primary h-auto rounded-circle">
                            <p class=" fw-bold ms-3">{{ $message->type == 'user' ? Auth::guard('web')->user()->name : DB::table('admins')->where('id', $message->sender_id)->first()->name }}</p>
                        </div>
                    </div>
                    @foreach ($message->replyTickets as $reply)
                    <br>
                    <div class="row ms-5">
                        <div class="col-10 border border p-3 border-primary">
                            <p class="text-dark">{{$reply->reply}}</p>
                            @if ($reply->file)
                            <a href="{{ route('user.ticket.file.download', $reply->file) }}"><i class='bx bx-file display-6'></i></a>
                            @endif
                            <a href="{{ route('user.ticket.message.reply.edit', $reply->id) }}"><i class='bx bx-edit display-6'></i></a>
                            <a href="{{ route('user.ticket.message.reply.delete', $reply->id) }}"><i class='bx bx-message-square-x display-6'></i></a>
                        </div>
                        <div class="col-2 border border p-3 border-primary">
                            <img src="{{ $reply->type == 'user' ? asset('assets/user/image/profile/'.Auth::guard('web')->user()->image) : asset('assets/admin/image/profile/'.DB::table('admins')->where('id', $reply->sender_id)->first()->image)}}" alt="" width="60" class="border border-3 border-primary h-auto rounded-circle">
                            <p class=" fw-bold ms-3">{{ $reply->type == 'user' ? Auth::guard('web')->user()->name : DB::table('admins')->where('id', $reply->sender_id)->first()->name}}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="card mt-3 bg-light shadow-none">
                <div class="card-body">
                    <form action="{{ route('user.ticket.message.reply')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <input type="hidden" name="ticket_id" value="{{$message->id}}">
                        </div>
                        <div class="mb-3">
                            <textarea name="reply" id="reply" rows="5" class="form-control" placeholder="{{__('Enter reply')}}" required></textarea>
                        </div>
                        <div class="mb-3">
                            <input type="file" name="file" class="form-control" id="file">
                        </div>
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary mt-3">{{__('Reply')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
    </div>
</div>

@endsection