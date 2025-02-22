<?php

namespace App\Traits;

use App\Exceptions\JsonException;

trait ApiResponse
{
    protected function jsonResponse($status, $message, $data = null)
    {
        $response = [
            'metadata' => [
                'status' => $status,
                'message' => $message,
            ],
        ];

        if ($data) {
            $response['data'] = $data;
        }

        if ($status != 200) {
            throw new JsonException($response);
        }

        return response()->json($response, $status);
    }
}
