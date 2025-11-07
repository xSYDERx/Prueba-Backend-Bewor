<?php

namespace App\Http\Controllers\Api\Company;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use OptimaCultura\Company\Application\ListCompanies;

class GetListCompaniesController extends Controller
{
    private ListCompanies $service;

    public function __construct(ListCompanies $service)
    {
        $this->service = $service;
    }

    public function __invoke()
    {
        DB::beginTransaction();
        try {
            $companies = $this->service->handle();
            DB::commit();
            return response()->json($companies, 200);
        } catch (\Throwable $error) {
            DB::rollback();
            return response()->json(['error' => $error->getMessage()], 500);
        }
    }
}
