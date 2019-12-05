<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function root()
    {
        return view('pages.home');
    }

    public function emailVerifiedNotice(){
        return view('pages.email_verify_page');
    }
}
