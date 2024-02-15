<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use App\Jobs\NewUserEmailJob;
use App\Mail\NewUsersWelcomeMail;
use Illuminate\Support\Facades\Mail;

class SubscribersController extends Controller
{
    public function index()
    {
        $subscribers = Subscriber::all();
        return view('admin.subscribers.index', compact('subscribers'));
    }
    public function store(Request $request)
    {
        try {
            $subscriber = Subscriber::where('email', $request->email)->first();
            if (!$subscriber) {
                $new = new Subscriber;
                $new->email = $request->email;
                $new->save();

                $mail = new NewUsersWelcomeMail($request->email);
                Mail::to($request->email)->send($mail);

                return response()->json([
                    'success' => true,
                ], 200);
            }else{
                return response()->json([
                    'error' => true,
                ], 500);
            }
        } catch (\Exception $th) {
            throw $th;
        }
    }
}
