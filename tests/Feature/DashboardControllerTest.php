<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_unauthenticated_request_redirects_to_login(): void
    {
        $response = $this->get('/dashboard');

        $response->assertRedirectToRoute('login');
    }

    public function test_authenticated_user_can_view_dashboard_data(): void
    {
        $user = User::factory()->create(['name' => 'John Doe', 'role' => 'admin']);

        $response = $this->actingAs($user)->get('/dashboard');

        $response->assertOk();
        $response->assertSee('Welcome back, John Doe');
        $response->assertSee($user->email);
        $response->assertSee('Total Users');
        $response->assertSee('Transaction Overview');
        $response->assertSee('Recent Activity');
        $response->assertSee('admin');
    }

    public function test_authenticated_user_can_logout_from_dashboard_flow(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post('/logout');

        $response->assertRedirect('/');
        $this->assertGuest();
    }
}
