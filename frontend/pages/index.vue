<template>
    <div class="min-h-screen bg-gray-100 p-8">
        <header class="mb-6">
            <h1 class="text-3xl font-bold text-blue-600 mb-2">Recipe Search</h1>
            <p class="text-gray-700">Search for recipes by name, ingredient, or author email</p>
        </header>
        <main class="container mx-auto">
            <SearchForm @search="handleSearch" />
            <div v-if="loading" class="text-center text-blue-600">Searching...</div>
            <div v-else-if="!results.length" class="text-center text-gray-600">No results found</div>
            <ul v-else class="grid gap-4">
                <li v-for="recipe in results" :key="recipe.id">
                    <NuxtLink :to="`/recipe/${recipe.slug}`" class="block p-4 bg-white rounded-lg shadow-md hover:bg-gray-50 transition-colors">
                        <h2 class="text-lg font-semibold mb-2">{{ recipe.name }}</h2>
                        <p class="text-gray-600">{{ recipe.ingredients.join(', ') }}</p>
                        <p class="text-gray-600">By {{ recipe.author_email }}</p>
                    </NuxtLink>
                </li>
            </ul>
            <div v-if="totalPages > 1" class="mt-4 flex justify-center">
                <NuxtLink 
                v-for="page in totalPages" 
                :key="page" 
                :to="`{ query: { ...query, page } }`" 
                class="mx-1 px-3 py-1 bg-blue-500 text-white rounded">
                    {{ page }}
                </NuxtLink>
            </div>
        </main>
    </div>
</template>

<script setup>
const { results, loading, totalPages, query, search } = useSearch();

const handleSearch = () => {
    search();
};

</script>
