<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\{Comment, User, Track};

class CommentTest extends TestCase
{
    /**
     * Тест на написание комментария.
     *
     */
    public function test_can_add_new_comment()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $track = Track::factory()->create();
        $data = [
            'comment' => 'This is a test comment',
        ];
        $response = $this->post(route('NewComment', ['id' => $track->id]), $data);
        $this->assertDatabaseHas('comments', [
            'user_id' => $user->id,
            'track_id' => $track->id,
            'comment' => 'This is a test comment',
        ]);

        $response->assertRedirect();
    }

    /**
     * Тест на удаления комментария.
     *
     */
    public function test_can_delete_comment()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $comment = Comment::factory()->create([
            'user_id' => $user->id,
        ]);
        $data = [
            'comment_id' => $comment->id,
        ];
        $response = $this->post(route('DeleteComm'), $data);
        $this->assertDatabaseMissing('comments', [
            'id' => $comment->id,
        ]);

        $response->assertRedirect();
    }
}
