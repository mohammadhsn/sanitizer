<?php


namespace Test;

use App\Sanitizers\HtmlSanitizer;
use PHPUnit\Framework\TestCase;

class HtmlSanitizerTest extends TestCase
{
    private $sanitizer;

    public function setUp(): void
    {
        $this->sanitizer = new HtmlSanitizer();
    }

    public function test_it_removes_simple_tag()
    {
        $this->assertEquals($this->sanitizer->sanitize('<span>hello</span>'), 'hello');
    }

    public function test_it_merges_outer_and_inner_contents()
    {
        $this->assertEquals(
            $this->sanitizer->sanitize('Hello <p>World!</p>'),
            'Hello World!'
        );
    }
}
