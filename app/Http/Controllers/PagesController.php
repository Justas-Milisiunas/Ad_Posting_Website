<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index() {
        return redirect('/ads');
    }

    public function about() {
        return view('about');
    }
}
