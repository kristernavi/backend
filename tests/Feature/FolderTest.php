<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Folder;
use App\Http\Resources\Folder as FolderResource;

class FolderTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     */
    /** @test */
    public function it_can_view_all_folder()
    {
        $folder = factory('App\Folder', 10)->create();
        $json = json_encode(Folder::all());
        $response = $this->get('/api/folder');
        $response->assertStatus(200);
        $response->assertSee($json);
    }

    /** @test */
    public function it_can_add_new_folder()
    {
        $folder = factory('App\Folder')->make();
        $response = $this->post('/api/folder', $folder->toArray());
        $response->assertStatus(200);
        $response->assertSee('Record Succesfully Added');
    }
    /** @test */
    public function it_can_validate_empty_value_when_adding_new_folder()
    {
        $folder = factory('App\Folder', ['name' => null])->make();
        $response = $this->post('/api/folder', $folder->toArray());
        $response->assertStatus(400);
        $response->assertSee('errors');
    }
    /** @test */
    public function it_can_update_a_folder()
    {
        $folder = factory('App\Folder')->create();
        $toBeEdit = factory('App\Folder')->make();
        $response = $this->put('/api/folder/'.$folder->id, $toBeEdit->toArray());
        $response->assertStatus(200);
        $response->assertSee('Record Succesfully Updated');
    }

    /** @test */
    public function it_can_validate_empty_value_when_adding_update_folder()
    {
        $folder = factory('App\Folder')->create();
        $response = $this->put('/api/folder/'.$folder->id, []);
        $response->assertStatus(400);
        $response->assertSee('errors');
    }

    /** @test */
    public function it_can_delete_folder()
    {
        $folder = factory('App\Folder')->create();
        $response = $this->delete('/api/folder/'.$folder->id);
        $response->assertStatus(200);
        $response->assertSee('Record Succesfully Deleted');
    }
    public function it_can_check_delete_to_not_found_folder()
    {
        $response = $this->delete('/api/folder/100');
        $response->assertStatus(400);
        $response->assertSee('Folder not found');
    }
    public function it_can_view_all_working_paper_under_this_folder()
    {
        $folder = factory('App\Folder')->create();
        factory('App\WorkPaper', 10, ['folder_id' => $folder->id])->create();
        $response = $this->get('/api/folder/'.$folder->id. '/working-papers');
        $response->assertStatus(200);
    }
}
