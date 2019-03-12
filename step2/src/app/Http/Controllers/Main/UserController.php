<?php

namespace App\Http\Controllers\Main;

// use App\User;
use App\Model\Account;
use App\Model\Image;
use App\Http\Controllers\Controller;
use Socialite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
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

        $user = Account::where("id", $request->uid)->find(1);
        $images = Image::where("user_id", $request->uid)->get();
        return view('main/user', ['user' => $user, 'images' => $images, 'avatar' => $info->user['avatar_url']]);
    }
}