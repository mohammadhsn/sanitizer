<?php


namespace App;

use App\Sanitizers\SanitizerInterface;

class Input
{
    protected $stream;

    /**
     * @var SanitizerInterface []
     */
    protected $sanitizers = [];

    public function __construct(string $stream)
    {
        $this->stream = $stream;
    }

    public function addSanitizer(SanitizerInterface $sanitizer): self
    {
        $this->sanitizers [] = $sanitizer;

        return $this;
    }

    protected function clean(): self
    {
        foreach ($this->sanitizers as $sanitizer) {
            $this->stream = $sanitizer->sanitize($this->stream);
        }

        return $this;
    }

    public function getValue(): string
    {
        return $this->clean()->stream;
    }
}
