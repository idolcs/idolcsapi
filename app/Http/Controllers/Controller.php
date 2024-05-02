<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function sendResponse($data, $message, $statusCode = 200)
    {
        $response = [
            'success' => true,
            'data' => $data,
            'message' => $message
        ];
        return response()->json($response, $statusCode);
    }

    public function sendError($data, $message, $statusCode = 404)
    {
        $response = [
            'success' => false,
            'data' => $data,
            'message' => $message
        ];
        return response()->json($response, $statusCode);
    }
}
