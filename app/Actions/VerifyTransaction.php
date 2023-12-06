<?php
namespace App\Actions;

use Illuminate\Support\Facades\Http;

class VerifyTransaction
{
    public function run($reference)
    {
        $res = Http::withToken(config('paystack.secretKey'))->get('https://api.paystack.co/transaction/verify/' . $reference);
        return $res->collect();
    }
}
