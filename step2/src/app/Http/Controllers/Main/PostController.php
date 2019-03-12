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
        $user = Account::where("id", $request->uid)->first();
        return view('main/post', ['user' => $user]);
    }

    /**
     * Upload image.
     * 
     * @return
     */
    public function upload(Request $request)
    {
        // Validation check
        $this->validate($request, [
            'uid' => [
                'required',
            ],
            'caption' => [
                'required',
                'max:200',
            ],
            'file' => [
                'required',
                'file',
                'image',
                'mimes:jpeg,png',
                'max:60000'
            ]
        ]);

        if ($request->file('file')->isValid([])) {
            $now = date("Y/m/d H:i:s");
            $uid = $request->uid;
            $caption = $request->caption;
            $path = $request->file->store('public');  // store in storage

            // Store in DB as filename
            Image::insert([
                "filepath" => basename($path),
                "caption" => $caption,
                "user_id" => $uid,
                "created_at" => $now,
                "updated_at" => $now
            ]);
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
