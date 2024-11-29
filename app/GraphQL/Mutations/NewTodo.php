<?php declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\Models\Dto\CommonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

final readonly class NewTodo
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
            return new CommonResponse(false, -20);
        }
        $uid = $login->user_id;
        if (intval($uid) != intval($data['uid'])) {
            return new CommonResponse(false, -21);
        }
        $affected = DB::table('todos')
              ->insert([
                'todo' => $data['todo'],
                'todo_start' => $data['todo_start'],
                'todo_end' => $data['todo_end'],
                'uid' => $data['uid']
        ]);
        return new CommonResponse(true, 1);
    }
}
