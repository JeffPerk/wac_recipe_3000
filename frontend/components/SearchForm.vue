<template>
    <div class="container mx-auto">
        <form @submit.prevent="$emit('search')" class="mb-4">
            <div class="flex">
                <input 
                    type="text" 
                    v-model="email" 
                    placeholder="Email" 
                    class="flex-1 px-3 py-2 border rounded-l"
                >
                <input 
                    type="text" 
                    v-model="keyword" 
                    placeholder="Keyword" 
                    class="flex-1 px-3 py-2 border"
                >
                <input 
                    type="text" 
                    v-model="ingredient" 
                    placeholder="Ingredient" 
                    class="flex-1 px-3 py-2 border"
                >
                <button 
                    type="submit" 
                    class="px-4 py-2 bg-blue-500 text-white rounded-r hover:bg-blue-600 transition-colors"
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
