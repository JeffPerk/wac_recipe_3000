<template>
    <div class="min-h-screen bg-gray-50">
        <!-- Header -->
        <header class="bg-gradient-to-r from-blue-600 to-blue-800 text-white py-8 px-4 md:px-8">
            <div class="container mx-auto">
                <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight mb-2">
                    Recipe Search 3000
                </h1>
                <p class="text-lg md:text-xl opacity-90">
                    Search for recipes by name, ingredient, or author email
                </p>
            </div>
        </header>

        <!-- Main Content -->
        <main class="container mx-auto py-8 px-4 md:px-8">
            <SearchForm 
                v-model:email="query.email"
                v-model:keyword="query.keyword"
                v-model:ingredient="query.ingredient"
                @search="handleSearch" 
                class="mb-8"
            />

            <!-- Loading State -->
            <div v-if="loading" class="text-center text-blue-600 text-lg font-medium animate-pulse">
                Searching...
            </div>
            <div v-else-if="!results.length" class="text-center text-gray-500 text-lg font-medium">
                No results found
            </div>

            <TransitionGroup
                v-else
                name="fade"
                tag="ul"
                class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3"
            >
                <li
                v-for="recipe in results"
                :key="recipe.id"
                class="transform transition-transform hover:scale-[1.02]"
                >
                <NuxtLink
                    :to="`/recipes/${recipe.slug}`"
                    class="block p-6 bg-white rounded-xl shadow-lg hover:shadow-xl transition-shadow"
                    aria-label="View recipe details"
                >
                    <h2 class="text-xl font-semibold text-gray-800 mb-2">
                    {{ recipe.name }}
                    </h2>
                    <p class="text-gray-600 text-sm line-clamp-2">
                    {{ recipe.description }}
                    </p>
                    <div class="mt-3 flex flex-wrap gap-2">
                    <span
                        v-for="(ingredient, index) in recipe.ingredients.slice(0, 3)"
                        :key="index"
                        class="inline-block px-2 py-1 bg-blue-100 text-blue-700 text-xs rounded-full"
                    >
                        {{ ingredient }}
                    </span>
                    </div>
                </NuxtLink>
                </li>
            </TransitionGroup>

            <!-- Pagination -->
            <div
            v-if="totalPages > 1"
            class="mt-10 flex justify-center gap-2 flex-wrap"
            >
                <NuxtLink
                    v-for="page in totalPages"
                    :key="page"
                    :to="{ query: { ...route.query, page } }"
                    :class="[
                    'px-4 py-2 rounded-lg text-sm font-medium transition-all',
                    Number(route.query.page || 1) === page
                        ? 'bg-blue-600 text-white shadow-md'
                        : 'bg-gray-200 text-gray-700 hover:bg-blue-100 hover:text-blue-700'
                    ]"
                    :aria-label="`Go to page ${page}`"
                    :aria-current="Number(route.query.page || 1) === page ? 'page' : null"
                >
                    {{ page }}
                </NuxtLink>
            </div>
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

<style scoped>
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.3s ease, transform 0.3s ease;
}
.fade-enter-from,
.fade-leave-to {
  opacity: 0;
  transform: translateY(10px);
}
</style>
