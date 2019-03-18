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

class FavoController extends Controller
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

        $images = Like::select('public.images.id', 'public.images.image', 'public.images.caption', 'public.images.user_id', 'public.users.github_id')
                        ->join('public.images', 'public.likes.image_id', '=', 'public.images.id')
                        ->join('public.users', 'public.images.user_id', '=', 'public.users.id')
                        ->where('public.likes.user_id', $uid)
                        ->orderBy('public.images.id', 'desc')
                        ->offset(($pg - 1) * 10)->limit(10)
                        ->get();
        
        $posts = Like::join('public.images', 'public.likes.image_id', '=', 'public.images.id')
                        ->where('public.likes.user_id', $uid)
                        ->count();

        $maxPg = ceil($posts / 10);

        $likes = 0;
        foreach (Image::where('user_id', $uid)->get() as $d) {
            $likes += Like::where("image_id", $d->id)->count();
        }

        return view('main/favo', [
            'user' => $user,
            'images' => $images,
            'pg' => $pg,
            'maxPg' => $maxPg,
            'likes' => $likes,
            'posts' => $posts
        ]);
    }
}