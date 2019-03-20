<?php

namespace App\Http\Controllers\Main;

use App\Model\Image;
use App\Model\Like;
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
        $user = $request->user();
        if (!is_null($user)) {
            return view('main/post', ['user' => $user]);
        } else {
            return redirect('home');
        }
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
                'max:60000',
            ]
        ]);

        if ($request->file('file')->isValid([])) {
            $now = date("Y/m/d H:i:s");
            $uid = $request->uid;
            $caption = $request->caption;
            $image = base64_encode(file_get_contents($request->file->getRealPath()));  // store in storage

            // Add data in DB
            Image::insert([
                "image" => $image,
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
        Like::where('image_id', $request->id)->delete();
        
        return redirect('home');
    }
}
