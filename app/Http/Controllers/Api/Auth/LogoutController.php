<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    public function destroy(Request $request): JsonResponse
    {
        $user = $request->user(); //llamo al objeto user con el objeto de usuario atuenticado
        //request para sacar el nombre del usuario posteriormente.

        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'status' => 'success',
            'message' => "Sesión cerrada correctamente. Hasta pronto, {$user->name}!",//Aqui utilizo el objeto user para nombre usuario
        ], 200); //Codigo 200 = "OK" generico.
    }
}