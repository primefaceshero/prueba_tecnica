<?php


namespace App\Http\Controllers;


class CustomHelper
{
    public static function ClearRut($str)
    {
        $str = str_replace('.', '', $str);
        return str_replace('-', '', $str);
    }

    public static function responseSuccess($data = null, $message = 'Listado Correctamente'): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'status' => 200,
            'message' => $message,
            'data' => $data
        ]);
    }

    public static function responseError($data = null, $message = 'Error'): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'status' => 500,
            'message' => $message,
            'data' => $data
        ]);
    }

    public static function responseNotFound($data = null, $message = 'Elemento no encontrado'): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'status' => 404,
            'message' => $message,
            'data' => $data
        ]);
    }

    public static function responseNoAuth($data = null, $message = 'No Autoriazdo'): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'status' => 403,
            'message' => $message,
            'data' => $data
        ]);
    }
}
