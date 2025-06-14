<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\StatusCheckService;

class StatusCheckController extends Controller
{
    public function check(Request $request)
    {
        $service = new StatusCheckService();

        // manually set result (example: true or false based on internal logic or fixed value)
        $service->setResult(false); // or false

        $result = $service->checkCondition(null);

        return response()->json([
            'status' => $result
        ]);
    }
}
