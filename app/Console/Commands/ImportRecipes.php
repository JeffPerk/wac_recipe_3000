<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ImportRecipes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'recipes:import {file?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import recipes from a JSON file';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $file = $this->argument('file') ?? 'recipes.json';
        $data = json_decode(file_get_contents($file), true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            $this->error('Failed to parse JSON file: ' . json_last_error_msg());
            return;
        }

        $this->info('Importing recipes from ' . $file); 

        DB::transaction(function () use ($data) {
            foreach ($data as $recipeData) {
                $recipe = Recipe::create($recipeData);
            }
        });

        $this->info('Import complete');
    }
}
