<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class RegisterUserController extends Controller
{
    public function store(RegisterRequest $request): JsonResponse //PRegutnar que significa esto
    {
        $user = User::create([
            'name' => $request->name,
            'surname_1' => $request->surname_1,
            'surname_2' => $request->surname_2,
            'phone_number' => $request->phone_number,
            'city' => $request->city,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'status' => 'success',
            'message' => '¡Usuario registrado correctamente!',
            'data' => [
                'user' => new UserResource($user),
                'access_token' => $token,
                'token_type' => 'Bearer', //Que quiere decir Bearer - Pregunta
            ],
        ], 201); //Aqui el codigo 201 "Created", usuario creado en la bbdd correctamente
    }
}