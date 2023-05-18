<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BaseApiController extends Controller
{
    public function sendResponse(string $message)
    {
        $response = [
            'success' => true,
            'message' => $message
        ];

        return response()->json($response, 200);
    }

    public function sendError(string $error, $code = null)
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];
        if (!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }

        return response()->json($response, $code);
    }
}
