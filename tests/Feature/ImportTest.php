<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ImportTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_product_import(): void
    {

        $file = 'public/storage/importexample.xlsx';

        $response = $this->post(route('import'),['file' => $file]);

        $response->assertStatus(302);
    }
}
