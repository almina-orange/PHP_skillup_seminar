<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Bbs;

class BbsController extends Controller
{
    public function index() {
        return view('bbs.index');
    }

    public function create(Request $request) {
        // Check validation
        $request->validate([
            'name' => 'required|max:10',
            'comment' => 'required|min:5|max:140',
        ]);

        // Get post
        $name = $request->input('name');
        $comment = $request->input('comment');

        // Insert posted data in DB
        Bbs::insert(["name" => $name, "comment" => $comment]);

        // Send values for view
        $bbs = Bbs::all();
        return view('bbs.index', ["bbs" => $bbs]);
    }
}
?>