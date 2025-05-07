<?php

namespace App\Http\Controllers;

abstract class Controller
{
    public function jsonResponse($code, $message, $data = null)
    {
        return response()->json([
            'code' => $code,
            'message' => $message,
            'data' => $data,
        ]);
    }
    
}
