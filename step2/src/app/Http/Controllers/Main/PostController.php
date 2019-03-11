<?php

namespace App\Http\Controllers\Main;

// use App\User;
use App\Model\Image;
use App\Model\Account;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Show the application dashboard.
     * 
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = Account::where("id", $request->uid)->find(1);
        return view('main/post', ['user' => $user]);
    }

    /**
     * Upload image.
     * 
     * @return
     */
    public function upload(Request $request)
    {
        $this->validate($request, [
            'uid' => [
                'required',
            ],
            'caption' => [
                'required',
                'min:5',
                'max:140',
            ],
            'file' => [
                'required',
                'file',
                'image',
                'mimes:jpeg,png',
            ]
        ]);

        if ($request->file('file')->isValid([])) {
            $now = date("Y/m/d H:i:s");
            $uid = $request->input('uid');
            $caption = $request->input('caption');
            $path = $request->file->store('public');  // store in storage

            // Store in DB as filename
            Image::insert(["filepath" => basename($path), "caption" => $caption, "user_id" => $uid, "created_at" => $now]);
            $images = Image::all();
            
            return redirect('home');
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors();
        }
    }

    /**
     * Delete image.
     * 
     * @return
     */
    public function delete(Request $request)
    {
        // Delete image from DB
        Image::where('id', $request->id)->delete();
        
        return redirect('home');
    }
}
