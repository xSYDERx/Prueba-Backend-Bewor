<?php

namespace OptimaCultura\Company\Infrastructure;

use App\Models\Company as ModelsCompany;
use OptimaCultura\Company\Domain\Company;
use OptimaCultura\Company\Domain\CompanyRepositoryInterface;
use OptimaCultura\Company\Domain\ValueObject\CompanyId;
use OptimaCultura\Company\Domain\ValueObject\CompanyName;
use OptimaCultura\Company\Domain\ValueObject\CompanyEmail;
use OptimaCultura\Company\Domain\ValueObject\CompanyAddress;
use OptimaCultura\Company\Domain\ValueObject\CompanyStatus;

final class CompanyRepositoryEloquent implements CompanyRepositoryInterface
{
    /**
     * Guarda una nueva compañía en la base de datos
     */
    public function create(Company $company): void
    {
        ModelsCompany::create([
            'id'      => (string) $company->id()->get(),
            'name'    => $company->name()->get(),
            'email'   => $company->email()->get(),
            'address' => $company->address()->get(),
            'status'  => $company->status()->code(),
        ]);
    }

    /**
     * Devuelve todas las compañías
     */
    public function all(): array
    {
        return ModelsCompany::all()
            ->map(fn ($model) => new Company(
                CompanyId::fromString($model->id),
                new CompanyName($model->name),
                new CompanyEmail($model->email),
                new CompanyAddress($model->address),
                CompanyStatus::create($model->status)
            ))
            ->toArray();
    }

    /**
     * Busca una compañía por su ID
     */
    public function findById(string $id): ?Company
    {
        $model = ModelsCompany::find($id);

        if (!$model) {
            return null;
        }

        return new Company(
            CompanyId::fromString($model->id),
            new CompanyName($model->name),
            new CompanyEmail($model->email),
            new CompanyAddress($model->address),
            CompanyStatus::create($model->status)
        );
    }

    /**
     * Actualiza una compañía existente
     */
    public function save(Company $company): void
    {
        $this->update($company);
    }

    /**
     * Alias para save(), usado por casos de uso Enable/Disable
     */
    public function update(Company $company): void
    {
        ModelsCompany::where('id', $company->id()->get())
            ->update([
                'name'    => $company->name()->get(),
                'email'   => $company->email()->get(),
                'address' => $company->address()->get(),
                'status'  => $company->status()->code(),
            ]);
    }
}
