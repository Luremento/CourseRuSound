<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\{User, Track, Like};

class LikeTest extends TestCase
{
    /**
     * Тест на открытие успешное добавление трека в избранное.
     *
     */
    public function test_user_can_add_like()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $track = Track::factory()->create();
        $response = $this->post(route('like.add'), [
            'track_id' => $track->id,
        ]);
        $this->assertDatabaseHas('likes', [
            'user_id' => $user->id,
            'track_id' => $track->id,
        ]);

        $response->assertRedirect();
    }

    /**
     * Тест на успешное удаления из избранного.
     *
     */
    public function test_user_can_remove_like()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $track = Track::factory()->create();
        $like = Like::factory()->create([
            'user_id' => $user->id,
            'track_id' => $track->id,
        ]);
        $response = $this->post(route('like.add'), [
            'track_id' => $track->id,
        ]);
        $this->assertDatabaseMissing('likes', [
            'user_id' => $user->id,
            'track_id' => $track->id,
        ]);

        $response->assertRedirect();
    }
}
