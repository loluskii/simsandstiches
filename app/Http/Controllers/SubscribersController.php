<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use App\Jobs\NewUserEmailJob;

class SubscribersController extends Controller
{
    public function index()
    {
        $subscribers = Subscriber::all();
        return view('admin.subscribers.index', compact('subscribers'));
    }
    public function store(Request $request)
    {
        $subscriber = new Subscriber;
        $subscriber->email = $request->email;
        $subscriber->save();

        $user = User::where('email', $request->email)->first();
        if ($user === null) {
            NewUserEmailJob::dispatch($request->email)->delay(now()->addMinutes(3));
        }

        return response()->json([
            'success' => true,
        ], 200);
    }
}
