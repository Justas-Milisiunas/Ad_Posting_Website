<?php

namespace App\Http\Controllers;

use App\Ad;
use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AdsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $ads = Ad::orderBy('created_at', 'desc')->paginate(9);
        return view('ads.index')->with('ads', $ads);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        if (auth()->user()->role != 1) {
            return redirect('/ads')->with('error', 'Unauthorized Page');
        }

        return view('ads.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        // If not registered user
        if (auth()->user()->role != 1) {
            return redirect('/')->with('error', 'Unauthorized Page');
        }

        $this->validate($request, [
            'name' => 'required|max:255|min:4',
            'price' => 'required|min:1',
            'description' => 'required|min:4',
            'images' => 'required|min:1|max:3'
        ]);

        $new_ad = new Ad;
        $new_ad->name = $request->input('name');
        $new_ad->description = $request->input('description');
        $new_ad->price = $request->input('price');
        $new_ad->user_id = auth()->user()->id;
        $new_ad->expiration = $request->input('expiration');
        $new_ad->save();

        $saved_ad = Ad::find(DB::getPdo()->lastInsertId());

        foreach ($request->file('images') as $i=>$image) {
            $image->store('public/images/'.$saved_ad->id);
        }

        return redirect('/')->with('success', 'Skelbimas sėkmingai sukurtas');
    }

    /**
     * Display ad information. Loads comments data for dropdown list
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $ad = Ad::find($id);
        $comments = null;

        if (auth()->user()->id == $ad->user_id) {
            $comments = Comment::where('ad_id', $id)->where('comment_id', null)->pluck('message', 'id')->toArray();
        }

        return view('ads.show')->with('ad', $ad)->with('comments', $comments);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $ad = Ad::find($id);

        // TODO: active user authentication
//        if(auth()->user()->id != $ad->user_id ||
//        auth()->user()->role != 1) {
//            return redirect('/ads')->with('error', 'Unauthorized Page');
//        }

        return view('ads.edit')->with('ad', $ad);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $post = Ad::find($id);

        // TODO: add access control
        $post->delete();
        return redirect('/ads')->with('success', 'Skelbimas sėkmingai panaikintas');
    }
}
