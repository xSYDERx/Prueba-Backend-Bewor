<?php

namespace OptimaCultura\Company\Domain\ValueObject;

use InvalidArgumentException;

final class CompanyEmail
{
    private string $value;

    public function __construct(string $value)
    {
        $value = trim($value);

        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException("Invalid email: $value");
        }

        $this->value = $value;
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
