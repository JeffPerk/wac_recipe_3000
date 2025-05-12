<?php

namespace App\Repositories;

use App\Models\Recipe;

class RecipeRepository
{
    public function getAllRecipes()
    {
        return Recipe::all();
    }

    public function getRecipeById($id)
    {
        return Recipe::findOrFail($id);
    }
    
    public function search($params = [], $perPage = 10)
    {
        $query = Recipe::query()->with(['ingredients', 'steps']);

        if (!empty($params['email'])) {
            $query->where('author_email', $params['email']);
        }

        if (!empty($params['keyword'])) {
            $query->where(function ($q) use ($params) {
                $q->where('name', 'like', "%{$params['keyword']}%")
                    ->orWhere('description', 'like', "%{$params['keyword']}%")
                    ->orWhereHas('ingredients', function ($q) use ($params) {
                        $q->where('name', 'like', "%{$params['keyword']}%");
                    })
                    ->orWhereHas('steps', function ($q) use ($params) {
                        $q->where('description', 'like', "%{$params['keyword']}%");
                    });
            });
        }

        if (!empty($params['ingredient'])) {
            $query->whereHas('ingredients', function ($q) use ($params) {
                $q->where('name', 'like', "%{$params['ingredient']}%");
            });
        }
        
        

        return $query->paginate($perPage);
    }
}