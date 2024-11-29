<?php declare(strict_types=1);

namespace App\GraphQL\Queries;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Dto\TodosResponse;

final readonly class Todos
{
    /** @param  array{}  $args */
    public function __invoke(null $_, array $args)
    {
        // TODO implement the resolver
        $data = $args;
        $start = $data["start"];
        $hash = $data["hash"];
        $tm = time();
        $login = DB::table('login_sessions')
            ->where('user_token', $hash)
            ->where('expiration_time', '>', $tm)
                ->limit(1)->first();
        if (! $login) {
            return new TodosResponse(false, -8, []);
        }
        $uid = $login->user_id;
        $sort = array_key_exists('sort', $data) ? $data['sort'] : 'asc';
        $todos = [];
        if (! array_key_exists('search', $data)) {
            $todos = DB::table('todos')
            ->where('uid', $uid)
            ->where('todo_start', '>=', $start)
            ->where('todo_end', '>=', $start)
            ->orderBy('todo_start', $sort)
            ->limit(365)
            ->get()->toArray();
        } else {
            $todos = DB::table('todosview')
            ->where('uid', $uid)
            ->where('todo_start', '>=', $start)
            ->where('todo_end', '>=', $start)
            ->where(function ( \Illuminate\Database\Query\Builder $query) use ($data) {
                $query->where('todo', 'LIKE', '%' . $data["search"] . '%')
                      ->orWhere('todo_startStr', 'LIKE', '%' . $data["search"] . '%');
            })
            ->orderBy('todo_start', $sort)
            ->limit(365)
            ->get()->toArray();
        }
        // Log::debug('$todos : '.print_r($todos, true));
        if ($todos != null) {
            Log::debug('$todos != null');
            $rsp = new TodosResponse(true, 1, $todos);
            Log::debug('$todos rsp: '. print_r($rsp, true));
            return $rsp;
        }
        return new TodosResponse(false, -7, []);
    }
}
