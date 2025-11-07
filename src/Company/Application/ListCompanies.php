<?php

namespace OptimaCultura\Company\Application;

use OptimaCultura\Company\Domain\CompanyRepositoryInterface;
use OptimaCultura\Shared\Domain\Interfaces\ServiceInterface;

final class ListCompanies implements ServiceInterface
{
    private CompanyRepositoryInterface $repository;

    public function __construct(CompanyRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Retrieve all companies
     *
     * @return array
     */
    public function handle(): array
    {
        $companies = $this->repository->findAll();

        return array_map(function($company) {
            return $company->toArray();
        }, $companies);
    }
}
