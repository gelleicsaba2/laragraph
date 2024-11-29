<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\GraphQL\Mutations\LoginUser;
use App\GraphQL\Mutations\LogoutUser;
use App\GraphQL\Mutations\CheckUser;
use App\GraphQL\Mutations\Signup;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class UserTest extends TestCase
{

    private function storageFile(string $file) {
        return __DIR__.'/../../storage/app/private/'.$file;
    }

    private function recoverId() {
        $user = DB::select('SELECT * FROM users ORDER BY id DESC LIMIT 1');
        DB::statement('ALTER TABLE users AUTO_INCREMENT='. strval($user[0]->id + 1) );
    }

    public function test_login_service(): void
    {
        $login = new LoginUser();
        $rsp = $login->__invoke(null, ['name'=>'admin', 'pass'=>'qq']);
        if ($rsp != null && $rsp->success) {
            file_put_contents($this->storageFile('hash'), $rsp->hash);
        }
        $this->assertTrue(
            $rsp != null && $rsp->success == true
        );
    }
    public function test_check_with_valid_hash_service(): void
    {
        $check = new CheckUser();
        $rsp = $check->__invoke(null, [
                'hash' => file_get_contents($this->storageFile('hash')),
                'passive' => false
            ] );
        $this->assertTrue(
            $rsp != null && $rsp->success == true
        );
    }
    public function test_check_with_invalid_hash_service(): void
    {
        $check = new CheckUser();
        $rsp = $check->__invoke(null, ['hash' => 'invalid-hash', 'passive' => true ] );
        $this->assertTrue(
            $rsp != null && $rsp->success == false && $rsp->responseCode < 0
        );
    }
    public function test_logout_service(): void
    {
        $logout = new LogoutUser();
        $rsp = $logout->__invoke(null, [
                'hash' => file_get_contents($this->storageFile('hash')),
                'name' => 'admin'
            ]);
        if ($rsp != null && $rsp->success) {
            unlink($this->storageFile('hash'));
        }
        $this->assertTrue(
            $rsp != null && $rsp->success == true
        );
    }
    public function test_signup_service(): void
    {
        $signup = new Signup();
        $faker = \Faker\Factory::create();
        $full_name = $faker->name();
        $name = strtolower(str_replace(' ', '_', $full_name));
        $email = $faker->email();
        $pass = Str::password(16, true, true, false, false);
        $user = [
            'fullname' => $full_name,
            'name' => $name,
            'email' => $email,
            'pass' => $pass
        ];
        $rsp = $signup->__invoke(null, $user);
        if ($rsp != null && $rsp->success) {
            DB::table('users')
                ->where('email', $email)
                ->where('name', $name)
            ->delete();
            $this->recoverId();
        }
        $this->assertTrue(
            $rsp != null && $rsp->success == true
        );
    }
    public function test_signup_with_invalid_duplication_service(): void
    {
        $signup = new Signup();
        $faker = \Faker\Factory::create();
        $full_name = $faker->name();
        $name = strtolower(str_replace(' ', '_', $full_name));
        $email = $faker->email();
        $pass = Str::password(16, true, true, false, false);
        $user = [
            'fullname' => $full_name,
            'name' => $name,
            'email' => $email,
            'pass' => $pass
        ];
        $rsp0 = $signup->__invoke(null, $user);
        $full_name = $faker->name();
        $name = strtolower(str_replace(' ', '_', $full_name));
        // email hasn't been changed !
        $user2 = [
            'fullname' => $full_name,
            'name' => $name,
            'email' => $email,
            'pass' => $pass
        ];
        $rsp = $signup->__invoke(null, $user);
        if ($rsp0 != null && $rsp0->success) {
            DB::table('users')
                ->where('email', $email)
            ->delete();
            $this->recoverId();
        }
        $this->assertTrue(
            $rsp != null && $rsp->success == false && $rsp->responseCode < 0
        );
    }
    public function test_signup_with_invalid_data_service(): void
    {
        $signup = new Signup();
        $faker = \Faker\Factory::create();
        $full_name = $faker->name();
        $name = 'x';
        $email = $faker->email();
        $pass = Str::password(16, true, true, false, false);
        $user = [
            'fullname' => $full_name,
            'name' => $name,
            'email' => $email,
            'pass' => $pass
        ];
        $rsp = $signup->__invoke(null, $user);
        $this->assertTrue(
            $rsp != null && $rsp->success == false
        );
    }
    public function test_signup_with_invalid_email_service(): void
    {
        $signup = new Signup();
        $faker = \Faker\Factory::create();
        $full_name = $faker->name();
        $name = strtolower(str_replace(' ', '_', $full_name));
        $email = $name.".gmail.com";
        $pass = Str::password(16, true, true, false, false);
        $user = [
            'fullname' => $full_name,
            'name' => $name,
            'email' => $email,
            'pass' => $pass
        ];
        $rsp = $signup->__invoke(null, $user);
        $this->assertTrue(
            $rsp != null && $rsp->success == false && $rsp->responseCode == -15
        );
    }

}
