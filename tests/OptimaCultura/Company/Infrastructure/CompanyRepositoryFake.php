<?php

namespace Tests\OptimaCultura\Company\Infrastructure;

use OptimaCultura\Company\Domain\Company;
use OptimaCultura\Company\Domain\CompanyRepositoryInterface;

class CompanyRepositoryFake implements CompanyRepositoryInterface
{
    public bool $callMethodCreate = false;

    /**
     * @inheritdoc
     */
    public function create(Company $company): void
    {
        $this->callMethodCreate = true;
        $this->companies[$company->id()->get()] = $company;
    }

    public function update(Company $company): void
    {
        $this->companies[$company->id()->get()] = $company;
    }

    public function findById($id): ?Company
    {
        $idValue = is_string($id) ? $id : $id->get();
        return $this->companies[$idValue] ?? null;
    }

    public function all(): array
    {
        return array_values($this->companies);
    }
}
