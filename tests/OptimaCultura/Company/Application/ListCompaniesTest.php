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

use OptimaCultura\Company\Application\ListCompanies;
use OptimaCultura\Company\Domain\CompanyRepositoryInterface;

final class ListCompaniesTest extends TestCase
{
    #[Test]
    public function listAllCompanies()
    {
        $faker = \Faker\Factory::create();

        $company1 = new Company(
            new CompanyId(Str::uuid()),
            new CompanyName('Company 1'),
            new CompanyEmail($faker->email),
            new CompanyAddress($faker->address),
            CompanyStatus::enabled()
        );

        $company2 = new Company(
            new CompanyId(Str::uuid()),
            new CompanyName('Company 2'),
            new CompanyEmail($faker->email),
            new CompanyAddress($faker->address),
            CompanyStatus::disabled()
        );

        $repository = new class([$company1, $company2]) implements CompanyRepositoryInterface {
            private array $companies = [];
            public function __construct($companies) {
                foreach ($companies as $c) { $this->companies[$c->id()->get()] = $c; }
            }
            public function create(Company $company): void { $this->companies[$company->id()->get()] = $company; }
            public function update(Company $company): void { $this->companies[$company->id()->get()] = $company; }
            public function findById($id): ?Company { return $this->companies[$id->get()] ?? null; }
            public function all(): array { return array_values($this->companies); }
        };

        $service = new ListCompanies($repository);
        $companies = $service->handle();

        $this->assertCount(2, $companies);
        $this->assertContainsOnlyInstancesOf(Company::class, $companies);
    }
}
