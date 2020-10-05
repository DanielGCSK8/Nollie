<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Model\User;
use App\Model\Product;

class EditTest extends TestCase
{
    /** @test */
    public function guests_cannot_access_to_edit_products_view()
    {
        $product = factory(Product::class)->create();

        $this->get(route('products.edit', $product))
            ->assertRedirect(route('home'));
    }

}