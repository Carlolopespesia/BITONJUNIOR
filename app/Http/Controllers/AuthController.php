<?php
 
namespace App\Http\Controllers;
 
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
 
class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'surname_1' => 'nullable|string|max:255',
            'surname_2' => 'nullable|string|max:255',
            'phone_number' => 'nullable|string|max:30',
            'city' => 'nullable|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
        ]);
 
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Datos inválidos',
                'errors' => $validator->errors()
            ], 422);
        }
 
        $user = User::create([
            'name' => $request->name,
            'surname_1' => $request->surname_1,
            'surname_2' => $request->surname_2,
            'phone_number' => $request->phone_number,
            'city' => $request->city,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
 
        $token = $user->createToken('api-token')->plainTextToken;
 
        return response()->json([
            'message' => 'Usuario registrado correctamente',
            'user' => $user,
            'token' => $token
        ], 201);
    }
 
    public function createIfNotExists(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'surname_1' => 'nullable|string|max:255',
            'surname_2' => 'nullable|string|max:255',
            'phone_number' => 'nullable|string|max:30',
            'city' => 'nullable|string|max:255',
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);
 
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Datos inválidos',
                'errors' => $validator->errors()
            ], 422);
        }
 
        $user = User::where('email', $request->email)->first();
 
        if ($user) {
            return response()->json([
                'message' => 'El usuario ya existe',
                'user' => $user
            ], 200);
        }
 
        $user = User::create([
            'name' => $request->name,
            'surname_1' => $request->surname_1,
            'surname_2' => $request->surname_2,
            'phone_number' => $request->phone_number,
            'city' => $request->city,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
 
        return response()->json([
            'message' => 'Usuario creado porque no existía',
            'user' => $user
        ], 201);
    }
 
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string',
        ]);
 
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Datos inválidos',
                'errors' => $validator->errors()
            ], 422);
        }
 
        $user = User::where('email', $request->email)->first();
 
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Credenciales incorrectas'
            ], 401);
        }
 
        $token = $user->createToken('api-token')->plainTextToken;
 
        return response()->json([
            'message' => 'Login correcto',
            'user' => $user,
            'token' => $token
        ], 200);
    }
 
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
 
        return response()->json([
            'message' => 'Logout correcto'
        ], 200);
    }
}