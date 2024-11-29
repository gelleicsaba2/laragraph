<?php
namespace App\Models\Dto;
use App\Models\Todo;
use Illuminate\Support\Collection;

class TodosResponse {
    public bool $success;
    public int $responseCode;
    public Array $data;
    public function __construct(bool $success, int $responseCode, Array $data) {
        $this->success = $success;
        $this->responseCode = $responseCode;
        $this->data = $data;
    }
}