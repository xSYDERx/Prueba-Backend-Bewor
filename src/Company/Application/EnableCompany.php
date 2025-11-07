<?php

namespace OptimaCultura\Company\Application;

use OptimaCultura\Company\Domain\Company;
use OptimaCultura\Company\Domain\ValueObject\CompanyId;
use OptimaCultura\Company\Domain\ValueObject\CompanyStatus;
use OptimaCultura\Company\Domain\CompanyRepositoryInterface;
use OptimaCultura\Shared\Domain\Interfaces\ServiceInterface;

class EnableCompany implements ServiceInterface
{
    private CompanyRepositoryInterface $companyRepository;

    public function __construct(CompanyRepositoryInterface $companyRepository){
        $this->companyRepository = $companyRepository;
    }

    public function handle (string $id): Company{

        $company = $this->companyRepository->findById(new CompanyId($id));

        if (!$company) {
            throw new \Exception("Company not found");
        }

        $company->setStatus(CompanyStatus::enabled());

        $this->companyRepository->update($company);

        return $company;

    }
}