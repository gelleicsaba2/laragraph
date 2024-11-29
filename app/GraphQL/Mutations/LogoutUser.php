<?php declare(strict_types=1);

namespace App\GraphQL\Mutations;
use App\Models\Dto\LogoutResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

final readonly class LogoutUser
{
    /** @param  array{}  $args */
    public function __invoke(null $_, array $args)
    {
        // TODO implement the resolver
        $data = $args;
        Log::debug('LogoutUser::invoke '.print_r($args, true));

        $login = DB::table('login_sessions')->where('user_token', $data['hash'])->limit(1)->first();
        if ($login == null) {
            return new LogoutResponse(false, -2);
        }
        $user = DB::table('users')
            ->where('name', $data['name'])
            ->where('id', $login->user_id)
                ->limit(1)->first();
        if ($login == null) {
            return new LogoutResponse(false, -3);
        }
        $affected = DB::table('login_sessions')
            ->where('id', $login->id)
            ->update(['expiration_time' => 0]);
        Log::debug('LogoutUser::invoke update '.print_r($affected, true));
        return new LogoutResponse(true, 1);
    }
}
