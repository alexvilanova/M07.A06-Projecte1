<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CommentTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_post_create() : int
    {
        $name  = "avatar.png";
        $size = 500;
        $upload = UploadedFile::fake()->image($name)->size($size);
        
        // Create additional required data
        $title = 'Test Title';
        $description = 'Test Description';
        $visibility_id = 1;
    
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . self::$token,
        ])->postJson("/api/posts", [
            "title" => $title,
            "description" => $description,
            "upload" => $upload,
            "visibility_id" => $visibility_id,
        ]);
    
        $this->_test_ok($response, 201);
    
        $response->assertValid(["title", "description", "upload", "visibility_id"]);
        $response->assertJsonPath("data.title", $title);
        $response->assertJsonPath("data.description", $description);
        $response->assertJsonPath("data.visibility_id", $visibility_id);
    
        $json = $response->getData();
        return $json->data->id;
    }
    /**
    * @depends test_post_create
    */
    public function test_comment_create(int $postid)
    {
        
    }
}
