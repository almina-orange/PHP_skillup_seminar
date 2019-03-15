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
        $users = Like::select()
                        ->join('public.users', 'public.likes.user_id', '=', 'public.users.id')
                        ->where('image_id', $request->iid)
                        ->get();
        return view('main/like', ['users' => $users]);
    }
    
    public function like(Request $request)
    {
        $now = date("Y/m/d H:i:s");

        // New 'like'
        $row = Like::where('image_id', $request->iid)
                    ->where('user_id', $request->uid)
                    ->get();

        // Cancel 'like'
        if (count($row) == 0) {
            Like::insert([
                "image_id" => $request->iid,
                "user_id" => $request->uid,
                "created_at" => $now,
                "updated_at" => $now
            ]);
        } else {
            Like::where('image_id', $request->iid)
                ->where('user_id', $request->uid)
                ->delete();
        }
        
        return redirect('home');
    }
}