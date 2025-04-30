<?php

namespace Tests\Feature\Authentication;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function testItCanSeeLoginPage()
    {
        $this->assertGuest();
        $this->get('masuk')->assertOk();
    }

    public function testItRedirectCorrectlyWhenAlreadyAuthenticated()
    {
        $user = factory(User::class)->create([
            'email' => 'demouser@local.test',
            'password' => Hash::make('demopassword'),
            'role' => User::ROLE_SISWA
        ]);

        $this->actingAs($user);

        $response = $this->get('/masuk');
        $response->assertRedirect($user->getAuthHome());

        $this->assertAuthenticatedAs($user);
    }

    public function testItAuthenticateTheCorrectUser()
    {
        $this->withoutExceptionHandling();
        $this->assertGuest();

        factory(User::class)->create([
            'email' => 'demouser@local.test',
            'password' => Hash::make('demopassword'),
            'role' => User::ROLE_SISWA
        ]);

        $payload = [
            'email' => 'demouser@local.test',
            'password' => 'demopassword'
        ];

        $this->post('masuk', $payload);

        $authenticatedUser = User::where('email', 'demouser@local.test')->first();
        $this->assertAuthenticatedAs($authenticatedUser);
    }

    public function testItRedirectCorrectLoginCredentialsToCorrectPage()
    {
        $this->withoutExceptionHandling();
        $this->assertGuest();

        factory(User::class)->createMany([
            [
                'email' => 'demouser@local.test',
                'password' => Hash::make('demopassword'),
                'role' => User::ROLE_SISWA
            ],
            [
                'email' => 'demoadmin@local.test',
                'password' => Hash::make('demopassword'),
                'role' => User::ROLE_ADMIN
            ],
            [
                'email' => 'demosuperadmin@local.test',
                'password' => Hash::make('demopassword'),
                'role' => User::ROLE_SUPER_ADMIN
            ]
        ]);

        // siswa
        $payload = [
            'email' => 'demouser@local.test',
            'password' => 'demopassword'
        ];
        $response = $this->post('masuk', $payload);

        $user = User::where('email', 'demouser@local.test')->first();

        $response->assertRedirect('/siswa');
        auth()->logout();
        $this->assertGuest();

        // admin
        $payload = [
            'email' => 'demoadmin@local.test',
            'password' => 'demopassword'
        ];
        $response = $this->post('masuk', $payload);

        $user = User::where('email', 'demoadmin@local.test')->first();
        $response->assertRedirect('/admin');

        auth()->logout();
        $this->assertGuest();

        // super-admin
        $payload = [
            'email' => 'demosuperadmin@local.test',
            'password' => 'demopassword'
        ];
        $response = $this->post('masuk', $payload);

        $user = User::where('email', 'demoadmin@local.test')->first();
        $response->assertRedirect('/super-admin');

        auth()->logout();
        $this->assertGuest();
    }

    public function testItRejectAuthenticationForUnregisteredEmail()
    {
        $this->withoutExceptionHandling();
        $this->assertGuest();

        $payload = [
            'email' => 'nouser@local.test',
            'password' => 'nouser'
        ];

        $this->post('masuk', $payload);

        $this->assertGuest();
    }

    public function testItRejectAuthenticationForInvalidPassword()
    {
        $this->withoutExceptionHandling();
        $this->assertGuest();

        factory(User::class)->create([
            'email' => 'demouser@local.test',
            'password' => Hash::make('demopassword'),
            'role' => User::ROLE_SISWA
        ]);

        $payload = [
            'email' => 'demouser@local.test',
            'password' => 'wrongpassword'
        ];

        $this->post('masuk', $payload);

        $this->assertGuest();
    }

    public function testItRedirectBackBadLoginCredentialsWithErrorMessages()
    {
        $this->assertGuest();

        factory(User::class)->create([
            'email' => 'demouser@local.test',
            'password' => Hash::make('demopassword'),
            'role' => User::ROLE_SISWA
        ]);

        $payload = [
            'email' => 'demouser@local.test',
            'password' => 'wrodngpassword'
        ];

        $response = $this->post('masuk', $payload);

        $response->assertRedirect();
        $response->assertSessionHasInput('email', $payload['email']);
        $response->assertSessionHasErrors(['invalid_credentials' => 'email atau password salah, silahkan coba lagi!']);
    }

    public function testItFlushSessionOnLogout()
    {
        $user = factory(User::class)->create([
            'email' => 'demouser@local.test',
            'password' => Hash::make('demopassword'),
            'role' => User::ROLE_SISWA
        ]);

        $this->actingAs($user);

        $response = $this->get('/keluar');
        $response->assertRedirect();

        $this->assertGuest();
    }
}
