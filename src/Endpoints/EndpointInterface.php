<?php

namespace App\Endpoints;

use App\Input;
use Psr\Http\Message\ResponseInterface;

interface EndpointInterface
{
    public function url(): string;

    public function submit(): ResponseInterface;

    public function setInput(Input $input): self;
}
