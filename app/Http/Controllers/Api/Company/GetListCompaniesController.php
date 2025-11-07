<?php

namespace App\Http\Controllers\Api\Company;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use OptimaCultura\Company\Application\ListCompanies;

class GetListCompaniesController extends Controller
{
    /**
     * List all companies
     */
    public function __invoke(ListCompanies $service)
    {
        DB::beginTransaction();
        try {
            $companies = $service->handle();
            DB::commit();
            return response()->json($companies, 200);
        } catch (\Throwable $error) {
            DB::rollback();
            throw $error;
        }
    }
}
