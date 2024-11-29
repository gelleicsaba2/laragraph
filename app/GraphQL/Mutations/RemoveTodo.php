<?php declare(strict_types=1);

namespace App\GraphQL\Mutations;
use App\Models\Dto\CommonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

final readonly class RemoveTodo
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
        if (! $login || $login == null) {
            return new CommonResponse(false, -16);
        }
        $uid = $login->user_id;
        if (intval($uid) != intval($data['uid'])) {
            return new CommonResponse(false, -17);
        }
        $todo = DB::table('todos')->where('id', $data['id'])->limit(1)->first();
        if (! $todo || $todo == null) {
            return new CommonResponse(false, -18);
        }
        if (intval($todo->uid) != intval($uid)) {
            return new CommonResponse(false, -19);
        }
        $affected = DB::table('todos')
              ->where('id', $todo->id)
              ->delete();
        return new CommonResponse(true, 1);
    }
}
