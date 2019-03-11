<?php

namespace App\Http\Controllers\Main;

use App\Model\Account;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Socialite;
use Illuminate\Support\Facades\DB;

class AccountController extends Controller
{
    /**
     * Show the application dashboard.
     * 
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('main/edit', ['user' => $request->name, 'icon' => $request->icon]);
    }

    public function updateUser(Request $request)
    {
        $this->validate($request, [
            'name' => [
                'required',
                'max:10',
            ],
            'icon' => [
                'required',
                'file',
                'image',
                'mimes:jpeg,png',
            ]
        ]);

        if ($request->file('icon')->isValid([])) {
            $now = date("Y/m/d H:i:s");
            $token = $request->session()->get('github_token', null);
            $user = Socialite::driver('github')->userFromToken($token);

            $icon = $request->file('icon')->store('public');  // store icon in storage

            DB::update('update public.accounts set name = ?, icon = ?, updated_at = ? where github_id = ?', [$request->input('name'), basename($icon), $now, $user->user['login']]);
            // DB::update('update public.images set name = ?, icon = ?, updated_at = ? where github_id = ?', [$request->input('name'), basename($icon), $now, $user->user['login']]);

            $uid = Account::where("github_id", $user->user['login'])->find(1);
            $uid = $uid->id;

            return redirect(asset('/user?uid=' . $uid));
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors();
        }
    }
}