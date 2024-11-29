<?php
namespace App\Models\Dto;
use App\Models\Todo;
use Illuminate\Support\Collection;

class TodoByIdResponse {
    public bool $success;
    public int $responseCode;
    public $data;
    public function __construct(bool $success, int $responseCode, $data) {
        $this->success = $success;
        $this->responseCode = $responseCode;
        $this->data = $data;
    }
}