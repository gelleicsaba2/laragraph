<?php
namespace App\Models\Dto;

class LogoutResponse
{
    public bool $success;
    public int $responseCode;

    public function __construct(bool $success, int $responseCode) {
        $this->success = $success;
        $this->responseCode = $responseCode;
    }
}
