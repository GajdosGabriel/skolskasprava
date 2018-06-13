<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentRequestUpdate;
use App\Http\Requests\StudentsParentsStoreRequest;
use App\User;
use App\Role;
use App\Student;
use Illuminate\Http\Request;
use App\Notifications\Parent\ConfirmStudentAgreement;

class StudentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('tutorial');
        $this->middleware('workers');
    }


    public function index()
    {
        $studensts = User::whereOwnerId( auth()->user()->owner_id)
            ->whereHas(
                'roles', function($q){
                $q->where('id', 4);
            })
            ->latest()->paginate(20);
//        return view('students.index', ['users' => $users , 'grades' => $user->grades()] );
        return view('students.index', ['users' => $studensts ] );
    }

    public function show(User $user, $slug)
    {
        $parent = User::whereId($user->parent_id)->first();


        return view('students.show', ['user' => $user])->with('parent', $parent);
    }

    public function edit(User $user, $slug)
    {
        $parent = $user->parent($user->parent_id);
        return view('students.edit', ['user' => $user, 'parent' => $parent]);
    }

    public function store(StudentsParentsStoreRequest $request)
    {
        $user = $request->store();

        $user->roles()->attach(Role::whereId(4)->first());

        \Toastr::success('Uložené!', 'Študent bol pridaný', ["positionClass" => "toast-bottom-right"]);

        auth()->user()->markTutorial(3);
        session()->put('studentCreateByTutorial' , $user->id);

        if($request->input('add_parent')) {
            return redirect()->route('tutorial.addParent');
        }

        return redirect()->route('grades.show', [auth()->user()->grade->id]);
    }


    public function update(User $user, StudentRequestUpdate $request)
    {
        $user->update($request->all());
        \Toastr::success('Uložené!', 'Študent bol aktualizovaný', ["positionClass" => "toast-bottom-right"]);

        return redirect('students');

    }

    public function addParentForStudent(User $user, Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'unique:users|max:255'
        ]);

        $user->update($request->all());

        if($validatedData) {
            \Toastr::success('Uložené!', 'Email bol pridaný úspešne.', ["positionClass" => "toast-bottom-right"]);
            return back();
        }

        \Toastr::success('Uložené!', 'Rodič bol pridaný', ["positionClass" => "toast-bottom-right"]);

        return back();

    }

    public function destroy(User $user, $slug)
    {
//        if(\Gate::allows('worker-class_leader', $user) )
//        {
            $user->delete();
            \Toastr::success('Vymazané!', 'Študent bol vymazaný', ["positionClass" => "toast-bottom-right"]);
//            return back();
//        }

//        \Toastr::info('Pozor!', 'Zmazať študenta môže iba triedny', ["positionClass" => "toast-bottom-right"]);
        return redirect('students');
    }



}
