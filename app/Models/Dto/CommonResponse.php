<?php
namespace App\Models\Dto;

class CommonResponse
{
    public bool $success;
    public int $responseCode;

    public function __construct(bool $success, int $responseCode) {
        $this->success = $success;
        $this->responseCode = $responseCode;
    }
}
