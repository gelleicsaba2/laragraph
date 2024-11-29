<?php declare(strict_types=1);

namespace App\GraphQL\Queries;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Dto\TodoByIdResponse;

final readonly class TodoById
{
    /** @param  array{}  $args */
    public function __invoke(null $_, array $args)
    {
        // TODO implement the resolver
        $data = $args;
        $hash = $data["hash"];
        $tm = time();
        $login = DB::table('login_sessions')
            ->where('user_token', $hash)
            ->where('expiration_time', '>', $tm)
                ->limit(1)->first();
        if (! $login) {
            return new TodoByIdResponse(false, -13, null);
        }
        $uid = $login->user_id;
        $id = $data['id'];
        $todo = DB::table('todos')
            ->where('id', $id)
            ->where('uid', $uid)
            ->limit(1)->first();
        if ($todo != null) {
            return new TodoByIdResponse(true, 1, $todo);
        }
        return new TodoByIdResponse(true, -14, null);
    }
}
