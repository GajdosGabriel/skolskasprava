<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserUpdateRequest;
use App\User;
use Illuminate\Http\Request;


class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function edit(User $user, $slug)
    {
        $this->authorize('user-update', $slug);
        return view('users.edit', compact('user'));
    }

    public function update(User $user, $slug, UserUpdateRequest $request)
    {

        $this->authorize('user-update', $slug);

        $user->update($request->all());

        if($request->input('email')) {
            $user->update(['confirmed' => 1]);
        }

        \Toastr::success('Uložené!', 'Údaje boli aktualizované', ["positionClass" => "toast-bottom-right"]);

        auth()->user()->markTutorial(1);
//            auth()->user()->tutorials()->attach(Tutorial::whereSlug('setup-profile')->first());

        if($user->hasRole(2)) {
            return redirect()->route('workers.index');
        } else {
            return redirect()->route('folks.index');
        }
    }

    public function sendInvitation(User $user)
    {
        $user->sendInvitation($user);

        return back();

    }

    public function sendParentInvitation(User $user)
    {
        $user->sendParentInvitation($user);

        return back();

    }


    public function show(User $user, $slug)
    {
        return view('users.show')->with('user', $user);
    }
}
