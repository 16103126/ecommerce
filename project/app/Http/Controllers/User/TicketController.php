<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Models\Admin;
use App\Models\Ticket;
use App\Models\ReplyTicket;
use App\Models\Conversation;
use Illuminate\Http\Request;
use App\Models\ReplyConversation;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use App\Notifications\TicketNotification;
use Illuminate\Support\Facades\Notification;

class TicketController extends Controller
{
    // public function index()
    // {
    //     $tickets = Conversation::paginate(10);

    //     return view('user.ticket.index', compact('tickets'));
    // }

    // public function create()
    // {
    //     return view('user.ticket.create');
    // }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'email' => 'required|email',
    //         'subject' => 'required',
    //         'message' => 'required'
    //     ]);

    //     $conversation = new Conversation();
    //     $conversation->subject = $request->subject;
    //     $conversation->message = $request->message;

    //     if(User::where('email', $request->email)->first())
    //     {

    //         $receiver = User::where('email', $request->email)->first();

    //         $conversation->receiver_id = $receiver->id;
    //         $conversation->sender_id = Auth::guard('web')->user()->id;

    //         $conversation->save();

    //         return back()->with('success', 'Message sent successfully.');
            
    //     }elseif(Admin::Where('email', $request->email)->first()){

    //         $receiver = Admin::where('email', $request->email)->first();

    //         $conversation->receiver_id = $receiver->id;
    //         $conversation->sender_id = Auth::guard('web')->user()->id;

    //         $conversation->save();

    //         return back()->with('success', 'Message sent successfully.');

    //     }else{

    //         return back()->with('message', 'Invalid email');
    //     }

    // }

    // public function message($id)
    // {
    //     $message = Conversation::findOrFail($id);

    //     return view('user.ticket.message', compact('message'));
    // }

    // public function reply(Request $request)
    // {
    //     $request->validate([
    //         'reply' => 'required'
    //     ]);

    //     $reply = new ReplyConversation();

    //     $reply->reply_message = $request->reply;

    //     $reply->conversation_id = $request->conversation_id;

    //     $reply->save();

    //     return back()->with('success', 'Reply sent successfully.');
    // }

    // public function delete($id)
    // {
    //     $conversation = Conversation::findOrFail($id);

    //     $conversation->delete();

    //     return back()->with('successs', 'Message delete successfully.');
    // }

    public function index()
    {
        $tickets = Ticket::where('sender_id', auth()->user()->id)->orWhere('receiver_id', auth()->user()->id)->paginate(10);

        return view('user.ticket.index', compact('tickets'));
    }

    public function create()
    {
        return view('user.ticket.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'message' => 'required',
            'subject' => 'required',
            'email' => 'required|email',
            'file' => 'mimes:jpg,png,jpeg,zip,csv,txt,xlx,xls,pdf|max:1024',
        ]);

        $input = $request->all();

        $ticket = new Ticket();

        $receiver = Admin::where('email', $request->email)->first();
        
        if(!$receiver)
        {
            return back()->with('message', 'Invalid email.');
        }

        if($file = $request->file('file')){

            $fileName = time().str_replace(' ', '', $file->getClientOriginalName());
            $file->move('assets/ticket', $fileName);
            $input['file'] = $fileName;
        }

        $sender = auth()->user();

        $ticket->sender_id = $sender->id;
        $ticket->receiver_id = $receiver->id;
        $ticket->type = 'user';

        $ticket->fill($input)->save();

        // Notification::send($request->email, new TicketNotification($ticket));

        return back()->with('success', 'Message sent successfully.');

    }

    public function message($id)
    {
        $message = Ticket::findOrFail($id);

        return view('user.ticket.message', compact('message'));
    }

    public function editMessage($id)
    {
        $message = Ticket::findOrFail($id);

        return view('user.ticket.message-edit', compact('message'));
    }

    public function updateMessage(Request $request, $id)
    {
        $request->validate([
            'message' => 'required',
            'file' => 'mimes:jpg,png,jpeg,zip,csv,txt,xlx,xls,pdf|max:1024',
        ]);

        $input = $request->all();

        $ticket = Ticket::findOrFail($id);

        if($file = $request->file('file')){

            $fileName = time().str_replace(' ', '', $file->getClientOriginalName());
            $file->move('assets/ticket', $fileName);

            if($ticket->file){
                if(file_exists('assets/ticket/'.$ticket->file)){
                    @unlink('assets/ticket/'.$ticket->file);
                }
            }

            $input['file'] = $fileName;
        }

        $ticket->fill($input)->update();

        return back()->with('success', 'Message update successfully.');
    }

    public function downloadFile($file)
    {
        $path = 'assets/ticket/'.$file;

        $fileName = $file;

        return response()->download($path, $fileName);
    }

    public function delete($id)
    {
        $ticket = Ticket::findOrFail($id);

        $ticket->delete();

        $ticket->replyTickets->each->delete();

        if($ticket->file){

            if(file_exists('assets/ticket/'.$ticket->file)){
                @unlink('assets/ticket/'.$ticket->file);
            }
        }

        return redirect()->route('user.ticket.index')->with('successs', 'Message delete successfully.');
    }

}
