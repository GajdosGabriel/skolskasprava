<?php

namespace App\Http\Controllers;

use App\Grade;
use App\Tutorial;
use App\User;
use Illuminate\Http\Request;

class GradesController extends Controller
{

    public function __construct()
    {
        $this->middleware('tutorial');
        $this->middleware('workers');
    }


    public function index()
    {
        $grades = Grade::GradeOfUser()->paginate();
        return view('grades.index', ['grades' => $grades]);
    }

    public function show(Grade $grade)
    {
        $users = User::whereGradeId($grade->id)->latest()->paginate();

        return view('students.index', compact('grade'))->with('users', $users);
    }

    public function edit(Grade $grade)
    {
        return view('grades.edit')->with('grade', $grade);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);
        //$this->authorize('admin-edit');

        if($request->input('class_leader'))
        {
            $user = User::whereId($request->input('class_leader'))->first();

            //Pridanie triedy adminom
           $grade = $user->grade()->create(array_merge($request->all(),
                [ 'owner_id' => auth()->user()->owner_id,
                ]));
           $user->markTutorial(2);

           Grade::sendClassLeaderNotification($user);

        } else {

            //Pre pridanie priamo z tutorialu po registrácii
            auth()->user()->grade()->create(array_merge($request->all(),
                [ 'owner_id' => auth()->user()->owner_id,
                ]));

            auth()->user()->markTutorial(2);
        }

//        $grade->update(['class_leader' => $request->input('class_leader') ?? auth()->user()->id]);

        \Toastr::success('Uložené!', 'Trieda bola pridaná', ["positionClass" => "toast-bottom-right"]);


        return redirect('triedy');

    }


    public function update(Grade $grade, Request $request)
    {
        $grade->updateClassleader($request->all());

        $grade->user->markTutorial(2);

        \Toastr::success('Uložené!', 'Trieda bola aktualizovaná', ["positionClass" => "toast-bottom-right"]);

        return redirect('triedy');
    }

    public function destroy(User $user, $slug, Grade $grade)
    {
        $this->authorize('admin-edit');
        $grade->delete();

        \Toastr::success('Zmazané!', 'Trieda bola zmazaná', ["positionClass" => "toast-bottom-right"]);
        return back();

    }
}
