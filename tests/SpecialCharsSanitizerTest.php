<?php


namespace Test;

use App\Sanitizers\SpecialCharsSanitizer;
use PHPUnit\Framework\TestCase;

class SpecialCharsSanitizerTest extends TestCase
{
    protected $sanitizer;

    protected function setUp(): void
    {
        $this->sanitizer = new SpecialCharsSanitizer();
    }

    public function test_it_removes_special_chars_separately()
    {
        $this->assertStringNotContainsString(
            $this->sanitizer->sanitize('he!!o world!'),
            '!'
        );

        $this->assertStringNotContainsString(
            $this->sanitizer->sanitize('preg@gmail.@com@'),
            '@'
        );

        $this->assertStringNotContainsString(
            $this->sanitizer->sanitize('$name=page*$*'),
            '$'
        );

        $this->assertStringNotContainsString(
            $this->sanitizer->sanitize('78%2=0'),
            '%'
        );

        $this->assertStringNotContainsString(
            $this->sanitizer->sanitize('^name=moc^k^^'),
            '^'
        );

        $this->assertStringNotContainsString(
            $this->sanitizer->sanitize('a&b=b&&a'),
            '&'
        );

        $this->assertStringNotContainsString(
            $this->sanitizer->sanitize('*ru*ko**'),
            '*@'
        );
    }

    public function test_it_removes_special_chars_together()
    {
        $this->assertStringNotContainsString(
            $this->sanitizer->sanitize('^y_name_is_@mohammad!!'),
            '*@'
        );

        $this->assertStringNotContainsString(
            $this->sanitizer->sanitize('$What&is**y^ours!!'),
            '*!$&@'
        );
    }
}
