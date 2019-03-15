<?php

namespace App\Http\Controllers\Main;

use App\User;
use App\Model\Account;
use App\Model\Image;
use App\Model\Like;
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
        $uid = $request->uid;
        $user = User::where('id', $uid)->first();
        if (isset($request->pg)) {
            $pg = $request->pg;
        } else {
            $pg = 1;
        }
        $images = Image::where("user_id", $uid)
                        ->orderBy("id", "desc")
                        ->offset(($pg - 1) * 10)->limit(10)
                        ->get();

        $posts = Image::where('user_id', $uid)->count();
        $maxPg = ceil($posts / 10);

        $likes = 0;
        foreach (Image::where('user_id', $uid)->get() as $d) {
            $likes += Like::where("image_id", $d->id)->count();
        }

        return view('main/user', [
            'user' => $user,
            'images' => $images,
            'pg' => $pg,
            'maxPg' => $maxPg,
            'likes' => $likes,
            'posts' => $posts
        ]);
        // return view('main/info', ['info' => var_dump($info), 'token' => $token, 'res' => $info->user['avatar_url']]);
    }
}