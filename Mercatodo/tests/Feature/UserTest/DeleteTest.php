<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Auth;
use App\Model\User;

class DeleteTest extends TestCase
{
    
    /**
     * A basic feature test example.
     *
     * @return void
     */
  
    
    /** @test */
    public function aNotAuthenticatedCannotDeleteAUser(): void
    {
        $user = factory(User::class)->create();

        $this->get(route('users.destroy', $user))->
        assertRedirect('/home');
    }

        /** @test */
        public function authorized_user_can_delete_users(): void
        {
            
            $user = factory(User::class)->create();
    
            $response = $this->actingAs($user)->delete(route('users.destroy', $user));
    
            $this->assertDatabaseHas('users', [
                'id' => $user->id
            ]);
        }


}