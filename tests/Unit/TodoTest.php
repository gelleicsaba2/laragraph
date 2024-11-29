<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\GraphQL\Mutations\LoginUser;
use App\GraphQL\Mutations\LogoutUser;
use App\GraphQL\Mutations\CheckUser;
use App\GraphQL\Mutations\Signup;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class TodoTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_example(): void
    {
        // $login = new LoginUser();
        // $rsp = $login->__invoke(null, ['name'=>'admin', 'pass'=>'qq']);
        // $hash = $rsp->hash;
        // DB::

        $this->assertTrue(true);
    }
}
