<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\User;
use Socialite;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{


    /**
     * Redirect the user to the Social Provider authentication page.
     *
     * @return Response
     */
    public function redirectToProvider($service)
    {
        return Socialite::driver($service)->redirect();
    }

    /**
     * Obtain the user information from GitHub, Facebook and other.
     *
     * @return Response
     */
    public function handleProviderCallback(Request $request, $service)
    {
        $oauth_user = Socialite::driver($service)->user();

        if (!$user = User::whereEmail($oauth_user->email)->first())
        {
            $user = $this->createNewUser($oauth_user);

            return $this->loginUser($user);

        }

        return $this->loginUser($user);
    }


    protected function createNewUser($oauth_user)
    {
        $secondword = explode(' ', $oauth_user->name);

        return User::create([
            'last_name' => strtok($oauth_user->name, " "),
            'slug' => array_pop($secondword),
            'email' => $oauth_user->email,
            // 'avatar' => $oauth_user->avatar_original,
            'password' => bcrypt('registracnyformularheslo'),
//            'verified' => 1
        ]);

    }

    // Rodič sa prihlási cez emailové pozvanie.
    public function checkParentLogin(User $user, $slug, $email)
    {
        if($user->slug == $slug AND $user->email == $email)
        {
          return  $this->loginUser($user);
        }

        \Toastr::danger('Chyba!', 'Link nie ja autentický. Vyžiadajte si zmenu hesla.', ["positionClass" => "toast-bottom-right"]);

    }

    protected function loginUser($user)
    {
        if($user->disabled){
            return $this->isUserLocked($user);
        }
        Auth::login($user, true);
        \Toastr::success('Prihlásený!', 'Úspešne ste s prihlásili', ["positionClass" => "toast-bottom-right"]);

        return redirect('/');
    }


    public static function isUserLocked(User $user)
    {
//        flash()->error('Váš účet je blokovaný! Kontaktujte administrátora');
        return redirect('/login');
    }

}
