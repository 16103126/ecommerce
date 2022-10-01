<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Reply;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function comment(Request $request)
    {
        $request->validate([
            'comment' => 'required'
        ]);

        $user = Auth::guard('web')->user();

        if(!$user)
        {
            return back()->with('message', 'Please, login.');
        }

        $comment = new Comment();

        $input = $request->all();
        $comment->user_id = $user->id;

        $comment->fill($input)->save();

        return back()->with('success', 'Comment submitted successfully.');

    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'comment' => 'required'
        ]);

        $comment = Comment::findOrFail($id);
        $comment->comment = $request->comment;
        $comment->update();

        return back()->with('success', 'Comment update successfully.');
    }

    public function delete($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();
        $comment->replies->each->delete();
        return back()->with('success', 'Comment delete successfully.');
    }

    public function reply(Request $request)
    {
        $request->validate([
            'reply' => 'required'
        ]);

        $input = $request->all();

        $reply = new Reply();

        $reply->fill($input)->save();

        return back()->with('success', 'Reply sent successfully.');
    }

    public function updateReply(Request $request, $id)
    {
        $request->validate([
            'reply' => 'required'
        ]);

        $input = $request->all();

        $reply = Reply::findOrFail($id);

        $reply->fill($input)->update();

        return back()->with('success', 'Reply update successfully.');
    }

    public function deleteReply($id)
    {
        $reply = Reply::findOrFail($id);
        $reply->delete();
        return back()->with('success', 'Reply delete successfully.');
    }
}
