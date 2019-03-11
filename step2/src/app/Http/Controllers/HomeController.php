<?php

namespace App\Http\Controllers;

use App\User;
use App\Model\Test;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Upload file.
     */
    public function upload(Request $request)
    {
        // Check validation
        $this->validate($request, [
            'name' => [
                'required',
                'max:10'
            ],
            'file' => [
                'required',
                'file',
                'image',
                'mimes:jpeg,png',
            ]
        ]);

        if ($request->file('file')->isValid([])) {
            $name = $request->input('name');
            $path = $request->file->store('public');  // store in storage

            // Store in DB as filename
            // DB::insert('insert into public.image (name, filepath) values (?, ?)', [$name, basename($path)]);
            // $filenames = DB::select('select * from public.image where name = ?', [$name]);
            Test::insert(["name" => $name, "filepath" => basename($path)]);
            $filenames = Test::all();

            return view('home', [
                "filenames" => $filenames
            ]);
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors();
        }
    }

    // /**
    //  * View posted images.
    //  */
    // public function create(Request $request)
    // {
    //     // Check validation
    //     $request->validate([
    //         'name' => 'required|max:10',
    //         'file' => [
    //             'required',
    //             'file',
    //             'image',
    //             'mimes:jpeg,png',
    //         ]
    //     ]);

    //     // Store in valiables
    //     $name = $request->input('name');
    //     $commen = $request->input('image');

    //     // Store in DB
    //     Tests::insert(["name" => $name, "image" => $image]);

    //     // Return full datas
    //     $img = Tests::all();
    //     return view('home.index', ["img" => $img]);
    // }
}
