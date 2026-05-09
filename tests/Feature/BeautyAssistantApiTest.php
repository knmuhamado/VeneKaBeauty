<?php

namespace Tests\Feature;

use App\Models\BeautyConversation;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BeautyAssistantApiTest extends TestCase
{
    use RefreshDatabase;

    private function makeUser(): User
    {
        return User::create([
            'name' => 'Usuario de prueba',
            'email' => 'assistant.test@example.com',
            'address' => 'Calle de prueba 123',
            'phoneNumber' => '3000000000',
            'role' => 'client',
            'password' => 'password',
        ]);
    }

    public function test_it_returns_contextual_response_with_products(): void
    {
        $user = $this->makeUser();
        $this->actingAs($user);

        $category = Category::create(['name' => 'Skincare']);

        Product::create([
            'name' => 'Gel Control Sebo',
            'image' => 'products/default.png',
            'description' => 'Ayuda a controlar brillo y grasa en el rostro.',
            'available' => true,
            'price' => 32000,
            'brand' => 'DermaCare',
            'keyword' => ['piel grasa', 'oil free', 'acne'],
            'type' => 'article',
            'category_id' => $category->getId(),
        ]);

        Product::create([
            'name' => 'Masaje Relajante',
            'image' => 'products/default.png',
            'description' => 'Servicio de bienestar general.',
            'available' => true,
            'price' => 60000,
            'brand' => null,
            'keyword' => ['spa'],
            'type' => 'service',
            'category_id' => $category->getId(),
        ]);

        $response = $this->postJson('/api/beauty-assistant/chat', [
            'message' => 'Tengo piel grasa con acne, que me recomiendas?',
        ]);

        $response->assertOk()
            ->assertJsonStructure([
                'messages',
                'latest' => [
                    'user_message',
                    'assistant_message',
                    'recommended_products',
                    'meta' => ['source'],
                ],
            ]);

        $this->assertCount(2, $response->json('messages'));
        $this->assertNotEmpty($response->json('latest.assistant_message'));
        $this->assertNotEmpty($response->json('latest.recommended_products'));
    }

    public function test_it_excludes_unavailable_products(): void
    {
        $user = $this->makeUser();
        $this->actingAs($user);

        $category = Category::create(['name' => 'Skincare']);

        Product::create([
            'name' => 'Serum Hidratante Plus',
            'image' => 'products/default.png',
            'description' => 'Hidratacion profunda para piel seca.',
            'available' => true,
            'price' => 45000,
            'brand' => 'SkinLab',
            'keyword' => ['hidratacion', 'piel seca'],
            'type' => 'article',
            'category_id' => $category->getId(),
        ]);

        Product::create([
            'name' => 'Crema Fuera de Stock',
            'image' => 'products/default.png',
            'description' => 'Producto no disponible.',
            'available' => false,
            'price' => 28000,
            'brand' => 'SkinLab',
            'keyword' => ['piel seca'],
            'type' => 'article',
            'category_id' => $category->getId(),
        ]);

        $response = $this->postJson('/api/beauty-assistant/chat', [
            'message' => 'Que recomiendas para piel seca?',
        ]);

        $response->assertOk();

        $recommendedNames = collect($response->json('latest.recommended_products'))->pluck('name')->all();

        $this->assertContains('Serum Hidratante Plus', $recommendedNames);
        $this->assertNotContains('Crema Fuera de Stock', $recommendedNames);
    }

    public function test_it_persists_history_and_returns_it_from_the_history_endpoint(): void
    {
        $user = $this->makeUser();
        $this->actingAs($user);

        $category = Category::create(['name' => 'Skincare']);

        Product::create([
            'name' => 'Crema Calmante',
            'image' => 'products/default.png',
            'description' => 'Ayuda a calmar la piel sensible.',
            'available' => true,
            'price' => 28000,
            'brand' => 'CalmLab',
            'keyword' => ['piel sensible'],
            'type' => 'article',
            'category_id' => $category->getId(),
        ]);

        $this->postJson('/api/beauty-assistant/chat', [
            'message' => 'Tengo piel sensible, que puedo usar?',
        ])->assertOk();

        $history = $this->getJson('/api/beauty-assistant/history');

        $history->assertOk()
            ->assertJsonStructure([
                'messages' => [
                    ['id', 'role', 'content', 'products', 'meta', 'created_at'],
                ],
            ]);

        $this->assertCount(2, $history->json('messages'));

        $conversation = BeautyConversation::query()->where('user_id', $user->getId())->firstOrFail();
        $this->assertCount(2, $conversation->messages);
        $this->assertContains('user', $conversation->messages->pluck('role')->all());
        $this->assertContains('assistant', $conversation->messages->pluck('role')->all());
    }
}
