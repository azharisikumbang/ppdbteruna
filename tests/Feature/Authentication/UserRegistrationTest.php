<?php

namespace Tests\Feature\Authentication;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserRegistrationTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function testItCanSeeUserRegisterPage()
    {
        $this
            ->get('daftar')
            ->assertOk()
            ->assertSee('email')
            ->assertSee('password')
            ->assertSee('password_confirmation');

        $this->assertGuest();
    }

    public function testItRedirectCorrectlyWhenAlreadyAuthenticated()
    {
        $user = factory(User::class)->create([
            'email' => 'demouser@local.test',
            'password' => Hash::make('demopassword'),
            'role' => User::ROLE_SISWA
        ]);

        $this->actingAs($user);

        $response = $this->get('daftar');
        $response->assertRedirect($user->getAuthHome());

        $this->assertAuthenticatedAs($user);
    }

    public function testItCreateNewUser()
    {
        $payload = [
            'email' => 'user@local.test',
            'password' => 'password',
            'password_confirmation' => 'password'
        ];

        $response = $this->post('/daftar', $payload);

        $response->assertRedirect();

        $this->assertDatabaseCount('users', 1);
        $this->assertDatabaseHas('users', [
            'email' => $payload['email'],
            'role' => User::ROLE_SISWA
        ]);

        $this->assertGuest();
    }

    public function testItNotAuthenticatedWhenSucceed()
    {
        factory(User::class)->create([
            'email' => 'demouser@local.test',
            'password' => Hash::make('demopassword'),
            'role' => User::ROLE_SISWA
        ]);

        $payload = [
            'email' => 'demouser@local.test',
            'password' => 'demopassword',
            'password_confirmation' => 'password'
        ];

        $this->post('/daftar', $payload);

        $this->assertGuest();
    }

    public function testItNotAuthenticatedWhenFailed()
    {
        $payload = [
            'email' => 'user@local.test',
            'password' => 'password',
            'password_confirmation' => 'password'
        ];

        $this->post('/daftar', $payload);
        $this->assertGuest();
    }

    public function testItRedirectToPreviousUrlWhenFailed()
    {
        $payload = [
            'email' => 'user@local.test',
            'password' => 'password',
            'password_confirmation' => 'password'
        ];

        $response = $this->post('/daftar', $payload);

        $response->assertRedirect(session()->previousUrl());
    }

    public function testItRejectedWhenPasswordAndPasswordConfirmationDidNotMatch()
    {
        $payload = [
            'email' => 'user@local.test',
            'password' => 'password',
            'password_confirmation' => 'otherpassword'
        ];

        $response = $this->post('/daftar', $payload);
        $response->assertSessionHasErrors(['password']);

        $this->assertDatabaseCount('users', 0);
    }

    public function testItRejectedWhenEmailAlreadyExists()
    {
        // exists user
        $exist = factory(User::class)->create([
            'email' => 'demouser@local.test',
            'password' => Hash::make('demopassword'),
            'role' => User::ROLE_SISWA
        ]);

        $payload = [
            'email' => $exist['email'],
            'password' => 'password',
            'password_confirmation' => 'password'
        ];

        $response = $this->post('/daftar', $payload);
        $response->assertSessionHasErrors(['email']);

        $this->assertDatabaseCount('users', 1);
        $this->assertDatabaseHas('users', [
            'email' => $exist['email'],
            'role' => $exist['role'],
            'created_at' => $exist->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $exist->updated_at->format('Y-m-d H:i:s')
        ]);
    }

    public function testItRejectWhenPasswordLengthLessThanEightCharacters()
    {
        $payload = [
            'email' => 'user@local.test',
            'password' => '12345',
            'password_confirmation' => '12345'
        ];

        $response = $this->post('/daftar', $payload);

        $response->assertSessionHasErrors(['password']);
        $this->assertDatabaseCount('users', 0);
    }


}
