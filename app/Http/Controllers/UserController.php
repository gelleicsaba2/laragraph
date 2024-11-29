<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function login(Request $request) {
        $data = $request->json()->all();
        $user = DB::table('users')->where('name', $data['name'])->first();
        if ($user && $user->pass == md5('aXd'.$data['pass'].'dXa')) {
            $uid = $user->id;
            do {
                $hash = md5(explode(" ", (string)microtime())[1].'aXddXa'.$uid*7);
                $login = DB::table('login_sessions')->where('user_token', $uid)->limit(1)->first();
            } while ($login);
            $expiration = time() + 310;
            DB::table('login_sessions')->insert([
                ['user_token' => $hash, 'user_id' => $uid, 'expiration_time' => $expiration ]
            ]);
            return response()->json([
                'ok' => true,
                'hash' => $hash,
                'expire' => $expiration
            ]);;
        }
        return response()->json([
            'ok' => false,
            'errcode' => 1,
            'error' => 'incorrect'
        ]);;
    }
    public function test(Request $request) {
        return "Hello";
    }
}
