<?php
namespace App\Http\Controllers;
use App\User;
class MyController extends Controller
{
    public function index()
    {
        // Insert new data in DB (table::User).
        $users = User::all();
        return view('sample', ['users' => $users]);
    }
}
?>