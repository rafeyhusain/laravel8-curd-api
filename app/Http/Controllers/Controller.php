<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function sendJson($data, $errors, int $statusCode)
    {
        $result = [
            'statusCode' => $statusCode,
            'data' => $data,
            'errors' => $errors,
        ];

        return response()->json($result, $statusCode)
                        ->header('Content-Type', 'application/json');
    }
}
