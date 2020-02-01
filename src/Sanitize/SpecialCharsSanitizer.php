<?php


namespace App\Sanitize;

class SpecialCharsSanitizer implements SanitizerInterface
{
    const CANDIDATES = ['!','@', '#', '$', '%','^','&',  '*'];

    public function sanitize(string $string): string
    {
        foreach (self::CANDIDATES as $char) {
            $string = str_replace($char, '', $string);
        }

        return $string;
    }
}
