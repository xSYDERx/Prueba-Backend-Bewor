<?php

namespace App\Http\Controllers\Api\Company;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use OptimaCultura\Company\Application\EnableCompany;

class PatchEnableCompanyController extends Controller
{
    /**
     * Enable a company
     */
    public function __invoke(string $id, EnableCompany $service)
    {
        DB::beginTransaction();
        try {
            $company = $service->handle($id);
            DB::commit();
            return response()->json($company->toArray(), 200);
        } catch (\Throwable $error) {
            DB::rollback();
            throw $error;
        }
    }
}
