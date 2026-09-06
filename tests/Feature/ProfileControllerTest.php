<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ProfileControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_is_redirected_to_login(): void
    {
        $response = $this->get(route('profile.edit'));

        $response->assertRedirectToRoute('login');
    }

    public function test_user_can_view_profile_form(): void
    {
        $user = User::factory()->create(['name' => 'John Doe', 'email' => 'john@example.com']);

        $response = $this->actingAs($user)->get(route('profile.edit'));

        $response->assertOk();
        $response->assertSee('Photo Profil');
        $response->assertSee('Informasi Akun');
        $response->assertSee($user->name, false);
        $response->assertSee($user->email, false);
    }

    public function test_user_can_update_name_and_email(): void
    {
        $user = User::factory()->create(['name' => 'John Doe', 'email' => 'john@example.com']);

        $response = $this->actingAs($user)->put(route('profile.update'), [
            'name' => 'Jane Smith',
            'email' => 'jane@example.com',
        ]);

        $response->assertRedirectToRoute('profile.edit');
        $response->assertSessionHas('success');

        $user->refresh();
        $this->assertSame('Jane Smith', $user->name);
        $this->assertSame('jane@example.com', $user->email);
    }

    public function test_user_can_update_password(): void
    {
        $user = User::factory()->create(['password' => 'old-password']);

        $response = $this->actingAs($user)->put(route('profile.update'), [
            'name' => $user->name,
            'email' => $user->email,
            'password' => 'new-sandibaru',
            'password_confirmation' => 'new-sandibaru',
        ]);

        $response->assertRedirectToRoute('profile.edit');

        $this->assertTrue(Hash::check('new-sandibaru', $user->fresh()->password));
    }

    public function test_password_update_requires_confirmation(): void
    {
        $user = User::factory()->create(['password' => 'old-password']);

        $response = $this->actingAs($user)->put(route('profile.update'), [
            'name' => $user->name,
            'email' => $user->email,
            'password' => 'new-sandibaru',
            'password_confirmation' => 'different',
        ]);

        $response->assertSessionHasErrors('password');
        $this->assertTrue(Hash::check('old-password', $user->fresh()->password));
    }

    public function test_email_must_be_unique(): void
    {
        $user = User::factory()->create(['email' => 'john@example.com']);
        User::factory()->create(['email' => 'taken@example.com']);

        $response = $this->actingAs($user)->put(route('profile.update'), [
            'name' => $user->name,
            'email' => 'taken@example.com',
        ]);

        $response->assertSessionHasErrors('email');
        $this->assertSame('john@example.com', $user->fresh()->email);
    }

    public function test_user_can_upload_replace_and_remove_avatar_file(): void
    {
        Storage::fake('public');
        $user = User::factory()->create();

        $this->actingAs($user)->put(route('profile.update'), [
            'name' => $user->name,
            'email' => $user->email,
            'avatar' => UploadedFile::fake()->create('first-avatar.jpg', 100, 'image/jpeg'),
        ]);

        $oldAvatar = $user->fresh()->avatar;
        Storage::disk('public')->assertExists($oldAvatar);
        $this->assertSame('/storage/'.$oldAvatar, $user->fresh()->avatar_url);

        $this->actingAs($user)->put(route('profile.update'), [
            'name' => $user->name,
            'email' => $user->email,
            'avatar' => UploadedFile::fake()->create('replacement-avatar.png', 100, 'image/png'),
        ]);

        $newAvatar = $user->refresh()->avatar;
        $this->assertNotSame($oldAvatar, $newAvatar);
        Storage::disk('public')->assertMissing($oldAvatar);
        Storage::disk('public')->assertExists($newAvatar);
    }

    public function test_invalid_avatar_is_rejected(): void
    {
        Storage::fake('public');
        $user = User::factory()->create();

        $response = $this->actingAs($user)->put(route('profile.update'), [
            'name' => $user->name,
            'email' => $user->email,
            'avatar' => UploadedFile::fake()->create('photo.gif', 100, 'image/gif'),
        ]);

        $response->assertSessionHasErrors('avatar');
    }

    public function test_profile_navbar_is_highlighted_on_profile_page(): void
    {
        $user = User::factory()->create(['name' => 'John Doe']);

        $response = $this->actingAs($user)->get(route('profile.edit'));

        $response->assertOk();
        $response->assertSee('href="'.route('profile.edit').'"', false);
        $response->assertSee('>Profile<', false);
    }
}
