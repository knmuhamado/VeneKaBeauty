<?php

namespace Tests\Unit;

use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    private function makeProduct(string $name): Product
    {
        return Product::make([
            'name' => $name,
            'image' => 'products/default.png',
            'description' => 'Descripción de prueba',
            'available' => true,
            'price' => 1000,
            'brand' => null,
            'keyword' => ['test'],
            'type' => 'article',
        ]);
    }

    private function makeReviewedProduct(string $name, User $user, array $scores): Product
    {
        $product = $this->makeProduct($name);
        $product->save();

        foreach ($scores as $score) {
            Review::create([
                'score' => $score,
                'comment' => 'Comentario de prueba',
                'product_id' => $product->getId(),
                'user_id' => $user->getId(),
            ]);
        }

        return $product;
    }

    private function makeUser(): User
    {
        return User::create([
            'name' => 'Usuario de prueba',
            'email' => 'usuario.test@example.com',
            'address' => 'Calle de prueba 123',
            'phoneNumber' => '3000000000',
            'role' => 'client',
            'password' => 'password',
        ]);
    }

    public function test_it_returns_zero_average_and_no_rating_label_when_it_has_no_reviews(): void
    {
        $product = $this->makeProduct('Sin reseñas');

        $this->assertSame(0, $product->getAverageScore());
        $this->assertSame(__('product.rating_no'), $product->getRating());
    }

    public function test_it_returns_only_top_rated_products_sorted_and_limited(): void
    {
        $user = $this->makeUser();

        $topProduct = $this->makeReviewedProduct('Top', $user, [5, 5]);
        $secondProduct = $this->makeReviewedProduct('Second', $user, [5]);
        $thirdProduct = $this->makeReviewedProduct('Third', $user, [4, 4]);
        $fourthProduct = $this->makeReviewedProduct('Fourth', $user, [4]);
        $fifthProduct = $this->makeReviewedProduct('Fifth', $user, [4, 4, 4]);
        $excludedProduct = $this->makeReviewedProduct('Excluded', $user, [4, 4, 4, 4]);
        $lowRatedProduct = $this->makeReviewedProduct('Low rated', $user, [3, 3]);

        $products = Product::getTopRatedProducts();

        $this->assertCount(5, $products);
        $this->assertSame([5, 5, 4, 4, 4], $products->pluck('average_score')->all());
        $this->assertTrue($products->contains(fn (Product $product): bool => $product->getName() === $topProduct->getName()));
        $this->assertTrue($products->contains(fn (Product $product): bool => $product->getName() === $secondProduct->getName()));
        $this->assertTrue($products->contains(fn (Product $product): bool => $product->getName() === $thirdProduct->getName()));
        $this->assertFalse($products->contains(fn (Product $product): bool => $product->getName() === $excludedProduct->getName()));
        $this->assertFalse($products->contains(fn (Product $product): bool => $product->getName() === $lowRatedProduct->getName()));
    }
}
