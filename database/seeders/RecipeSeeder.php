<?php

namespace Database\Seeders;

use App\Models\Recipe;
use App\Models\Ingredient;
use App\Models\Step;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RecipeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $recipes = [
            [
                'name' => 'Classic Carbonara',
                'description' => 'A creamy pasta dish with bacon and eggs',
                'author_email' => 'john@example.com',
                'ingredients' => [
                    'Pasta',
                    'Bacon',
                    'Eggs',
                    'Parmesan',
                    'Pasta Sauce',
                ],
                'steps' => [
                    'Boil pasta',
                    'Cook bacon',
                    'Beat eggs and mix with parmesan',
                    'Mix pasta, bacon, and eggs',
                    'Add pasta sauce',
                ],
            ],
            [
                'name' => 'Garlic Butter Shrimp Pasta',
                'description' => 'A creamy pasta dish with shrimp and garlic butter',
                'author_email' => 'jane@example.com',
                'ingredients' => [
                    'Pasta',
                    'Shrimp',
                    'Garlic',
                    'Butter',
                    'Parmesan',
                    'Pasta Sauce',
                ],
                'steps' => [
                    'Boil pasta',
                    'Cook shrimp',
                    'Garlic butter sauce',
                    'Mix pasta, shrimp, and garlic butter sauce',
                    'Add parmesan',
                    'Serve with extra parmesan',
                ],
            ],
            [
                'name' => 'Creamy Tomato Soup',
                'description' => 'A creamy tomato soup with a hint of garlic',
                'author_email' => 'mike@example.com',
                'ingredients' => [
                    'Tomatoes', 
                    'Garlic',
                    'Onions',
                    'Cream',
                    'Chicken Stock',
                    'Parmesan',
                ],
                'steps' => [
                    'Cook tomatoes, garlic, and onions',
                    'Add chicken stock and cream',
                    'Blend until creamy',
                    'Add parmesan',
                ],
            ],
            [
                'name' => 'Spicy Chicken Tacos',
                'description' => 'A spicy chicken taco with a hint of garlic',
                'author_email' => 'roger@example.com',
                'ingredients' => [
                    'Chicken',
                    'Garlic',
                    'Onions',
                    'Cream',
                    'Chicken Stock',
                    'Parmesan',
                ],
                'steps' => [
                    'Cook chicken',
                    'Garlic butter sauce',
                    'Mix chicken, garlic, and onions',
                    'Add parmesan',
                ],
            ],
            [
                'name' => 'Grilled Cheese Sandwich',
                'description' => 'A grilled cheese sandwich with a hint of garlic',
                'author_email' => 'bill@example.com',
                'ingredients' => [
                    'Bread',
                    'Cheese',
                    'Butter',
                ],
                'steps' => [
                    'Grill bread',
                    'Add cheese and butter',
                    'Grill until golden',
                ],
            ],
            [
                'name' => 'Classic Caesar Salad',
                'description' => 'A classic caesar salad with a hint of garlic',
                'author_email' => 'roger@example.com',
                'ingredients' => [
                    'Lettuce',
                    'Cheese',
                    'Croutons',
                    'Caesar Dressing',
                ],
                'steps' => [
                    'Mix lettuce, cheese, and croutons',
                    'Add caesar dressing',
                ],
            ],
            [
                'name' => 'Potato Soup',
                'description' => 'A creamy potato soup with a hint of garlic',
                'author_email' => 'amy@example.com',
                'ingredients' => [
                    'Potatoes',
                    'Onions', 
                    'Garlic',
                    'Chicken Stock',
                    'Cream',
                    'Parmesan',
                ],
                'steps' => [
                    'Cook potatoes, onions, and garlic',
                    'Add chicken stock and cream', 
                    'Blend until creamy',
                    'Add parmesan',
                ],
            ],
            [
                'name' => 'Beef Stir Fry',
                'description' => 'A quick and flavorful beef stir fry with vegetables',
                'author_email' => 'lucy@example.com',
                'ingredients' => [
                    'Beef strips',
                    'Bell peppers',
                    'Broccoli',
                    'Carrots',
                    'Soy sauce',
                    'Ginger',
                ],
                'steps' => [
                    'Marinate beef in soy sauce',
                    'Stir fry vegetables',
                    'Cook beef until browned',
                    'Combine and season',
                ],
            ],
            [
                'name' => 'Chocolate Chip Cookies',
                'description' => 'Classic homemade chocolate chip cookies',
                'author_email' => 'roger@example.com',
                'ingredients' => [
                    'Flour',
                    'Butter',
                    'Brown sugar',
                    'Eggs',
                    'Vanilla',
                    'Chocolate chips',
                ],
                'steps' => [
                    'Cream butter and sugar',
                    'Add eggs and vanilla',
                    'Mix in dry ingredients',
                    'Bake until golden',
                ],
            ],
            [
                'name' => 'Mediterranean Quinoa Bowl',
                'description' => 'Healthy Mediterranean-style quinoa bowl',
                'author_email' => 'amy@example.com',
                'ingredients' => [
                    'Quinoa',
                    'Chickpeas',
                    'Cucumber',
                    'Cherry tomatoes',
                    'Feta cheese',
                    'Olive oil',
                ],
                'steps' => [
                    'Cook quinoa',
                    'Prepare vegetables',
                    'Mix ingredients',
                    'Drizzle with olive oil',
                ],
            ],
            [
                'name' => 'Banana Bread',
                'description' => 'Moist and delicious homemade banana bread',
                'author_email' => 'amy@example.com',
                'ingredients' => [
                    'Ripe bananas',
                    'Flour',
                    'Sugar',
                    'Eggs',
                    'Butter',
                    'Vanilla',
                ],
                'steps' => [
                    'Mash bananas',
                    'Mix wet ingredients',
                    'Add dry ingredients',
                    'Bake until done',
                ],
            ],
            [
                'name' => 'Shrimp Scampi',
                'description' => 'Garlicky shrimp scampi with pasta',
                'author_email' => 'linda@example.com',
                'ingredients' => [
                    'Shrimp',
                    'Linguine',
                    'Garlic',
                    'White wine',
                    'Butter',
                    'Parsley',
                ],
                'steps' => [
                    'Cook pasta',
                    'Saute garlic in butter',
                    'Cook shrimp',
                    'Toss with pasta',
                ],
            ],
            [
                'name' => 'Vegetable Curry',
                'description' => 'Spicy Indian-style vegetable curry',
                'author_email' => 'linda@example.com',
                'ingredients' => [
                    'Mixed vegetables',
                    'Coconut milk',
                    'Curry powder',
                    'Onions',
                    'Tomatoes',
                    'Rice',
                ],
                'steps' => [
                    'Saute onions',
                    'Add spices and vegetables',
                    'Simmer in coconut milk',
                    'Serve with rice',
                ],
            ],
            [
                'name' => 'BBQ Pulled Pork',
                'description' => 'Slow-cooked BBQ pulled pork sandwiches',
                'author_email' => 'linda@example.com',
                'ingredients' => [
                    'Pork shoulder',
                    'BBQ sauce',
                    'Onions',
                    'Burger buns',
                    'Coleslaw',
                    'Spices',
                ],
                'steps' => [
                    'Season pork',
                    'Slow cook for 8 hours',
                    'Shred and mix with sauce',
                    'Serve on buns',
                ],
            ],
            [
                'name' => 'Greek Salad',
                'description' => 'Fresh and crisp traditional Greek salad',
                'author_email' => 'linda@example.com',
                'ingredients' => [
                    'Tomatoes',
                    'Cucumber',
                    'Red onion',
                    'Olives',
                    'Feta cheese',
                    'Olive oil',
                ],
                'steps' => [
                    'Chop vegetables',
                    'Add olives and feta',
                    'Dress with olive oil',
                    'Season to taste',
                ],
            ],
            [
                'name' => 'Mushroom Risotto',
                'description' => 'Creamy mushroom risotto with parmesan',
                'author_email' => 'linda@example.com',
                'ingredients' => [
                    'Arborio rice',
                    'Mushrooms',
                    'Onions',
                    'White wine',
                    'Parmesan',
                    'Stock',
                ],
                'steps' => [
                    'Saute mushrooms and onions',
                    'Add rice and wine',
                    'Gradually add stock',
                    'Finish with parmesan',
                ],
            ],
            [
                'name' => 'Fish Tacos',
                'description' => 'Fresh fish tacos with lime slaw',
                'author_email' => 'linda@example.com',
                'ingredients' => [
                    'White fish',
                    'Tortillas',
                    'Cabbage slaw',
                    'Lime',
                    'Cilantro',
                    'Avocado',
                ],
                'steps' => [
                    'Cook fish',
                    'Prepare slaw',
                    'Warm tortillas',
                    'Assemble tacos',
                ],
            ],            
        ];

        $ingredientData = [];
        $stepData = [];

        DB::transaction(function () use ($recipes, &$ingredientData, &$stepData) {
            foreach ($recipes as $recipeData) {
                $recipe = Recipe::create([
                    'name' => $recipeData['name'],
                    'description' => $recipeData['description'],
                    'author_email' => $recipeData['author_email']
                ]);

                $ingredientData = array_merge($ingredientData, array_map(fn($ingredient) => [
                    'recipe_id' => $recipe->id,
                    'name' => $ingredient,
                ], $recipeData['ingredients']));

                $stepData = array_merge($stepData, array_map(fn($step, $index) => [
                    'recipe_id' => $recipe->id,
                    'step_number' => $index + 1,
                    'description' => $step,
                ], $recipeData['steps'], array_keys($recipeData['steps'])));
            }
        });
        
        Ingredient::insert($ingredientData);
        Step::insert($stepData);
    }
}
