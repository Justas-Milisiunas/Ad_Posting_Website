<?php

namespace App\Http\Controllers;

use App\Ad;
use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class CommentsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param $ad_id
     * @return void
     * @throws ValidationException
     */
    public function store(Request $request, int $ad_id)
    {
        $this->validate($request, [
            'comment' => 'required|max:255'
        ]);

        if (!auth()->check()) {
            return redirect('/ads/' . $ad_id)->with('error', 'Unauthorized Page');
        }

        // Finds ad data from the database
        $ad = Ad::find($ad_id);

        // If ad not found or trying to reply to comment without being ad's creator returns error.
        if ($ad == null || $request->input('selected_comment') != null && $ad->user_id != auth()->user()->id) {
            return redirect('/ads/' . $ad_id)->with('error', 'Unauthorized Page');
        }

        // Store comment
        $comment = new Comment;
        $comment->message = $request->input('comment');
        $comment->user_id = auth()->user()->id;
        $comment->ad_id = $ad_id;

        if ($request->input('selected_comment') != null) {
            $comment->comment_id = $request->input('selected_comment');
        }

        $comment->save();

        return redirect('/ads/' . $ad_id)->with('success', 'Komentaras sėkmingai išsaugotas');
    }
}
