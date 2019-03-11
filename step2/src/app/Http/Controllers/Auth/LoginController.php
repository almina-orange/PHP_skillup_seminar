<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Redirect user to GitHub authentification page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('github')->scopes(['read:user', 'public_repo'])->redirect(); 
    }

    /**
     * Get user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback(Request $request)
    {
        $github_user = Socialite::driver('github')->user();

        // $request->session()->put('github_token', $user->token);
        // return redirect('github');

        $now = date("Y/m/d H:i:s");
        $icon = "default.png";
        $app_user = DB::select('select * from public.accounts where github_id = ?', [$github_user->user['login']]);
        if (empty($app_user)) {
            // new user
            DB::insert('insert into public.accounts (name, github_id, icon, created_at, updated_at) values (?, ?, ?, ?, ?)', [$github_user->user['login'], $github_user->user['login'], $icon, $now, $now]);
        }
        $request->session()->put('github_token', $github_user->token);

        return redirect('home');
    }
}
