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
    private static $token = "3|TcAHUxaiEGd2t6SEHXDsora1KEdtrWX52GHzlpZt10b80c38";
    public static $postId = "1";

    public function test_comments_list()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . self::$token,
            ])->getJson("/api/posts/" . self::$postId . "/comments");
                $this->_test_ok($response);
    }

    public function test_comment_create() : int
    {
        $comment = "Comentario de prueba";

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . self::$token,
            ])->postJson("/api/posts/" . self::$postId . "/comments", [
                "comment" => $comment,
        ]);
        $this->_test_ok($response, 201);
        $response->assertJsonPath("data.comment", $comment);

        // DEVOLVER ID COMMENT
        $json = $response->getData();
        return $json->data->id;

    }
    public function test_comment_create_post_notfound()
    {
        $comment = "Comentario de prueba";
        $post = "99999";
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . self::$token,
            ])->postJson("/api/posts/" . $post . "/comments", [
                "comment" => $comment,
        ]);
        $this->_test_notfound($response);

    }
    public function test_comment_create_unauthorized()
    {
        $comment = "Comentario de prueba";

        $response = $this->postJson("/api/posts/" . self::$postId . "/comments", [
            "comment" => $comment,
        ]);
        $response->assertStatus(401); 
    }
    public function test_comment_create_noitems()
    {
        $comment = "";

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . self::$token,
            ])->postJson("/api/posts/" . self::$postId . "/comments", [
                "comment" => $comment,
        ]);
        $this->_test_error($response);
    }

   /**
    * @depends test_comment_create
    */
    public function test_comment_delete(int $commentId)
    {

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . self::$token,
            ])->deleteJson("/api/posts/" . self::$postId . "/comments" . "/" . $commentId);
            $this->_test_ok($response, 200);
    }
    public function test_comment_delete_notfound()
    {
        $commentId = "99999";
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . self::$token,
            ])->deleteJson("/api/posts/" . self::$postId . "/comments" . "/" . $commentId);
            $this->_test_notfound($response);
    }
   /**
    * @depends test_comment_create
    */
    public function test_comment_delete_unauthorized(int $commentId)
    {
        $response = $this->deleteJson("/api/posts/" . self::$postId . "/comments" . "/" . $commentId);
        $response->assertStatus(401); 
    }

    protected function _test_ok($response, $status = 200)
    {
        // Check JSON response
        $response->assertStatus($status);
        // Check JSON properties
        $response->assertJson([
            "success" => true,
        ]);
        // Check JSON dynamic values
        $response->assertJsonPath("data",
            fn ($data) => is_array($data)
        );
    }
    protected function _test_error($response)
   {
       // Check response
       $response->assertStatus(422);
       // Check validation errors
       $response->assertInvalid(["comment"]);
       // Check JSON properties
       $response->assertJson([
           "message" => true, // any value
           "errors"  => true, // any value
       ]);       
       // Check JSON dynamic values
       $response->assertJsonPath("message",
           fn ($message) => !empty($message) && is_string($message)
       );
       $response->assertJsonPath("errors",
           fn ($errors) => is_array($errors)
       );
   }

   protected function _test_notfound($response)
   {
       // Check JSON response
       $response->assertStatus(404);
       // Check JSON properties
       $response->assertJson([
           "success" => false,
           "message" => true // any value
       ]);
       // Check JSON dynamic values
       $response->assertJsonPath("message",
           fn ($message) => !empty($message) && is_string($message)
       );       
   }

}
