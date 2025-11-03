<?php

use Illuminate\Http\JsonResponse;
use Illuminate\Support\MessageBag;

if (!function_exists('successResponse')) {
    /**
     * Return standardized JSON success response.
     *
     * @param  mixed|null  $data
     * @param  string  $message
     * @param  int  $code
     * @return JsonResponse
     */
    function successResponse(mixed $data = null, string $message = 'Berhasil', int $code = 200): JsonResponse
    {
        return response()->json([
            'status' => true,
            'message' => $message,
            'data' => $data,
        ], $code);
    }
}

if (!function_exists('errorResponse')) {
    /**
     * Return standardized JSON error response.
     *
     * @param  string  $message
     * @param  mixed|null  $errors
     * @param  int  $code
     * @return JsonResponse
     */
    function errorResponse(string $message = 'Terjadi kesalahan', mixed $errors = null, int $code = 400): JsonResponse
    {
        return response()->json([
            'status' => false,
            'message' => $message,
            'errors' => $errors,
        ], $code);
    }
}

if (!function_exists('unauthorizedResponse')) {
    /**
     * Return standardized unauthorized (401) response.
     *
     * @param  string  $message
     * @return JsonResponse
     */
    function unauthorizedResponse(string $message = 'Token tidak valid atau sudah kedaluwarsa'): JsonResponse
    {
        return response()->json([
            'status' => false,
            'message' => $message,
        ], 401);
    }
}

if (!function_exists('validationErrorResponse')) {
    /**
     * Return standardized validation error response.
     *
     * @param  MessageBag|array|string|null  $errors
     * @param  string  $message
     * @return JsonResponse
     */
    function validationErrorResponse(MessageBag|array|string|null $errors = null, string $message = 'Validasi gagal'): JsonResponse
    {
        if ($errors instanceof MessageBag) {
            $errors = $errors->toArray();
        }

        return response()->json([
            'status' => false,
            'message' => $message,
            'errors' => $errors,
        ], 422);
    }
}
