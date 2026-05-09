<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BeautyAssistantHomeTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_renders_the_beauty_assistant_widget_for_authenticated_users(): void
    {
        $user = User::create([
            'name' => 'Usuario de prueba',
            'email' => 'home.widget@example.com',
            'address' => 'Calle de prueba 123',
            'phoneNumber' => '3000000000',
            'role' => 'client',
            'password' => 'password',
        ]);

        $response = $this->actingAs($user)->get('/');

        $response->assertOk();
        $response->assertSeeText('Belleza guiada por tu catálogo');
        $response->assertSeeText('Enviar pregunta');
    }
}
