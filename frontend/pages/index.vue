<template>
    <div class="min-h-screen bg-gray-100 p-8">
        <header class="mb-6">
            <h1 class="text-3xl font-bold text-blue-600 mb-2">Recipe Search</h1>
            <p class="text-gray-700">Search for recipes by name, ingredient, or author email</p>
        </header>
        <main class="container mx-auto">
            <SearchForm 
                v-model:email="query.email"
                v-model:keyword="query.keyword"
                v-model:ingredient="query.ingredient"
                @search="handleSearch" 
            />
            <div v-if="loading" class="text-center text-blue-600">Searching...</div>
            <div v-else-if="!results.length" class="text-center text-gray-600">No results found</div>
            <template v-else>
                <ul class="grid gap-4">
                    <li v-for="recipe in results" :key="recipe.id">
                        <NuxtLink :to="`/recipe/${recipe.slug}`" class="block p-4 bg-white rounded-lg shadow-md hover:bg-gray-50 transition-colors">
                            <h2 class="text-lg font-semibold mb-2">{{ recipe.name }}</h2>
                        </NuxtLink>
                    </li>
                </ul>
                
                <!-- Pagination -->
                <div v-if="totalPages > 1" class="mt-8 flex justify-center gap-2">
                    <NuxtLink 
                        v-for="page in totalPages" 
                        :key="page"
                        :to="{ query: { ...route.query, page } }"
                        :class="[
                            'px-4 py-2 rounded transition-colors',
                            Number(route.query.page || 1) === page 
                                ? 'bg-blue-500 text-white' 
                                : 'bg-white text-blue-500 hover:bg-blue-50'
                        ]"
                    >
                        {{ page }}
                    </NuxtLink>
                </div>
            </template>
        </main>
    </div>
</template>

<script setup>
const route = useRoute();
const { results, loading, totalPages, query, search, index } = useSearch();

// Watch for route changes to update the page
watch(() => route.query.page, () => {
    index();
});

// Initialize search on component mount
onMounted(() => {
    index();
});

const handleSearch = () => {
    search();
};
</script>
