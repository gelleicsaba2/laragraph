<?php declare(strict_types=1);

namespace App\GraphQL\Mutations;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Dto\CommonResponse;

final readonly class Signup
{
    /** @param  array{}  $args */
    public function __invoke(null $_, array $args)
    {
        $data = $args;
        Log::debug('Signup::invoke '.print_r($args, true));
        $fullname = $data['fullname'];
        $email = $data['email'];
        $name = $data['name'];
        $pass = $data['pass'];

        $user = DB::table('users')
            ->where('name', $name)
            ->orWhere('email', $email)
            ->limit(1)
            ->first();
        if ($user) {
            return new CommonResponse(false, -5);
        }
        $passMd5 = md5('aXd'.$pass.'dXa');
        DB::table('users')->insert([
            ['name' => $name, 'fullname' => $fullname, 'pass' => $passMd5, 'email' => $email]
        ]);
        $user = DB::table('users')
            ->where('name', $name)
            ->where('email', $email)
            ->limit(1)
            ->first();
        if ($user) {
            return new CommonResponse(true, 1);
        }
        return new CommonResponse(false, -6);
    }
}
