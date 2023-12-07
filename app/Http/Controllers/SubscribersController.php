<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use Illuminate\Http\Request;

class SubscribersController extends Controller
{
    public function store(Request $request)
    {
        $subscriber = new Subscriber;
        $subscriber->email = $request->email;
        $subscriber->save();

        return response()->json([
            'success' => true,
        ], 200);
    }
}
