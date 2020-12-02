<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class ImportTest extends TestCase
{
    /** @test */
    public function getRoute(): string
    {
        return route('importProducts');
    }

    /** @test */
    public function testItCanImportProducts(): void
    {
        $importFile = $this->getUploadedFile('products.xlsx');

        $response = $this->get($this->getRoute(), ['importFile' => $importFile]);
        $response->assertStatus(302);;
    }

    /** @test */
    public function unauthorized_user_cannot_import_products(): void
    {
        $this->get(route('importProducts'), [
            'file' => $this->File('message'),
            'model' => 'App\Model\Product',
            'import_model' => 'App\Imports\ProductsImport',
        ])
            ->assertRedirect(route('home'));
    }

    private function getUploadedFile(string $fileName): UploadedFile
    {
        $filePath = base_path('tests/stubs/' . $fileName);
        return new UploadedFile($filePath, 'products.xlsx', null, null, true);
    }

    public function file(): void
    {
            file_get_contents(
                base_path('tests/Stubs/Products.xlsx')
            );
        
    }
}

