<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\User;
use App\Role;
use App\Tutorial;
use Illuminate\Http\Request;
use App\Notifications\Worker\WorkerInvitationNotification;

class WorkersController extends Controller
{

    public function __construct()
    {
        $this->middleware('tutorial');
        $this->middleware('workers');
    }



    public function index()
    {
       $users = User::whereOwnerId( \Auth::user()->owner_id )
           ->whereHas(
               'roles', function($q){
               $q->where('id', 2)
               ->orWhere('id', 1);
           })
           ->latest()->paginate(20);

        return view('workers.index')->with('users', $users);
    }


    public function store(UserStoreRequest $request)
    {

        $this->authorize('admin-edit');

        $user = User::create( array_merge($request->all(), [
            'confirmed' => 1,
        ]));

        $user->roles()->attach(Role::whereId(2)->first());


        if($request->send_notify_worker) {
            $user->sendInvitation($user);
        }


        \Toastr::success('Uložené!', 'Zamestnanec bol pridaný', ["positionClass" => "toast-bottom-right"]);
        return back();
    }

    public function destroy(User $user, $slug)
    {
        $this->authorize('admin-edit');

        if($user->hasRole(1))
        {
            \Toastr::info('Stop!', 'Administrátor nemôže byť zmazaný!', ["positionClass" => "toast-bottom-right"]);
            return back();
        }
            //Vymaže rodiča ak nemá žiakov
        if($user->hasStudents($user->id))
        {
            \Toastr::info('Stop!', 'Najprv vymažte žiakov rodiča!', ["positionClass" => "toast-bottom-right"]);
            return back();
        }

        if($user->hasRole(2)) {
            \Toastr::success('Zmazané!', 'Zamestnanec bol zmazaný', ["positionClass" => "toast-bottom-right"]);
            $user->delete();
            return redirect()->route('workers.index');
        }

        if($user->hasRole(3)) {
            \Toastr::success('Zmazané!', 'Rodič bol zmazaný', ["positionClass" => "toast-bottom-right"]);
            $user->delete();
            return redirect()->route('folks.index');
        }







    }
}
