<?php

namespace OptimaCultura\Company\Domain\ValueObject;

use OptimaCultura\Shared\ValueObject\Uuid;

class CompanyId extends Uuid
{
    public static function fromString(string $id): self
    {
        return new self($id);
    }
}
