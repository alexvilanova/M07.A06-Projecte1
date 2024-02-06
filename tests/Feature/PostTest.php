<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;

class PostTest extends TestCase
{

    private static $token = '3|TcAHUxaiEGd2t6SEHXDsora1KEdtrWX52GHzlpZt10b80c38';

    public function test_post_list()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . self::$token,
        ])->getJson("/api/posts");
        $this->_test_ok($response);
    }

    public function test_post_create() : int
    {
        // Create fake file
        $name  = "avatar.png";
        $size = 500; // Size in KB
        $upload = UploadedFile::fake()->image($name)->size($size);
        
        // Create additional required data
        $title = 'Test Title';
        $description = 'Test Description';
        $visibility_id = 1;
    
        // Upload fake file using API web service
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . self::$token,
        ])->postJson("/api/posts", [
            "title" => $title,
            "description" => $description,
            "upload" => $upload,
            "visibility_id" => $visibility_id,
        ]);
    
        // Check OK response
        $this->_test_ok($response, 201);
    
        // Check validation errors
        $response->assertValid(["title", "description", "upload", "visibility_id"]);
    
        // $response->assertJsonPath("data.file.filesize", $size*1024);
        // $response->assertJsonPath("data.file.filepath",
        //     fn ($filepath) => str_contains($filepath, $name)
        // );
    
        // $response->assertJsonPath("data.file.id",
        //     fn ($id) => !empty($id)
        // );
    
        // Check post data
        $response->assertJsonPath("data.title", $title);
        $response->assertJsonPath("data.description", $description);
        $response->assertJsonPath("data.visibility_id", $visibility_id);
    
        // Read, update and delete dependency!!!
        $json = $response->getData();
        return $json->data->id;
    }

    public function test_post_create_unauthorized()
    {
        $token = ""; 
    
        // Create invalid or incomplete data
        $title = 'Title'; // 
        $description = 'Test Description';
        $visibility_id = 1;
        $size = 500; // Size in KB

        $upload = UploadedFile::fake()->image("")->size($size);
    
        // Attempt to upload with invalid data
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->postJson("/api/posts", [
            "title" => $title,
            "description" => $description,
            "upload" => $upload,
            "visibility_id" => $visibility_id,
        ]);
    
        $response->assertStatus(401); 
    
        }
        public function test_post_create_noitems()
        {
        
            // Create invalid or incomplete data
            $title = ''; // 
            $description = 'Test Description';
            $visibility_id = 1;
            $size = 500; // Size in KB
    
            $upload = UploadedFile::fake()->image("")->size($size);
        
            // Attempt to upload with invalid data
            $response = $this->withHeaders([
                'Authorization' => 'Bearer ' . self::$token,
            ])->postJson("/api/posts", [
                "title" => $title,
                "description" => $description,
                "upload" => $upload,
                "visibility_id" => $visibility_id,
            ]);
        
            $response->assertStatus(422); 

            $response->assertJson([
                'message' => true,
                'errors' => [
                    'title' => true,
                    'upload' => true
                ]
            ]);
        
        }
        
   /**
    * @depends test_post_create
    */
    public function test_post_show(int $postid)
    {
        // Read one file
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . self::$token,
        ])->getJson("/api/posts/{$postid}");
        // Check OK response
        $this->_test_ok($response);
        // Check JSON exact values
        $response->assertJsonPath("data.title",
            fn ($title) => !empty($title)
        );
    }

       /**
    * @depends test_post_create
    */
    public function test_post_show_notfound(int $postid)
    {
        $id = "9999999999";
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . self::$token,
        ])->getJson("/api/posts/{$id}");
        $this->_test_notfound($response);
     }

        /**
    * @depends test_post_create
    */
   public function test_post_update(int $postid)
   {
    // Crear un nuevo archivo falso para la actualización
    $newFileName = "updated_photo.jpg";
    $newFileSize = 1000; // Tamaño en KB
    $updatedFile = UploadedFile::fake()->image($newFileName)->size($newFileSize);

    // Datos nuevos para actualizar el post
    $updatedTitle = 'Updated Title';
    $updatedDescription = 'Updated Description';
    $updatedVisibilityId = 2;

    // Token para autorización (asumiendo que ya lo tienes)

    // Realizar la solicitud PUT para actualizar el post
    $response = $this->withHeaders([
        'Authorization' => 'Bearer ' . self::$token,
    ])->putJson("/api/posts/{$postid}", [
        'upload' => $updatedFile,
        'title' => $updatedTitle,
        'description' => $updatedDescription,
        'visibility_id' => $updatedVisibilityId,
    ]);

    // Verificar la respuesta y la actualización
    $this->_test_ok($response);
    $response->assertValid(['upload', 'title', 'description', 'visibility_id']);
    $response->assertJsonPath('data.title', $updatedTitle);
    $response->assertJsonPath('data.description', $updatedDescription);
    $response->assertJsonPath('data.visibility_id', $updatedVisibilityId);
   }

    /**
    * @depends test_post_create
    */
   public function test_post_update_error(int $postid)
   {
       // Create fake file with invalid max size
       $name  = "photo.jpg";
       $size = 3000; /*KB*/
       $upload = UploadedFile::fake()->image($name)->size($size);
       // Upload fake file using API web service
       $response = $this->withHeaders([
        'Authorization' => 'Bearer ' . self::$token,
    ])->putJson("/api/posts/{$postid}", [
           "upload" => $upload,
       ]);
       // Check ERROR response
       $this->_test_error($response);
   }

   public function test_post_update_notfound()
   {
       $id = "not_exists";
       $response = $this->withHeaders([
        'Authorization' => 'Bearer ' . self::$token,
    ])->putJson("/api/posts/{$id}", []);
       $this->_test_notfound($response);
   }

    /**
    * @depends test_post_create
    */
    public function test_post_like(int $postid)
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . self::$token,
        ])->postJson("/api/posts/{$postid}/likes");
        // Check OK response
        $this->_test_ok($response, 201);
    }

    public function test_post_like_notfound()
    {
        $id = "not found";
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . self::$token,
        ])->postJson("/api/posts/{$id}/likes");
        // Check OK response
        $this->_test_notfound($response);
    }


   /**
    * @depends test_post_create
    */
    public function test_post_unlike(int $postid)
    {
        // Delete one file using API web service
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . self::$token,
        ])->deleteJson("/api/posts/{$postid}/likes");
        // Check OK response
        $this->_test_ok($response);
    }

    public function test_post_unlike_notfound()
    {
        $id = "not found";
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . self::$token,
        ])->deleteJson("/api/posts/{$id}/likes");
        // Check OK response
        $this->_test_notfound($response);
    }

   /**
    * @depends test_post_create
    */
    public function test_post_delete(int $postid)
    {
        // Delete one file using API web service
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . self::$token,
        ])->deleteJson("/api/posts/{$postid}");
        // Check OK response
        $this->_test_ok($response);
    }

    public function test_post_delete_notfound()
    {
        $id = "not_exists";
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . self::$token,
        ])->deleteJson("/api/posts/{$id}");
        $this->_test_notfound($response);
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
       $response->assertInvalid(["upload"]);
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
