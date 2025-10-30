<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_create_post()
    {
        $user = User::factory()->create();
        $this->actingAs($user)->post(route('posts.store'), [
            'title'=>'Test Post',
            'content'=>'Content here'
        ])->assertRedirect();
        $this->assertDatabaseHas('posts', ['title'=>'Test Post']);
    }
}
