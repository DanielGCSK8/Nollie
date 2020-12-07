<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Model\User;

class IndexTest extends TestCase
{

      /** @test */
      public function authorized_user_can_access_to_users_index(): void
      {
          $user = factory(User::class)->create();
  
          $response = $this->actingAs($user)->get(route('users.index'));
          $response->assertStatus(302);
        

      }

    /** @test */
    public function unauthorized_cannot_access_to_users_index(): void
    {
        $this->get(route('users.index'))->assertRedirect(route('home'));
    }
}
