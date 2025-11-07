<?php

namespace OptimaCultura\Company\Domain\ValueObject;

final class CompanyAddress
{
    private string $value;

    public function __construct(string $value)
    {
        $this->value = trim($value);
    }

    public function get(): string
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
