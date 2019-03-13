<?php

namespace App\Http\Controllers\Main;

// use App\User;
use App\Model\Image;
use App\Model\Account;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Socialite;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     * 
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $token = $request->session()->get('github_token', null);
        try {
            $info = Socialite::driver('github')->userFromToken($token);
        } catch (\Exception $e) {
            return redirect('login/github');
        }

        $user = Account::where("github_id", $info->user['login'])->first();

        $images = Image::select('public.images.id', 'public.images.filepath', 'public.images.caption', 'public.images.user_id', 'public.accounts.github_id')
                        ->join('public.accounts', 'public.images.user_id', '=', 'public.accounts.id')
                        ->get();
        
        // return view('main/home', ['images' => $images, 'token' => $token, 'user' => $user]);
        return view('main/info', ['token' => $token, 'info' => var_dump($info), 'res' => $info->user{'avatar_url'}]);
    }
}
