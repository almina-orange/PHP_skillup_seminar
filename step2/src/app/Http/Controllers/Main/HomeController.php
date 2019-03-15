<?php

namespace App\Http\Controllers\Main;

use App\User;
use App\Model\Image;
use App\Model\Like;
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
        $user = $request->user();
        if (isset($request->pg)) {
            $pg = $request->pg;
        } else {
            $pg = 1;
        }
        $images = Image::select('public.images.id', 'public.images.filepath', 'public.images.caption', 'public.images.user_id', 'public.users.github_id')
                        ->join('public.users', 'public.images.user_id', '=', 'public.users.id')
                        ->orderBy('public.images.id', 'desc')
                        ->offset(($pg - 1) * 10)->limit(10)
                        ->get();

        $maxPg = ceil(Image::count() / 10);

        return view('main/home', [
            'user' => $user,
            'images' => $images,
            'pg' => $pg,
            'maxPg' => $maxPg
        ]);
    }
}
