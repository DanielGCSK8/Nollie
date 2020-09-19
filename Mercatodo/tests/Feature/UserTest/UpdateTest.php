<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;

class UpdateTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    
    /** @test */
    public function aNotAuthenticatedCannotUpdateAUser()
    {
        $user = factory(User::class)->create();

        $this->get(route('users.update', $user))->
        assertRedirect('/home');
    }

    /** @test */
    public function aNotAuthenticatedCannotListUsers()
    {
        $response = $this->get(route('users.index'));

        $response->assertRedirect('home');
    }
}
