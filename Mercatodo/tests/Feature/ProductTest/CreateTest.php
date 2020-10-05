<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Model\Product;
use App\Model\User;

class CreateTest extends TestCase
{
    /** @test */
    public function guests_cannot_access_to_create_products_view()
    {
        $this->get(route('products.create'))->assertRedirect(route('home'));
    }
 
    /** @test */
    public function unauthorized_user_cannot_access_to_create_products_view()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)->get(route('products.create'))
            ->assertStatus(302);
    }

}