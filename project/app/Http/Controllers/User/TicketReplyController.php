<?php

namespace App\Http\Controllers\User;

use App\Models\Ticket;
use App\Models\ReplyTicket;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TicketReplyController extends Controller
{
    public function reply(Request $request)
    {
        $request->validate([
            'reply' => 'required',
            'file' => 'mimes:jpg,png,jpeg,zip,csv,txt,xlx,xls,pdf|max:1024'
        ]);

        $reply = new ReplyTicket();

        $input = $request->all();

        if($file = $request->file('file')){

            $fileName = time().str_replace(' ', '', $file->getClientOriginalName());
            $file->move('assets/ticket', $fileName);
            $input['file'] = $fileName;
        }

        $reply->type = 'user';

        $reply->sender_id = auth()->user()->id;

        $reply->fill($input)->save();

        return back()->with('success', 'Reply sent successfully.');
    }

    public function edit($id)
    {
        $reply = ReplyTicket::findOrFail($id);

        return view('user.ticket.reply-message-edit', compact('reply'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'reply' => 'required',
            'file' => 'mimes:jpg,png,jpeg,zip,csv,txt,xlx,xls,pdf|max:1024'
        ]);

        $reply = ReplyTicket::findOrFail($id);

        $input = $request->all();

        if($file = $request->file('file')){

            $fileName = time().str_replace(' ', '', $file->getClientOriginalName());
            $file->move('assets/ticket', $fileName);

            if($reply->file){
                if(file_exists('assets/ticket/'.$reply->file)){
                    @unlink('assets/ticket/'.$reply->file);
                }

                $input['file'] = $fileName;
            }

        }

        $reply->fill($input)->save();

        return back()->with('success', 'Reply Update successfully.');
    }

    public function delete($id)
    {
        $reply = ReplyTicket::findOrFail($id);
        $reply->delete();

        if($reply->file){
            if(file_exists('assets/ticket/'.$reply->file)){
                @unlink('assets/ticket/'.$reply->file);
            };
        }

        return back()->with('success', 'Reply delete successfully.');
        
    }
}
