<?php

namespace App\Http\Controllers;

use App\Reply;
use App\Thread;
use Illuminate\Http\Request;

class RepliesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param Thread $thread
     * @param Channel $channelId
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $channelId, Thread $thread)
    {
        $this->validate(request(), [
            'body' => 'required',
        ]);

        // Adding a reply to a thread
        $thread->addReply([
            'body' => request('body'),
            'user_id' => auth()->id(),
        ]);

        return back();
    }
}
