<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Recipe extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'description', 'author_email'];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($recipe) {
            $recipe->slug = Recipe::generateSlug($recipe->name);
        });
    }

    public static function generateSlug($name)
    {
        $slug = Str::slug($name);
        $count = Recipe::where('slug', 'like', "{$slug}%")->count();
        return $count ? "{$slug}-{$count}" : $slug;
    }

    public function ingredients()
    {
        return $this->hasMany(Ingredient::class);
    }

    public function steps()
    {
        return $this->hasMany(Step::class);
    }
}
