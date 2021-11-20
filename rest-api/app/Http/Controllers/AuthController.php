<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request){
        // ambil data yang samain kyk di User
        // Input datanya ke database pake User Model
        $input = [
            'name'  => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password) // biar di hash (dienkripsi)
        ];

        $user = User::create($input);

        $data = [
            'message' => 'register is successfully'
        ];

        return response()->json($data, 200);
    }

    public function login(Request $request){
        /** Logicnya
         * Ambil input email dan pass dari user
         * Ambil imput email dan pass dari database berdasarkan email
         * bandingin data dari inputan user ama data yang ada di database
         */

         $input = [
            'email'     => $request->email,
            'password'  => $request->password,
         ];

         // $user = User::where('email', $input['email'])->first(); karena dh paek Auth:user maka gk perlu

         if (Auth::attempt($input)){ //klo gk pake Auth begini : $input['email'] == $user->email && Hash::check($input ['password'], $user->password)
            $token = Auth::user()->createToken('auth_token');

            $data = [
                'message'   => 'Login is successfully',
                'token'     => $token->plainTextToken
            ];

            return response()->json($data, 200);
         }
         else{
            $data = [
                'message'   => 'Login is Failed',
            ];

            return response()->json($data, 401);
         }
    }
}
