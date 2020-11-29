<?php

namespace App\Http\Controllers\Session;

use App\Http\Controllers\Controller;
use App\Models\Agence;
use App\Models\User;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use MercurySeries\Flashy\Flashy;

class SessionController extends Controller
{
    use ThrottlesLogins;

    public function __construct()
    {
        $this->middleware('guest', ['except' => 'destroy']);
    }

    public function create()
    {
        return view('session.create');
    }

    public function login()
    {
       // dd(\request()->all());
        $user = User::where('email', request(['email']))->first();

        if(!$user){
            Flashy::error('Aucun compte ne correspond à cet utilisateur. Veuillez contacter l\'administrateur');
            return back();
        }else{
            $agence = Agence::where('code',request(['code']))->first();
            session()->put( 'orig_agence', $agence->id );
        }

        if(!auth()->attempt(request(['email', 'password','']))){
            Flashy::error('Votre adresse électronique ou votre mot de passe est incorrecte');
            return back();
        }

        Flashy::success('Bienvenue');
        return redirect()->home();
    }

    public function destroy()
    {
        $this->guard()->logout();

        request()->session()->flush();
        request()->session()->regenerate();

        return redirect()->login();
    }

    public function recovery()
    {
        return view('session.recovery');
    }

    protected function guard()
    {
        return Auth::guard();
    }
}
