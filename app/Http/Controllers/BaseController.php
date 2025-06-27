<?php

namespace App\Http\Controllers;

class BaseController extends Controller
{
    public function responseok($data = [], $message = 'Success', $statusCode = 200)
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data,
        ], $statusCode);
    }

    public function responseError($message = 'Error', $statusCode = 500)
    {
        return response()->json([
            'success' => false,
            'message' => $message,
        ], $statusCode);
    }

    public function responseCreated($data = [], $message = 'Resource created successfully', $statusCode = 201)
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data,
        ], $statusCode);
    }

    public function responseNoContent($message = 'No content', $statusCode = 204)
    {
        return response()->json([
            'success' => true,
            'message' => $message,
        ], $statusCode);
    }

    public function responseUnauthorized($message = 'Unauthorized', $statusCode = 401)
    {
        return response()->json([
            'success' => false,
            'message' => $message,
        ], $statusCode);
    }
}
