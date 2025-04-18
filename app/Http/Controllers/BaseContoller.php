<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

class BaseContoller extends Controller
{
    protected function successResponse(string $message , $data = null , $status = 200): JsonResponse{

        $response = [
            'success' => true , 
            'message' => $message , 
            'data' => $data 
        ] ; 

        return response()->json($response , $status) ; 
    }

    protected function errorResponse(string $message , $error = null , $status = 200): JsonResponse{

        $response = [
            'success' => false , 
            'message' => $message , 
            'error' => $error 
        ] ; 

        return response()->json($response , $status) ; 
    }
}
