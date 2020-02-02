<?php


namespace App\Sanitizers;

interface SanitizerInterface
{
    public function sanitize(string $string): string;
}
