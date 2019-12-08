<?php

namespace App\Http\Controllers;

use App\Ad;
use App\Comment;
use App\Image as Img;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Intervention\Image\Facades\Image;
use Symfony\Component\Console\Input\Input;

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
        if (auth()->user()->role != 1 ||
            auth()->user()->create_ad == false) {
            return redirect('/ads')->with('error', 'Unauthorized Page');
        }

        return view('ads.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        // If not registered user
        if (auth()->user()->role != 1 ||
            auth()->user()->create_ad == false) {
            return redirect('/')->with('error', 'Unauthorized Page');
        }

        $this->validate($request, [
            'name' => 'required|max:255|min:4',
            'price' => 'required|min:1',
            'description' => 'required|min:4',
            'images' => 'required|min:1|max:3',
            'expiration' => 'required'
        ]);

        $new_ad = new Ad;
        $new_ad->name = $request->input('name');
        $new_ad->description = $request->input('description');
        $new_ad->price = $request->input('price');
        $new_ad->user_id = auth()->user()->id;
        $new_ad->expiration = $request->input('expiration');
        $new_ad->save();

        $saved_ad = Ad::find(DB::getPdo()->lastInsertId());
        if (!file_exists(storage_path('app/public/uploads/' . $saved_ad->id))) {
            Storage::disk('local')->makeDirectory('public/uploads/' . $saved_ad->id);
        }

        foreach ($request->file('images') as $i => $image) {
            $file_name = time() . '' . $i . '.' . $image->getClientOriginalExtension();
            Image::make($image->getRealPath())
                ->resize(600, 400)
                ->insert(storage_path('app/watermark.png'), 'bottom-right', 10, 10)
                ->save(storage_path('app/public/uploads/' . $saved_ad->id . '/' . $file_name));

            $new_image = new Img;
            $new_image->link = $saved_ad->id . '/' . $file_name;
            $new_image->ad_id = $saved_ad->id;
            $new_image->save();
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

        if (auth()->check() && auth()->user()->id == $ad->user_id) {
            $comments = Comment::where('ad_id', $id)->where('comment_id', null)->pluck('message', 'id')->toArray();
        }

        $ad->views += 1;
        $ad->save();

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
        if (!auth()->check() ||
            auth()->user()->role != 1 ||
            auth()->user()->id != $ad->user->id) {
            return redirect('/ads/' . $ad->id)->with('error', 'Unauthorized Page');
        }

        return view('ads.edit')->with('ad', $ad);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     * @throws ValidationException
     */
    public function update(Request $request, $id)
    {
        $ad = Ad::find($id);
        // If not registered user
        if ($ad == null ||
            auth()->user()->role != 1 ||
            auth()->user()->create_ad == false ||
            auth()->user()->id != $ad->user->id) {
            return redirect('/')->with('error', 'Unauthorized Page');
        }

        $this->validate($request, [
            'name' => 'required|max:255|min:4',
            'price' => 'required|min:1',
            'description' => 'required|min:4',
            'expiration' => 'required'
        ]);

        $ad->name = $request->input('name');
        $ad->description = $request->input('description');
        $ad->price = $request->input('price');
        $ad->expiration = $request->input('expiration');
        $ad->save();

        return redirect('/ads/'.$ad->id)->with('success', 'Skelbimas sėkmingai atnaujintas');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        if (!auth()->check() ||
            auth()->user()->role != 3) {
            return redirect('/')->with('error', 'Unauthorized Page');
        }
        $post = Ad::find($id);

        // TODO: add access control
        $post->delete();
        return redirect('/ads')->with('success', 'Skelbimas sėkmingai panaikintas');
    }
}
