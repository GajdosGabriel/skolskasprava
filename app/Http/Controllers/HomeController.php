<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('tutorial');
    }


    public function index()
    {

        if(auth()->check())
        {
                if($user = auth()->user()->hasRole(1)) {
                    return view('pages.admin', compact($user));
                }

                if($user =auth()->user()->hasRole(2)) {
                    return view('pages.worker', compact($user));
                }

                if($user = auth()->user()->hasRole(3)) {
                    return view('pages.parent', compact($user));
                }

        }

        return view('pages.guest');
    }
}
