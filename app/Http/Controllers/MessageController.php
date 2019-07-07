<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use App\Events\MessageSent;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::get();
        if(request()->wantsJson()){
            return $messages;
        }
        return view('message');
    }

    public function store(Request $request)
    {
        $message = new Message;
        $content = $request->content;
        $message->content = $content;
        $message->uuid = $request->uuid;
        $message->save();
        // dd($message);
        broadcast(new MessageSent($message));
        return $message;
    }
}
