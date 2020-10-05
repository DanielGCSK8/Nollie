<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Model\User;

class DeleteTest extends TestCase
{
    
    /**
     * A basic feature test example.
     *
     * @return void
     */
  
    
    /** @test */
    public function aNotAuthenticatedCannotDeleteAUser()
    {
        $user = factory(User::class)->create();

        $this->get(route('users.destroy', $user))->
        assertRedirect('/home');
    }


}