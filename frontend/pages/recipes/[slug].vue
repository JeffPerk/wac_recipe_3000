
<template>
    <div class="min-h-screen bg-gray-100 p-4">
        <div class="container mx-auto">
            <h1 class="text-3xl font-bold text-blue-600 mb-4">{{ recipe.data.name || 'Loading...' }}</h1>
            <p v-if="recipe" class="mb-4">By {{ recipe.data.author_email }}</p>
            <p v-if="recipe">{{ recipe.data.description }}</p>
            <h2 v-if="recipe" class="text-2xl mt-4">Ingredients</h2>
            <ul v-if="recipe" class="list-disc pl-6">
                <li v-for="ingredient in recipe.data.ingredients" :key="ingredient">{{ ingredient }}</li>
            </ul>
            <h2 v-if="recipe" class="text-2xl mt-4">Steps</h2>
            <ol v-if="recipe" class="list-decimal pl-6">
                <li v-for="step in recipe.data.steps" :key="step">{{ step }}</li>
            </ol>
            <div v-if="error" class="mt-4 text-red-500">Error loading recipe: {{ error.message }}</div>
            <NuxtLink to="/" class="mt-4 inline-block px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                Back to Search
            </NuxtLink>
        </div>
    </div>
</template>

<script setup>
const route = useRoute();
const config = useRuntimeConfig();
const { data: recipe, error } = await useAsyncData(`recipe-${route.params.slug}`, () => {
    return $fetch(`${config.public.apiBase}/recipes/${route.params.slug}`);
});

if (error.value) {
    console.error('Error loading recipe:', error.value);
}
</script>