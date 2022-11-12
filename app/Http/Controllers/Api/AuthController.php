<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        $validator = Validator::make(request()->all(), [
			'email' => 'required|email',
			'password' => 'required'
		]);

		if($validator->fails()) {
			return validationErrorResponse($validator->messages());
		};

		$user = User::where('email', request()->email)->first();

        if (! $user || ! Hash::check(request()->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
        $token = $user->createToken("auth")->plainTextToken;

		return $this->respondWithToken($token, $user);
    }

    protected function respondWithToken($token, $user)
	{
		return response()->json([
			'data' => [
				'access_token' => $token,
				'token_type' => 'bearer',
				'account' => Auth::user(),
			],
			'message' => 'User logged in successfully',
			'errors' => []
		]);
	}

    public function register(Request $request) {
        $validator = Validator::make(request()->all(), [
			'name' => 'required',
			'email' => 'required|string|email|max:255|unique:users',
			'password' => 'required'
		]);

        if($validator->fails()) {
			return validationErrorResponse($validator->messages());
		};

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $token = $user->createToken('auth')->plainTextToken;

		return $this->respondWithToken($token, $user);
    }
}
