<?php

namespace App\Endpoints;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Psr\Http\Message\ResponseInterface;

abstract class Endpoint implements EndpointInterface
{
    protected $client;

    protected $method = 'post';

    protected $json = true;

    protected $parameters = [];

    protected $requiredParameters = [];


    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function submit(): ResponseInterface
    {
        $this->validate();

        return $this->client->request($this->getMethod(), $this->url(), $this->getOptions());
    }

    protected function getParams()
    {
        return $this->parameters;
    }

    protected function getOptions(): array
    {
        $options = [];

        if ($this->isMethod('get')) {
            $key = RequestOptions::QUERY;
        } else {
            if ($this->json) {
                $key = RequestOptions::JSON;
            } else {
                $key = RequestOptions::FORM_PARAMS;
            }
        }

        $options[$key] = $this->getParams();

        return $options;
    }

    protected function isMethod(string $method): bool
    {
        return $this->getMethod() == strtolower($method);
    }

    public function getMethod(): string
    {
        return strtolower($this->method);
    }

    protected function requiredParameters(): array
    {
        return $this->requiredParameters;
    }

    protected function validate(): void
    {
        foreach ($this->requiredParameters() as $parameter) {
            if (!array_key_exists($parameter, $this->parameters)) {
                throw new \RuntimeException("Missing required parameter {$parameter}");
            }
        }
    }

    public static function instance($client = null): self
    {
        return new static($client ?: new Client());
    }
}
