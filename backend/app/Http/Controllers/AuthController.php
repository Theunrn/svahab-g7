<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'email'     => 'required|string|max:255',
            'password'  => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'User not found'
            ], 401);
        }

        $user   = User::where('email', $request->email)->firstOrFail();
        $token  = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message'       => 'Login success',
            'access_token'  => $token,
            'token_type'    => 'Bearer'
        ]);
    }

    public function index(Request $request)
    {
        if (Auth::check()) {
            $user = $request->user();
            // $token = $request->bearerToken();
            return response()->json([
                'message' => 'Login success',
                'data' => $user,
                // 'access_token'  => $token,
                // 'token_type'    => 'Bearer'
            ]);
        } else {
            return  response()->json(['error' => 'User not found'], 404);
        }
    }
    public function show($id){
        $user = User::find($id);
        return response()->json(['success' => true, 'data' =>$user]);

    }
   
    public function register(RegisterRequest $request)
    {
        $token = User::store($request);
        return response()->json([
            'message'       => 'Register success',
            'access_token'  => $token,
            'token_type'    => 'Bearer'
        ], 201);
    }
    public function updateRole(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->syncRoles($request->role);
        return response()->json(['message' => 'Role updated successfully', 'role' => $user->getRoleNames()], 200);
    }

    public function logout(Request $request)
    {

        $request->user()->currentAccessToken()->delete();
        
        return response()->json(['message' => 'Successfully logged out']);
    }
}
