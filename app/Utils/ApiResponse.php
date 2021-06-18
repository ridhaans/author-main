<?php

namespace App\Utils;

use Symfony\Component\HttpFoundation\Response;

trait ApiResponse
{

    public function successResponse($data, $code = Response::HTTP_OK)
    {

        return response($data, $code)->header('Content-Type', 'application/json');
    }

    public function validResponse($data, $code = Response::HTTP_OK)
    {

        return response()->json(['data' => $data])->header('Content-Type', 'application/json');
    }

    public function errorResponse($message, $code)
    {
        return response()->json(['status' => false, 'code' => $code, 'error' => $message], $code);
    }

    /**
     * Build error responses
     * @param  string|array $message
     * @param  int $code
     * @return Illuminate\Http\Response
     */
    public function errorMessage($message, $code)
    {
        return response($message, $code)->header('Content-Type', 'application/json');
    }
}
