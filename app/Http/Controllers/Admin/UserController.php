<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.customers.index', compact('users'));
    }

    public function edit(Request $request, $id)
    {
        $user = User::where('id', $id)->first();
        $user->fname = $request['fname'] ?? $user->fname;
        $user->lname = $request['lname'] ?? $user->lname;
        $user->email = $request['email'] ?? $user->email;
        $user->phone_no = $request['phone_no'] ?? $user->phone_no;
        $user->is_admin = $request['is_admin'] ?? $user->is_admin;
        $user->update();

        return back()->with('success', 'Update Successful');
    }

    public function delete($id)
    {
        User::findOrFail($id)->delete();
        return back();
    }
}
