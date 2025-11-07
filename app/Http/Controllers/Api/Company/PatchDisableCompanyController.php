<?php

namespace App\Http\Controllers\Api\Company;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use OptimaCultura\Company\Application\DisableCompany;

class PatchDisableCompanyController extends Controller
{
    private DisableCompany $service;

    public function __construct(DisableCompany $service)
    {
        $this->service = $service;
    }

    public function __invoke(string $id)
    {
        DB::beginTransaction();
        try {
            $company = $this->service->handle($id);
            DB::commit();
            return response()->json($company->toArray(), 200);
        } catch (\Throwable $error) {
            DB::rollback();
            return response()->json(['error' => $error->getMessage()], 500);
        }
    }
}
