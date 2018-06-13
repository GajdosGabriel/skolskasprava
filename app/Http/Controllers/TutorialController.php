<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class TutorialController extends Controller
{
    public function missingData()
    {
        return view('pages.tutorial.1_add_missing_data')->with('user', User::whereId(auth()->user()->id)->first());
    }

    public function addGrade()
    {
        return view('pages.tutorial.2_add_grade')->with('user', User::whereId(auth()->user()->id)->first());
    }

    public function addStudent()
    {
        return view('pages.tutorial.3_add_student')->with('user',  User::whereId(auth()->user()->id)->first());
    }

    public function addParent()
    {
        $parent = session()->get('studentCreateByTutorial');

        return view('pages.tutorial.4_add_parent')->with('user',  User::whereId($parent)->first());
    }


}
