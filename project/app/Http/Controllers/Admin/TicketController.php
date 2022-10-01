<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Admin;
use App\Models\Ticket;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::paginate(10);

        return view('admin.ticket.index', compact('tickets'));
    }

    public function create()
    {
        return view('admin.ticket.create');
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

        $receiver = User::where('email', $request->email)->first();

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
        $ticket->type = 'admin';

        $ticket->fill($input)->save();

        return back()->with('success', 'Message sent successfully.');

    }

    public function message($id)
    {
        $message = Ticket::findOrFail($id);

        return view('admin.ticket.message', compact('message'));
    }

    public function editMessage($id)
    {
        $message = Ticket::findOrFail($id);

        return view('admin.ticket.message-edit', compact('message'));
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

        return redirect()->route('admin.ticket.index')->with('successs', 'Message delete successfully.');
    }

}
