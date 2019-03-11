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
        $user = Socialite::driver('github')->userFromToken($token);
        $user = Account::where("github_id", $user->user['login'])->find(1);

        // $images = Image::all();
        // $images = DB::select('select * from public.images left outer join public.accounts on public.images.user_id = public.accounts.id');
        $images = Image::select('public.images.id', 'public.images.filepath', 'public.images.caption', 'public.images.user_id', 'public.accounts.name')
                        ->join('public.accounts', 'public.images.user_id', '=', 'public.accounts.id')
                        ->get();
        return view('main/home', ['images' => $images, 'token' => $token, 'user' => $user]);
    }
}
