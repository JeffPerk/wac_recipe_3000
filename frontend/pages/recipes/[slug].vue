
<template>
<div class="min-h-screen bg-gray-50">
    <!-- Header -->
    <header class="bg-gradient-to-r from-blue-600 to-blue-800 text-white py-8 px-4 md:px-8">
      <div class="container mx-auto flex items-center justify-between">
        <h1 class="text-3xl md:text-4xl font-extrabold tracking-tight">
          {{ recipe?.data?.name || 'Loading...' }}
        </h1>
        <NuxtLink
          to="/"
          class="px-4 py-2 bg-white text-blue-600 rounded-lg hover:bg-gray-100 transition-colors focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
          aria-label="Back to search"
        >
          Back to Search
        </NuxtLink>
      </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto py-8 px-4 md:px-8">
      <!-- Loading State -->
      <div
        v-if="!recipe && !error"
        class="text-center text-blue-600 text-lg font-medium animate-pulse"
      >
        Loading recipe...
      </div>

      <!-- Error State -->
      <div
        v-else-if="error"
        class="text-center text-red-500 text-lg font-medium"
      >
        Error loading recipe: {{ error.message }}
      </div>

      <!-- Recipe Content -->
      <Transition
        v-else
        name="fade"
        appear
      >
        <div class="bg-white p-6 rounded-xl shadow-lg">
          <p class="text-gray-600 mb-4">
            By: <span class="font-medium">{{ recipe.data.author_email }}</span>
          </p>
          <p class="text-gray-800 mb-6">{{ recipe.data.description }}</p>

          <!-- Ingredients -->
          <h2 class="text-2xl font-semibold text-gray-800 mb-4">Ingredients</h2>
          <ul class="grid gap-2 sm:grid-cols-2 lg:grid-cols-3 mb-6">
            <li
              v-for="(ingredient, index) in recipe.data.ingredients"
              :key="index"
              class="flex items-center text-gray-700"
            >
              <span class="mr-2 text-blue-600">•</span>
              {{ ingredient }}
            </li>
          </ul>

          <!-- Steps -->
          <h2 class="text-2xl font-semibold text-gray-800 mb-4">Steps</h2>
          <ol class="space-y-4">
            <li
              v-for="(step, index) in recipe.data.steps"
              :key="index"
              class="flex items-start text-gray-700"
            >
              <span class="mr-3 text-blue-600 font-semibold">{{ index + 1 }}.</span>
              <span>{{ step }}</span>
            </li>
          </ol>
        </div>
      </Transition>
    </main>
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

<style scoped>
.fade-enter-active {
  transition: opacity 0.5s ease, transform 0.5s ease;
}
.fade-enter-from {
  opacity: 0;
  transform: translateY(10px);
}
</style>