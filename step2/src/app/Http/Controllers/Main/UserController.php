<?php

namespace App\Http\Controllers\Main;

// use App\User;
use App\Model\Account;
use App\Model\Image;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Show the application dashboard.
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $users = Account::all();
        // return view('main/user', ['users' => $users]);
        $user = Account::where("github_id", "almina-orange")->get();
        return view('main/user', ['user' => $user]);
    }

    public function viewUser(Request $request)
    {
        $user = Account::where("id", $request->uid)->get();
        $images = Image::where("user_id", $request->uid)->get();
        return view('main/user', ['user' => $user, 'images' => $images]);

        // $name = "almina-orange";
        // $user = Account::where("github_id", $name)->get();
        // return view('main/user', ['user' => $user]);
    }
}