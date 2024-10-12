<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Models\Track;

class TrackTest extends TestCase
{
    /**
     * Тест на успешное создание нового трека.
     *
     */
    public function test_new_music_success()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        Storage::fake('public');
        $trackFile = UploadedFile::fake()->create('track.mp3', 1024, 'audio/mpeg');
        $coverFile = UploadedFile::fake()->image('cover.jpg');
        $response = $this->post(route('NewMusic'), [
            'track' => $trackFile,
            'track_name' => 'Test Track',
            'genre_track' => 'Rock',
            'cover' => $coverFile,
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('tracks', [
            'name' => 'Test Track',
            'genre' => 'Rock',
            'user_id' => $user->id,
        ]);
    }

    /**
     * Тест на ошибку валидацию поля track при создании трека.
     *
     */
    public function test_new_music_track_validation_error()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post(route('NewMusic'), [
            'track' => UploadedFile::fake()->create('track.txt', 1024, 'text/plain'),
            'track_name' => 'Test Track',
            'genre_track' => 'Rock',
            'cover' => UploadedFile::fake()->image('cover.jpg'),
        ]);

        $response->assertSessionHasErrors('track');
    }

    /**
     * Тест на ошибку валидацию поля track_name при создании трека.
     *
     */
    public function test_new_music_track_name_validation_error()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post(route('NewMusic'), [
            'track' => UploadedFile::fake()->create('track.mp3', 1024, 'audio/mpeg'),
            'track_name' => '',
            'genre_track' => 'Rock',
            'cover' => UploadedFile::fake()->image('cover.jpg'),
        ]);

        $response->assertSessionHasErrors('track_name');
    }

    /**
     * Тест на ошибку валидацию поля genre_track при создании трека.
     *
     */
    public function test_new_music_genre_track_validation_error()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post(route('NewMusic'), [
            'track' => UploadedFile::fake()->create('track.mp3', 1024, 'audio/mpeg'),
            'track_name' => 'Test Track',
            'genre_track' => '',
            'cover' => UploadedFile::fake()->image('cover.jpg'),
        ]);

        $response->assertSessionHasErrors('genre_track');
    }

    /**
     * Тест на ошибку валидацию поля cover при создании трека.
     *
     */
    public function test_new_music_cover_validation_error()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post(route('NewMusic'), [
            'track' => UploadedFile::fake()->create('track.mp3', 1024, 'audio/mpeg'),
            'track_name' => 'Test Track',
            'genre_track' => 'Rock',
            'cover' => UploadedFile::fake()->create('cover.txt', 1024, 'text/plain'),
        ]);

        $response->assertSessionHasErrors('cover');
    }

    /**
     * Тест на успешное удаление трека.
     *
     */
    public function test_successful_tyrack_deletion()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $track = Track::factory()->create(['user_id' => $user->id]);
        $response = $this->delete(route('deleteTrack'), ['track_id' => $track->id]);
        $this->assertDatabaseMissing('tracks', ['id' => $track->id]);

        $response->assertRedirect(route('index'));
    }

    /**
     * Тест на ошибку валидацию поля track_id при удалении трека.
     *
     */
    public function test_failed_track_deletion_with_invalid_data()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->delete(route('deleteTrack'), ['track_id' => 'invalid_id']);

        $response->assertSessionHasErrors('track_id');
    }
}
