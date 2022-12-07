<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Laravel\Sanctum\PersonalAccessToken;

class AuthController extends Controller
{
    use HttpResponses;

    public function login(LoginUserRequest $request)
    {
        $request->validated($request->all());

        if (!Auth::attempt($request->only('email', 'password'))) {
            return $this->error('', 'Credentials does not match', 401);
        }

        $user = User::where('email', $request->email)->first();

        return $this->success([
            'user' => $user,
            'token' => $user->createToken('API token of ' . $user->name)->plainTextToken
        ]);
    }

    public function register(StoreUserRequest $request)
    {
        $request->validated($request->all());

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return $this->success([
            'user' => $user,
            'token' => $user->createToken('API token of ' . $user->name)->plainTextToken
        ]);
    }

    // mobile

    public function mobile_login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => 'required',
        ]);

        $user = User::select('name', 'email')::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        return $this->success([
            'user' => $user,
            'token' => $user->createToken('API token of ' . $user->name)->plainTextToken
        ]);
    }

    public function destroy(Request $request)
    {
        // $token = PersonalAccessToken::where('tokenable_id', Auth::user()->id)->first();
        // $request->user()->currentAccessToken()->delete();
        // $user = $token->tokenable;

        $user = $request->user();
        $user->tokens()->delete();

        return response()->json([
            'status' => 'successfull delete',
            'user' => $user,
        ]);
    }
}
