<?php

namespace Tests\OptimaCultura\Company\Routes;

use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class EnableCompanyRouteTest extends TestCase
{
    /**
     * @group route
     * @group access-interface
     * @test
     */
    #[Test]
    public function patchEnableCompanyRoute()
    {
        $faker = \Faker\Factory::create();
        // Crear empresa de prueba
        $responseCreate = $this->json('POST', '/api/company', [
            'name' => $faker->name,
            'email' => $faker->email,
            'address' => $faker->address,
        ]);

        $responseCreate->assertStatus(201);
        $companyId = $responseCreate->json('id');

        // Habilitar la compañía
        $response = $this->json('PATCH', "/api/company/{$companyId}/enable");

        $response->assertStatus(200)
                 ->assertJsonFragment(['status' => 'active']);
    }
}
