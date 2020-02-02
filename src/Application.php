<?php

namespace App;

use App\Endpoints\EndpointInterface;

class Application
{
    public $input;
    public $endpoint;

    public function __construct(Input $input, EndpointInterface $endpoint)
    {
        $this->input = $input;
        $this->endpoint = $endpoint;
    }

    public function run()
    {
        $result = $this->endpoint->setInput($this->input)->submit();

        var_export(
            json_decode($result->getBody()->getContents(), true)
        );
    }
}
