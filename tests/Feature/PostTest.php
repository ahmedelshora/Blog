<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use App\Models\Comment;

class PostTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test successfully loading the posts list.
     */
    public function test_can_load_posts_list_successfully(): void
    {
        // Arrange: Create some posts in the database
        Post::factory()->count(5)->create();

        // Act: Make a GET request to the posts endpoint
        $response = $this->getJson('/api/posts');

        // Assert: Check that the response is successful and contains the posts
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'message',
                     'data' => [
                         '*' => [
                             'id',
                             'title',
                             'content',
                             'created_at',
                             'updated_at',
                         ],
                     ],
                     'meta' => [
                         'current_page',
                         'last_page',
                         'per_page',
                         'total',
                     ],
                 ]);
    }


    /**
     * Test creating a post as an authenticated user.
     */
    public function test_authenticated_user_can_create_post(): void
    {
        // Arrange: Create a user and authenticate with Sanctum
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');
        // Create a category for the post
        $category = Category::factory()->create();
        // Arrange: Define the post data
        $postData = [
            'category_id' => $category->id,
            'title' => 'Test Post Title',
            'content' => 'This is the content of the test post.',
        ];

        // Act: Make a POST request to the posts endpoint
        $response = $this->postJson('/api/posts', $postData);
        // Assert: Check that the response is successful
        $response->assertStatus(201);
    }

    /**
     * Test failing to create a post when unauthenticated.
     */
    public function test_failing_to_create_post_when_unauthenticated(): void
    {
        // Arrange: Create a category for the post
        $category = Category::factory()->create();

        // Arrange: Define the post data
        $postData = [
            'category_id' => $category->id,
            'title' => 'Test Post Title',
            'content' => 'This is the content of the test post.',
        ];

        // Act: Make a POST request to the posts endpoint without authentication
        $response = $this->postJson('/api/posts', $postData);

        // Assert: Check that the response returns a 401 Unauthorized status
        $response->assertStatus(401)
                 ->assertJson([
                     'message' => 'Unauthenticated.',
                 ]);
    }

    /**
     * Test creating a comment as an authenticated user.
     */
    public function test_authenticated_user_can_create_comment(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        $post = Post::factory()->create();

        $commentData = [
            'content' => 'This is a test comment.',
            'post_id' => $post->id,
        ];

        $response = $this->postJson("/api/posts/$post->id/comments", $commentData);

        $response->assertStatus(201)
                 ->assertJson([
                     'message' => 'Comment created successfully.',
                 ]);
    }


    /**
     * Test viewing a post with all its comments.
     */
    public function test_can_view_post_with_all_comments(): void
    {
        // Arrange: Create a user, a post, and some comments
        $user = User::factory()->create();
        $post = Post::factory()->create(['user_id' => $user->id]);
        $comments = Comment::factory()->count(3)->create(['post_id' => $post->id]);

        // Act: Make a GET request to the post endpoint
        $response = $this->getJson("/api/posts/{$post->id}");

        // Assert: Check that the response is successful and contains the post with its comments
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'message',
                     'data' => [
                         'id',
                         'title',
                         'content',
                         'comments' => [
                             '*' => [
                                 'id',
                                 'content',
                                 'user_id',
                                 'post_id',
                                 'created_at',
                                 'updated_at',
                             ],
                         ],
                     ],
                 ]);
    }

    
}
