<?php

namespace App\Http\Controllers;

use App\Jobs\NewUserEmailJob;
use Exception;
use App\Models\User;
use App\Helpers\Helper;
use Illuminate\Http\Request;
use App\Mail\NewUsersWelcomeMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\RegisterRequest;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest', ['except' => ['logout']]);
    }



    public function register(RegisterRequest $request)
    {
        try {
            \DB::beginTransaction();
            $user = User::create([
                'fname' => $request['fname'],
                'lname' => $request['lname'],
                'email' => $request['email'],
                'phone_no' => $request['phone_no'],
                'password' => Hash::make($request['password']),
            ]);
            Auth::login($user, true);
            \DB::commit();
            NewUserEmailJob::dispatch($user)->delay(now()->addMinutes(3));
            return redirect()->route('home');
        } catch (Exception $e) {
            return back()->with(
                'error',
                $e->getMessage()
            );
        }
    }

    public function login(Request $request)
    {
        try {
            $input = $request->all();
            $request->validate([
                'email' => ['required'],
                'password' => ['required'],
            ]);
            $shouldRemember = true;
            $cartItems = \Cart::session('guest')->getContent();
            \Cart::session('guest')->clear();
            if (Auth::attempt(array('email' => $input['email'], 'password' => $input['password']), $shouldRemember)) {
                $request->session()->regenerate();
                $userId = auth()->user()->id; // or any string represents user identifier
                \Cart::session($userId)->add($cartItems);
                return redirect()->intended('/');
            }
            session()->flash('loginMsg', 'The provided credentials do not match our records.');
            return back();
        } catch (Exception $e) {
            return back()->with(
                'error',
                $e->getMessage()
            );
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        \Cart::session(Helper::getSessionID())->clear();
        return redirect('/');
    }
}
