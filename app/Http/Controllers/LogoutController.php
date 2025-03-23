<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $user = auth()->user();

        //$user->tokens()->delete();
        $user->currentAccessToken()->delete();

        return response()->json(['message' => 'Token revoked'], JsonResponse::HTTP_OK);
    }
}
