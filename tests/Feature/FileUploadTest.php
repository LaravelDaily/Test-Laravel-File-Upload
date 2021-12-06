<?php

namespace Tests\Feature;

use App\Models\House;
use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
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
}
