<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Model\Product;
use App\Model\User;
use Illuminate\Support\Facades\Auth;

class CreateTest extends TestCase
{
    /** @test */
    public function unauthorized_cannot_access_to_create_products_view(): void
    {
        $this->get(route('products.create'))->assertRedirect(route('home'));
    }
 
    

     /** @test */
     public function authorized_user_can_access_to_create_products_view(): void
     {
         
         $user = factory(User::class)->create();
 
         $response = $this->actingAs($user)->get(route('products.create'));
         if ($user->role_id=='1')
         $response->assertStatus(200)
                  ->assertViewIs('products.create');
         
     }

}