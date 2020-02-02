<?php

namespace App\Endpoints;

use App\Input;

class JsonPlaceHolderEndpoint extends Endpoint
{
    protected $requiredParameters = ['content'];

    public function url(): string
    {
        return 'https://jsonplaceholder.typicode.com/posts';
    }

    public function setTitle($title): self
    {
        $this->parameters['title'] = $title;

        return $this;
    }

    public function setContent($content): self
    {
        $this->parameters['content'] = $content;

        return $this;
    }

    public function setInput(Input $input): EndpointInterface
    {
        $this->setContent($input->getValue());

        return $this;
    }
}
