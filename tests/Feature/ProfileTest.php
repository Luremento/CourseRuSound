<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Тест на открытие страницы профиля.
     *
     */
    public function test_profile_page_is_displayed(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get('/profile');

        $response->assertOk();
    }

    /**
     * Тест на успешное обновление информации.
     *
     */
    public function test_profile_information_can_be_updated(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->patch(route('profile.update'), [
                'name' => 'Test User',
                'email' => 'test@example.com',
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('profile.edit'));

        $user->refresh();

        $this->assertSame('Test User', $user->name);
        $this->assertSame('test@example.com', $user->email);
    }

    /**
     * Тест на успешное изменение аватара.
     *
     */
    public function test_successful_avatar_update()
    {
        $user = User::factory()->create(['photo' => 'storage/avatars/old_avatar.jpg']);
        $this->actingAs($user);


        Storage::fake('public');
        $avatarFile = UploadedFile::fake()->image('avatar.jpg');
        $timestamp = time();
        $response = $this->post(route('profile.update-photo'), [
            'avatar_change' => $avatarFile,
        ]);
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'photo' => 'storage/avatars/' . $timestamp . '.jpg',
        ]);
        Storage::disk('public')->assertExists('avatars/' . $timestamp . '.jpg');
        $response->assertRedirect();
    }

    /**
     * Тест на ошибку валидацию при изменении аватара.
     *
     */
    public function test_failed_avatar_update_with_invalid_data()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post(route('profile.update-photo'), [
            'avatar_change' => 'invalid_file',
        ]);

        $response->assertSessionHasErrors('avatar_change');
    }

}
