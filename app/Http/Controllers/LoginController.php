<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\RegisterRequest;
use Illuminate\Http\JsonResponse;

final class LoginController
{
    public function register(RegisterRequest $request): JsonResponse
    {
        return response()->json(['validation_status' => 'ok', 'data' => $request->validated()]);
    }
}
