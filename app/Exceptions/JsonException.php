<?php

namespace App\Exceptions;

use Symfony\Component\HttpKernel\Exception\HttpException;

class JsonException extends HttpException
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
        parent::__construct($this->data['metadata']['status'], $this->data['metadata']['message']);
    }

    public function render()
    {
        return response()->json($this->data, $this->data['metadata']['status']);
    }
}
