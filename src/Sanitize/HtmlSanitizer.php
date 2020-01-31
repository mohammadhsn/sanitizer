<?php


namespace App\Sanitize;

class HtmlSanitizer implements SanitizerInterface
{
    public function sanitize(string $string): string
    {
        return strip_tags($string);
    }
}
