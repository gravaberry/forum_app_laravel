<?php

namespace App\Http\Controllers;

use App\Models\feed;
use App\Http\Requests\StorefeedRequest;
use App\Http\Requests\UpdatefeedRequest;
use App\Models\comment;
use App\Models\like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $feeds = feed::with('user')->latest()->get();
        return response()->json(['feeds'=>$feeds],200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorefeedRequest $request)
    {
        $request->validated();
        // $user =auth()->user()->id;
        $feeds= feed::create([
            'user_id' =>auth()->user()->id,
            'content' => $request->content
        ],200);
        return response([
            'feed'=>$feeds,
        ],200);
    }

    /**
     * Display the specified resource.
     */
    public function likepost($feed_id)
    {
        $feed = feed::whereId($feed_id)->first();
        if(!$feed)
        {
            return response([
                'message'=>'Not Found',
            ],500);
        }

        $unlike_post = like::where('user_id',auth()->id())->where('feed_id', $feed_id)->delete();
        if($unlike_post)
        {
            return response([
                'message'=>'Unliked'
            ],200);
        }

        $like_post = like::create(
            [
                'user_id'=>auth()->user()->id,
                'feed_id'=>$feed_id,

            ]
        );
        if($like_post)
        {
            return response([
                'message'=> 'Liked',
            ],200);
        }

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function comment(Request $request, $feed_id)
    {
        $request->validate([
            'comment'=>'required'
        ]);

        comment::create([
            'user_id'=>auth()->user()->id,
            'feed_id'=>$feed_id,
            'comment'=>$request->comment,
        ]);

        return response([
            'message'=>'Sucess Comment'
        ],200);
    }



    /**
     * Update the specified resource in storage.
     */
    public function getComment($feed_id)
    {
        $comment =comment::with('feed')->with('user')->whereFeedId($feed_id)->latest()->get();

        return response(
            [
                'comments'=>$comment,
            ],
        200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(feed $feed)
    {
        //
    }
}
