<?php

namespace App\Http\Controllers\Checker;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class CopyLeaks extends Controller
{
    //


    public function status(Request $request, $scanId)
    {
        Log::info('Status Checker', [
            'scanId' => $scanId,
            'payload' => $request->all(),
        ]);

        return response()->json(['message' => 'Status Recieved']);
    }


    public function completed(Request $request, $scanId)
    {
        Log::info('CopyLeaks COMPLETED webhook received', [
            'scanId' => $scanId,
            'payload' => $request->all(),
        ]);

        // You can process the completed results here...

        return response()->json(['message' => 'Completed received.']);
    }
}
