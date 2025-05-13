<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Repositories\RecipeRepository;
use App\Http\Resources\RecipeResource;
use Illuminate\Http\Request;
class RecipeController extends Controller
{
    protected $recipes;

    public function __construct(RecipeRepository $recipes)
    {
        $this->recipes = $recipes;
    }

    public function index()
    {
        $recipes = $this->recipes->search();
        
        return RecipeResource::collection($recipes);
    }

    public function search(Request $request)
    {
        $params = $request->only(['email', 'keyword', 'ingredient']);
        $recipes = $this->recipes->search($params);

        return RecipeResource::collection($recipes);
    }
    
    public function show($slug)
    {
        $recipe = Recipe::with(['ingredients', 'steps'])->where('slug', $slug)->firstOrFail();

        return new RecipeResource($recipe);
    }
}
