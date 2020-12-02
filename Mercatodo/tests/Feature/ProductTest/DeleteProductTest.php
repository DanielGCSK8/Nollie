<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Model\Product;
use App\Model\User;

class DeleteProductTest extends TestCase
{
    /** @test */
    public function unathorizedCannotDeleteProducts(): void
    {
        $product = factory(Product::class)->create();

        $this->delete(route('products.destroy', $product))
            ->assertRedirect(route('home'));

        $this->assertDatabaseHas('products', [
            'id' => $product->id,
        ]);
    }

       /** @test */
    public function AuthorizedCanDeleteProducts(): void
    {
        $this->withoutExceptionHandling();
        $user = factory(User::class)->create();
        $product = factory(Product::class)->create();

            if($user->role_id==1)
            $this->actingAs($user)->delete(route('products.destroy', $product))
            ->assertRedirect(route('products.index'));
            $this->assertDatabaseHas('products', [
            'id' => $product->id
        ]);
        
    }

}
