<?php
namespace App\Models\Dto;

class LoginResponse
{
    public bool $success;
    public string $hash;
    public string $fullname;
    public string $email;
    public int $responseCode;
    public int $expire;

    public function __construct(bool $success, string $hash, string $fullname, string $email, int $responseCode, int $expire) {
        $this->success = $success;
        $this->hash = $hash;
        $this->fullname = $fullname;
        $this->email = $email;
        $this->responseCode = $responseCode;
        $this->expire = $expire;
    }
}
