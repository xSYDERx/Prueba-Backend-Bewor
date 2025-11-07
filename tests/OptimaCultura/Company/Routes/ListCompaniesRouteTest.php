<?php

namespace Tests\OptimaCultura\Company\Routes;

use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class ListCompaniesRouteTest extends TestCase
{
    /**
     * @group route
     * @group access-interface
     * @test
     */
    #[Test]
    public function getListCompaniesRoute()
    {
        $faker = \Faker\Factory::create();
        // Crear 2 empresas de prueba
        $company1 = $this->json('POST', '/api/company', [
            'name' => $faker->name,
            'email' => $faker->email,
            'address' => $faker->address,
        ]);

        $company2 = $this->json('POST', '/api/company', [
            'name' => $faker->name,
            'email' => $faker->email,
            'address' => $faker->address,
        ]);

        $company1->assertStatus(201);
        $company2->assertStatus(201);

        // Obtener la lista de compañías
        $response = $this->json('GET', '/api/company');

        $response->assertStatus(200)
                 ->assertJsonCount(2)
                 ->assertJsonFragment(['name' => $company1->json('name')])
                 ->assertJsonFragment(['name' => $company2->json('name')]);
    }
}
