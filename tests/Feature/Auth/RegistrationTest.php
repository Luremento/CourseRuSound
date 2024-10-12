<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Тест на успешное открытие страницы регистрации.
     *
     */
    public function test_registration_screen_can_be_rendered(): void
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    /**
     * Тест на успешную регистрацию пользователя.
     *
     */
    public function test_new_users_can_register(): void
    {
        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(route('profile', absolute: false));
    }

    /**
     * Тест на ошибку валидации почты при регистрации.
     *
     */
    public function test_new_users_cannot_register_with_invalid_email(): void
    {
        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'invalid-email',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $this->assertGuest();
        $response->assertSessionHasErrors('email');
        $response->assertSessionMissing('success');
    }

    /**
     * Тест на ошибку неправильного подтверждения пароля при регистрации пользователя.
     *
     */
    public function test_new_users_cannot_register_with_mismatched_passwords(): void
    {
        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'different_password',
        ]);
        $this->assertGuest();
        $response->assertSessionHasErrors('password');
        $response->assertSessionMissing('success');
    }
}
