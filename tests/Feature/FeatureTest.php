<?php

namespace EcoOnline\EcoPackage\Tests\Feature;

use Tests\TestCase;

class FeatureTest extends TestCase
{
    /** @test */
    public function eco_test(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }
}
