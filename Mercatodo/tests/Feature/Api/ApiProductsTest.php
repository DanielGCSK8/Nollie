<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Model\Product;

class ExportTest extends TestCase
{
    /** @test */
    public function testItCanViewProductsList(): void
    {
        $response = $this->json('GET', route('Products.index'));

        $response->assertJson(Product::all()->toArray());
    }

}