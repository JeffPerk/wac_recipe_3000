<?php

namespace App\Http\Controllers;

use App\Repositories\RecipeRepository;
use Illuminate\Http\Request;
use App\Http\Resources\RecipeResource;
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
    
    
}
