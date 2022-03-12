<?php

namespace Tests\Feature;

use App\Models\Company;
use App\Models\House;
use App\Models\Office;
use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Tests\TestCase;

class FileUploadTest extends TestCase
{
    use RefreshDatabase;

    public function test_original_filename_upload()
    {
        $filename = 'logo.jpg';

        $response = $this->post('projects', [
            'name' => 'Some name',
            'logo' => UploadedFile::fake()->image($filename)
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('projects', [
            'name' => 'Some name',
            'logo' => $filename
        ]);
    }

    public function test_file_size_validation()
    {
        $response = $this->post('projects', [
            'name' => 'Some name',
            'logo' => UploadedFile::fake()->create('logo.jpg', 2000)
        ]);
        $response->assertInvalid();

        $response = $this->post('projects', [
            'name' => 'Some name',
            'logo' => UploadedFile::fake()->create('logo.jpg', 500)
        ]);
        $response->assertValid();
    }

    public function test_update_file_remove_old_one()
    {
        $response = $this->post('houses', [
            'name' => 'Some name',
            'photo' => UploadedFile::fake()->image('photo.jpg')
        ]);
        $response->assertStatus(200);
        $house = House::first();
        $this->assertTrue(Storage::exists($house->photo));

        $response = $this->put('houses/' . $house->id, [
            'name' => 'Some name',
            'photo' => UploadedFile::fake()->image('photo2.jpg')
        ]);
        $response->assertStatus(200);
        $this->assertFalse(Storage::exists($house->photo));
    }

    public function test_download_uploaded_file()
    {
        $this->post('houses', [
            'name' => 'Some name',
            'photo' => UploadedFile::fake()->image('photo.jpg')
        ]);
        $house = House::first();

        $response = $this->get('houses/download/' . $house->id);
        $response->assertStatus(200);
        $response->assertDownload(str_replace('houses/', '', $house->photo));
    }

    public function test_public_file_show()
    {
        $filename = Str::random(8) . '.jpg';

        $this->post('offices', [
            'name' => 'Some name',
            'photo' => UploadedFile::fake()->image($filename)
        ]);
        $office = Office::first();

        $this->assertTrue(Storage::disk('public')->exists('offices/' . $filename));

        $response = $this->get('offices/' . $office->id);
        $response->assertStatus(200);
        $response->assertSee(public_path('offices/' . $filename));
    }

    public function test_upload_resize()
    {
        $filename = Str::random(8) . '.jpg';

        $response = $this->post('shops', [
            'name' => 'Some name',
            'photo' => UploadedFile::fake()->image($filename, 1000, 1000)
        ]);
        $response->assertStatus(200);

        $image = Image::make(storage_path('app/shops/resized-' . $filename));
        $this->assertEquals(500, $image->width());
        $this->assertEquals(500, $image->height());
    }

    public function test_spatie_media_library()
    {
        $filename = Str::random(8) . '.jpg';

        $response = $this->post('companies', [
            'name' => 'Some name',
            'photo' => UploadedFile::fake()->image($filename)
        ]);
        $response->assertStatus(200);

        $company = Company::first();
        $response = $this->get('companies/' . $company->id);
        $response->assertStatus(200);
        $response->assertSee('storage/' . $company->id . '/' . $filename);
    }
}
