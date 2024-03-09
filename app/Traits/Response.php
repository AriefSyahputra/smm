<?php

namespace App\Traits;

trait Response
{
    protected function success($code, $message)
    {
        return json_encode([
            'code' => $code,
            'status' => true,
            'message' => $message,
        ]);
    }

    protected function error($code, $message)
    {
        return json_encode([
            'code' => $code,
            'status' => false,
            'message' => $message
        ]);
    }
}
