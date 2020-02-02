<?php

namespace Test\Utils;

use App\Endpoints\EndpointInterface;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;

class MockEndpointFactory
{
    protected $concrete;
    protected $response;
    protected $data = null;
    protected $status = 200;
    protected $headers = [];

    public function concrete($concrete): self
    {
        $this->concrete = $concrete;

        return $this;
    }

    public function responseContent($body, int $status = 200): self
    {
        if (is_array($body)) {
            $this->data = json_encode($body);
        } else {
            $this->data = $body;
        }

        $this->status = $status;

        return $this;
    }

    protected function getMock(): MockHandler
    {
        return new MockHandler([$this->getResponse()]);
    }

    protected function getResponse()
    {
        return $this->response ?: $this->buildNewResponse();
    }

    protected function buildNewResponse()
    {
        if (is_array($this->data)) {
            $content = json_encode($this->data);
        } else {
            $content = $this->data;
        }

        return new Response($this->status, $this->headers, $content);
    }

    public function create(): EndpointInterface
    {
        $this->validate();

        $mock = $this->getMock();

        $handler = HandlerStack::create($mock);

        $client =  new Client(['handler' => $handler]);

        return new $this->concrete($client);
    }

    /**
     * @param $concrete
     *
     * @return MockEndpointFactory
     */
    public static function from($concrete)
    {
        return (new static())->concrete($concrete);
    }

    protected function validate()
    {
        if (!$this->concrete || !$this->data) {
            throw new \RuntimeException('Set the concrete and response');
        }
    }
}
