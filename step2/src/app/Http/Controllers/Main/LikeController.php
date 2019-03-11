<?php

namespace App\Http\Controllers\Main;

// use App\User;
use App\Model\Like;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LikeController extends Controller
{
    /**
     * Show the application dashboard.
     * 
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $users = Like::select()
        //                 ->where("image_id", $request->iid)
        //                 ->get();
        // $users = Like::where('image_id', $request->iid)
        //             ->where('user_id', 1)
        //             ->get();
        $users = Like::select()
                        ->join('public.accounts', 'public.likes.user_id', '=', 'public.accounts.id')
                        ->where('image_id', $request->iid)
                        ->get();
        return view('main/like', ['users' => $users]);
    }
    
    public function like(Request $request)
    {
        $now = date("Y/m/d H:i:s");
        $row = Like::where('image_id', $request->iid)
                    ->where('user_id', $request->uid)
                    ->get();
        if (count($row) == 0) {
            Like::insert(["image_id" => $request->iid, "user_id" => $request->uid, "created_at" => $now]);
        }
        
        return redirect('home');
    }
}