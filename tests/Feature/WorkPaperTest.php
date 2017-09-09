<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WorkPaperTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     */
    /** @test */
    public function it_can_add_new_working_paper()
    {
        $workingPaper = factory('App\WorkPaper')->make();
        $response = $this->post('/api/working-paper', $workingPaper->toArray());
        $response->assertStatus(200);
        $response->assertSee('Record Succesfully Added');
    }
    /** @test */
    public function it_can_validate_valid_folder()
    {
        $workingPaper = factory('App\WorkPaper', ['folder_id' => 100])->make();
        $response = $this->post('/api/working-paper', $workingPaper->toArray());
        $response->assertStatus(400);
        $response->assertSee('errors');
    }
    /** @test */
    public function it_can_update_record()
    {
        $workingPaper = factory('App\WorkPaper')->create();
        $toBeEdit = factory('App\WorkPaper')->make();
        $response = $this->put('/api/working-paper/'.$workingPaper->id, $toBeEdit->toArray());
        $response->assertStatus(200);
        $response->assertSee('Record Succesfully Updated');
    }

    /** @test */
    public function it_can_validate_in_update_record()
    {
        $workingPaper = factory('App\WorkPaper')->create();
        $response = $this->put('/api/working-paper/'.$workingPaper->id, []);
        $response->assertStatus(400);
        $response->assertSee('errors');
    }
    /** @test */
    public function it_can_delete_working_paper_record()
    {
        $workingPaper = factory('App\WorkPaper')->create();
        $response = $this->delete('/api/working-paper/'.$workingPaper->id);
        $response->assertStatus(200);
        $response->assertSee('Record Succesfully Deleted');
    }
}
