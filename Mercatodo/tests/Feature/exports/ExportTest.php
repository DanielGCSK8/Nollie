<?php

namespace Tests\Feature\exports;

use Illuminate\Foundation\Testing\WithFaker;
use Maatwebsite\Excel\Facades\Excel;
use Tests\TestCase;

class ExportTest extends TestCase
{
    /** @test */
    public function unauthorized_user_cannot_export_products(): void
    {
        Excel::fake();

        $this->get(route('exportProducts', ['extension' => 'xlsx']))
            ->assertRedirect(route('home'));
    }

}
