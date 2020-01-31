<?php


namespace App\Sanitize;


interface SanitizerInterface
{
    public function sanitize(string $string): string;
}
