<?php declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\Models\Dto\CommonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


final readonly class CheckUser
{
    /** @param  array{}  $args */
    public function __invoke(null $_, array $args)
    {
        // TODO implement the resolver
        $data = $args;
        Log::debug('CheckUser::invoke '.print_r($args, true));

        $tm = time();
        $login = DB::table('login_sessions')
            ->where('user_token', $data['hash'])
            ->where('expiration_time', '>', $tm)
                ->limit(1)->first();
        if ($login == null) {
            return new CommonResponse(false, -4);
        }

        if (! $data["passive"]) {
            $expiration = time() + 310;
            $affected = DB::table('login_sessions')
                ->where('id', $login->id)
                ->update(['expiration_time' => $expiration]);
            return new CommonResponse(true, 310);
        } else {
            $expiration = $login->expiration_time - $tm;
            return new CommonResponse(true, $expiration);
        }
    }
}
