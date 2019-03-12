<?php

namespace App\Http\Controllers\Main;

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
        // $user = Account::find($request->uid);
        $user = Account::where("id", $request->uid)->first();
        $images = Image::where("user_id", $request->uid)->get();

        // $iids = Image::select("id")
        //             ->where("user_id", $request->uid)
        //             ->get();
        // $iids = $iids->pluck("id");

        // $images = Image::find($iids);

        $likes = 0;
        foreach ($images as $d) {
            $likes += Like::where("image_id", $d->id)->count();
        }

        return view('main/user', ['user' => $user, 'images' => $images, 'likes' => $likes, 'posts' => count($images)]);
        // return view('main/info', ['info' => var_dump($info), 'token' => $token, 'res' => $info->user['avatar_url']]);
    }
}