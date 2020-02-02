<?php


use App\Input;
use App\Sanitizers\SanitizerInterface;
use PHPUnit\Framework\TestCase;

class InputTest extends TestCase
{
    protected $input;

    protected function setUp(): void
    {
        $this->input = new Input('some content');
    }

    public function test_it_applies_sanitizers()
    {
        $html = Mockery::mock(SanitizerInterface::class);
        $html->shouldReceive('sanitize')
            ->andReturn('hello');


        $this->input->addSanitizer($html);

        $this->assertEquals('hello', $this->input->getValue());

        $special = Mockery::mock(SanitizerInterface::class);
        $special->shouldReceive('sanitize')
            ->andReturn('acme');

        $this->input->addSanitizer($special);

        $this->assertEquals('acme', $this->input->getValue());
    }
}
