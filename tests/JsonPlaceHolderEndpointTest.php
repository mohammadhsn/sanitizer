<?php

namespace Test;

use App\Endpoints\JsonPlaceHolderEndpoint;
use App\Input;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use RuntimeException;
use Test\Utils\MockEndpointFactory;

class JsonPlaceHolderEndpointTest extends TestCase
{
    /**
     * @var JsonPlaceHolderEndpoint
     */
    protected $endpoint;

    public function setUp(): void
    {
        $this->endpoint = MockEndpointFactory::from(JsonPlaceHolderEndpoint::class)
            ->responseContent(['id' => 1, 'title' => 'a', 'content' => 'b'])
            ->create();
    }

    public function test_cannot_submit_without_content()
    {
        $this->expectException(RuntimeException::class);
        $this->endpoint->submit();
    }

    public function test_it_sets_content_via_input_object_correctly()
    {
        $this->assertInstanceOf(
            ResponseInterface::class,
            $this->endpoint->setInput(new Input('acme'))->submit()
        );
    }
}
