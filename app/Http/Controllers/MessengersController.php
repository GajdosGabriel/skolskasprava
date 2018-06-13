<?php

namespace App\Http\Controllers;

use App\Messenger;
use App\User;
use Illuminate\Http\Request;
use App\Notifications\Messengers\MessageComing;

class MessengersController extends Controller
{
    public function index()
    {
       $usermessages = Messenger::whereReadAt(null)->whereRequestedUser(auth()->user()->id)->get();

        return view('messenger.index', compact('usermessages'));
    }

    public function show(User $user, $slug)
    {
        $first = Messenger::whereUserId(auth()->user()->id)->whereRequestedUser($user->id)->get();
        $second = Messenger::whereUserId($user->id)->whereRequestedUser(auth()->user()->id)->get();

        // spojit dve kolekcie do jednej, zoradit a vratit vysledok
        $questions = $first->concat($second)->sortByDesc('id')->values();

        $user->messengers()->where('read_at', null)->update(['read_at' => now()]);


        return view('messenger.show', ['questions' => $questions, 'requested_user' => $user]);

    }

    public function store(User $user, Request $request)
    {
        $validated = $request->validate([
            'body' => 'required|min:3',
        ]);

       $message = Messenger::create(array_merge($validated,[
            'user_id' => auth()->id(),
            'requested_user' => $user->id
        ]));


        \Notification::send($user, new MessageComing($message));

//        \Toastr::success('Odoslané!', 'Správa bola odoslaná', ["positionClass" => "toast-bottom-right"]);
        return back();

    }
}
