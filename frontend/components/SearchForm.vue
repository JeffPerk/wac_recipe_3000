<template>
    <div class="container mx-auto">
        <form
            @submit.prevent="$emit('search')"
            class="bg-white p-6 rounded-xl shadow-lg"
            aria-label="Recipe search form"
        >
            <div class="grid gap-4 md:grid-cols-3">
            <!-- Email Input -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
                Author Email
                </label>
                <input
                id="email"
                v-model="email"
                type="email"
                placeholder="e.g., chef@example.com"
                class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                aria-label="Search by author email"
                />
            </div>

            <!-- Keyword Input -->
            <div>
                <label for="keyword" class="block text-sm font-medium text-gray-700 mb-1">
                Keyword
                </label>
                <input
                id="keyword"
                v-model="keyword"
                type="text"
                placeholder="e.g., pasta"
                class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                aria-label="Search by keyword"
                />
            </div>

            <!-- Ingredient Input -->
            <div>
                <label
                for="ingredient"
                class="block text-sm font-medium text-gray-700 mb-1"
                >
                Ingredient
                </label>
                <input
                id="ingredient"
                v-model="ingredient"
                type="text"
                placeholder="e.g., shrimp"
                class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                aria-label="Search by ingredient"
                />
            </div>
            </div>

            <!-- Submit Button -->
            <div class="mt-6 flex justify-end">
                <button
                    type="submit"
                    class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                    aria-label="Submit search"
                >
                    Search
                </button>
            </div>
        </form>
    </div>
</template>

<script setup>
const props = defineProps({
    email: {
        type: String,
        default: ''
    },
    keyword: {
        type: String,
        default: ''
    },
    ingredient: {
        type: String,
        default: ''
    }
})

const emit = defineEmits(['update:email', 'update:keyword', 'update:ingredient', 'search'])

// Create computed properties for two-way binding
const email = computed({
    get: () => props.email,
    set: (value) => emit('update:email', value)
})

const keyword = computed({
    get: () => props.keyword,
    set: (value) => emit('update:keyword', value)
})

const ingredient = computed({
    get: () => props.ingredient,
    set: (value) => emit('update:ingredient', value)
})
</script>
