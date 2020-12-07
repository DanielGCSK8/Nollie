<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Model\User;
use App\Model\Product;

class EditTest extends TestCase
{
    /** @test */
    public function unauthorized_cannot_access_to_edit_products_view(): void
    {
        $product = factory(Product::class)->create();

        $this->get(route('products.edit', $product))
            ->assertRedirect(route('home'));
    }

       /** @test */
       public function authorized_user_can_access_to_edit_products_view(): void
       {
           $product = factory(Product::class)->create();
           $user = factory(User::class)->create();
   
           
           $response = $this->actingAs($user)->get(route('products.edit', $product));
           if ($user->role_id=='1')
           $response->assertStatus(200)
                    ->assertViewIs("products.edit");
           
       }

       /** @test */
       public function AuthorizedCanEditProduct(): void
       {
           $user = factory(User::class)->create();
           $response = $this->actingAs($user)->get(route('products.edit', [
               'product' => Product::all()->random()->id,
           ]));
           if ($user->role_id=='1')
           $response
               ->assertStatus(200)
               ->assertViewIs('products.edit');
               
       }

}