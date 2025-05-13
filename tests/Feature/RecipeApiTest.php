<?php

namespace Tests\Feature;

use App\Models\Recipe;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RecipeApiTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_returns_paginated_recipes_with_no_filters()
    {
        Recipe::factory()
            ->has(\App\Models\Ingredient::factory()->count(3))
            ->has(\App\Models\Step::factory()->count(3))
            ->count(10)
            ->create();

        $response = $this->getJson('/api/recipes');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'name',
                        'slug',
                        'description',
                        'author_email',
                        'ingredients',
                        'steps'
                    ]
                ],
                'meta' => [
                    'current_page',
                    'last_page',
                ]
            ])->assertJsonCount(6, 'data');
    }

    /** @test */
    public function it_filters_recipes_by_email()
    {
        $recipe1 = Recipe::factory()->create([
            'author_email' => 'roger@example.com',
        ]);

        $recipe2 = Recipe::factory()->create([
            'author_email' => 'amy@example.com',
        ]);

        $response = $this->getJson('/api/recipes/search?email=roger@example.com');

        $response->assertStatus(200)
            ->assertJsonCount(1, 'data')
            ->assertJsonFragment(["author_email" => "roger@example.com"])
            ->assertJsonMissing(["author_email" => "amy@example.com"]);
    }

    /** @test */
    public function it_filters_by_keyword()
    {
        $recipe1 = Recipe::factory()
            ->has(\App\Models\Ingredient::factory()->state(['name' => 'pasta']))
            ->create(['name' => 'Pasta Primavera']);

        $recipe2 = Recipe::factory()->create([
            'name' => 'Chicken Curry',
        ]);

        $response = $this->getJson('/api/recipes/search?keyword=pasta');

        $response->assertStatus(200)
            ->assertJsonCount(1, 'data')
            ->assertJsonFragment(["name" => "Pasta Primavera"])
            ->assertJsonMissing(["name" => "Chicken Curry"]);
    }

    /** @test */
    public function it_filters_by_ingredient()
    {
        $recipe1 = Recipe::factory()
            ->has(\App\Models\Ingredient::factory()->state(['name' => 'shrimp']))
            ->create();

        $recipe2 = Recipe::factory()
            ->has(\App\Models\Ingredient::factory()->state(['name' => 'chicken']))
            ->create();

        $response = $this->getJson('/api/recipes/search?ingredient=shrimp');

        $response->assertStatus(200)
            ->assertJsonCount(1, 'data')
            ->assertJsonFragment(["ingredients" => ["shrimp"]])
            ->assertJsonMissing(["ingredients" => ["chicken"]]);
    }

    /** @test */
    public function it_filters_recipes_by_multiple_criteria()
    {
        $recipe1 = Recipe::factory()
            ->has(\App\Models\Ingredient::factory()->state(['name' => 'shrimp']))
            ->has(\App\Models\Step::factory()->state(['description' => 'Cook shrimp in a pan']))
            ->create(['author_email' => 'roger@example.com']);

        $otherRecipe = Recipe::factory()->create();
        
        $response = $this->getJson('/api/recipes/search?email=roger@example.com&ingredient=shrimp&keyword=shrimp');

        $response->assertStatus(200)
            ->assertJsonCount(1, 'data')
            ->assertJsonFragment(["author_email" => "roger@example.com"]);
    }

    /** @test */
    public function it_returns_recipe_details_by_slug()
    {
        $recipe = Recipe::factory()
            ->state([
                'name' => 'Bubba Gump Shrimp',
                'slug' => 'bubba-gump-shrimp'
                ])
            ->has(\App\Models\Ingredient::factory()->count(2))
            ->has(\App\Models\Step::factory()->count(3))
            ->create();

        $response = $this->getJson('/api/recipes/bubba-gump-shrimp');
        // dd($response->json());
        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id', 'name', 'slug', 'description', 'author_email', 'ingredients', 'steps'
                ]
            ])
            ->assertJsonFragment([
                'slug' => 'bubba-gump-shrimp'
            ]);
    }

    /** @test */
    public function it_returns_404_for_invalid_slug()
    {
        $response = $this->getJson('/api/recipes/invalid-slug');

        $response->assertStatus(404);
    }

    /** @test */
    public function it_paginates_search_results()
    {
        Recipe::factory()->count(11)->create();

        $response = $this->getJson('/api/recipes/search?page=2');
// dd($response->json());
        $response->assertStatus(200)
            ->assertJson([
                'meta' => [
                    'current_page' => 2
                ]
            ])
            ->assertJsonCount(5, 'data');
    }
}
