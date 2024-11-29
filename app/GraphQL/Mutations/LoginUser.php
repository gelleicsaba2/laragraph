<?php declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\Models\Dto\LoginResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

final readonly class LoginUser
{
    /** @param  array{}  $args */
    public function __invoke(null $_, array $args)
    {
        // TODO implement the resolver
        $data = $args;
        Log::debug('LoginUser::invoke '.print_r($args, true));
        $user = DB::table('users')->where('name', $data['name'])
            ->limit(1)->first();
        if ($user && $user->pass == md5('aXd'.$data['pass'].'dXa')) {
            $uid = $user->id;
            do {
                $hash = md5(explode(" ", (string)microtime())[1].'aXddXa'.$uid*7);
                $login = DB::table('login_sessions')->where('user_token', $hash)->limit(1)->first();
            } while ($login != null);
            $expiration = time() + 310;
            DB::table('login_sessions')->insert([
                ['user_token' => $hash, 'user_id' => $uid, 'expiration_time' => $expiration ]
            ]);
            return new LoginResponse(true, $hash, $user->fullname, $user->email, 1, $expiration);
        }
        return new LoginResponse(false, '', '', '', -1, 0);
    }
}
