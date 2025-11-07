<?php

namespace Tests\OptimaCultura\Company\Application;

use Tests\TestCase;
use Illuminate\Support\Str;
use PHPUnit\Framework\Attributes\Test;

use OptimaCultura\Company\Domain\Company;
use OptimaCultura\Company\Domain\ValueObject\CompanyId;
use OptimaCultura\Company\Domain\ValueObject\CompanyName;
use OptimaCultura\Company\Domain\ValueObject\CompanyEmail;
use OptimaCultura\Company\Domain\ValueObject\CompanyAddress;
use OptimaCultura\Company\Domain\ValueObject\CompanyStatus;

use OptimaCultura\Company\Application\EnableCompany;
use OptimaCultura\Company\Domain\CompanyRepositoryInterface;

final class EnableCompanyTest extends TestCase
{
    #[Test]
    public function enableACompany()
    {
        $faker = \Faker\Factory::create();
        $companyId = Str::uuid();

        $company = new Company(
            new CompanyId($companyId),
            new CompanyName($faker->company),
            new CompanyEmail($faker->email),
            new CompanyAddress($faker->address),
            CompanyStatus::disabled()
        );

        $repository = new class($company) implements CompanyRepositoryInterface {
            private array $companies = [];
            public function __construct($company) { $this->companies[$company->id()->get()] = $company; }
            public function create(Company $company): void { $this->companies[$company->id()->get()] = $company; }
            public function update(Company $company): void { $this->companies[$company->id()->get()] = $company; }
            public function findById($id): ?Company { return $this->companies[$id->get()] ?? null; }
            public function all(): array { return array_values($this->companies); }
        };

        $service = new EnableCompany($repository);
        $enabledCompany = $service->handle($companyId);

        $this->assertInstanceOf(Company::class, $enabledCompany);
        $this->assertEquals('active', $enabledCompany->status()->name());
    }
}
