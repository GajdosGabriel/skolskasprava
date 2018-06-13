<?php

namespace App\Http\Controllers;


use App\Http\Requests\ParentRequestUpdate;
use App\Http\Requests\StudentsParentsStoreRequest;
use App\Http\Requests\UserStoreRequest;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Session;

class ParentsController extends Controller
{

    public function __construct()
    {
        $this->middleware('tutorial');
    }


    public function index()
    {
        $users = User::whereOwnerId( \Auth::user()->owner_id ?? \Auth::id() )
            ->whereHas(
                'roles', function($q){
                $q->where('id', 3);
            })
            ->latest()->paginate();

        return view('parents.index')->with('users', $users);
    }


    public function show(User $user, $slug)
    {
        $this->authorize('show-parent', $slug);

        $students = User::whereParentId($user->id)->get();

        $owner = User::findOrFail( auth()->user()->owner_id);

        return view('agreements.agreement_web', compact('user', $user))
            ->with('owner', $owner)
            ->with('students', $students);
    }


    public function store(StudentsParentsStoreRequest $request)
    {

       $user = $request->store();


        if($request->input('send_notify_parent'))
        {
            $user->sendStudentInvitation($user);
        }

        if($request->input('email')) {
            $user->update(['confirmed' => 1]);
        }

        $user->roles()->attach(Role::whereId(3)->first());

        auth()->user()->markTutorial(4);

        \Toastr::success('Uložené!', 'Rodič bol pridaný', ["positionClass" => "toast-bottom-right"]);

        if($student = session()->get('studentCreateByTutorial')) {
            $update = User::whereId($student)->first();
            $update->update(['parent_id' => $user->id]);
            session()->forget('studentCreateByTutorial');
        }
        return redirect('students');
    }

    public function update(User $user, $slug, ParentRequestUpdate $request)
    {
        if($request->input('email') == null) {
            $user->update(array_merge($request->all(), ['email' => $user->email ] ) );
        } else {
        $user->update($request->all());
        }


        if($request->input('email')) {
            $user->update(['confirmed' => 1]);
        }
        \Toastr::success('Uložené!', 'Údaje boli aktualizované', ["positionClass" => "toast-bottom-right"]);

        return redirect('rodicia');
    }


}
