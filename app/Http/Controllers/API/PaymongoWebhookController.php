<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaymongoWebhookController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Arr::get($request->all(), 'data.attributes');
        // dd($data);
        if ($data['type'] !== 'source.chargeable') {
            return response()->noContent();
        }

        $source = Arr::get($data, 'data');
        $sourceData = $source['attributes'];

        if ($sourceData['status'] === 'chargeable') {
            $payment = Paymongo::payment()->create([
                'amount' => $sourceData['amount'] / 100,
                'currency' => $sourceData['currency'],
                'description' => $sourceData['type'].' test from src ' . $source['id'],
                'source' => [
                    'id' => $source['id'],
                    'type' => $source['type'],
                ]
            ]);
        }
        return response()->noContent();
    }
}
