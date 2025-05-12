export const useSearch = () => {
    const config = useRuntimeConfig();
    const email = ref('');
    const keyword = ref('');
    const ingredient = ref('');
    const results = ref([]);
    const loading = ref(false);
    const totalPages = ref(0);

    const query = computed(() => ({
        email: email.value,
        keyword: keyword.value,
        ingredient: ingredient.value,
    }));

    const search = async () => {
        loading.value = true;
        console.log('Search query params:', query.value);
        const { data, error } = await useFetch('/recipes/search', { 
            query: query.value, 
            baseURL: config.public.apiBase,
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            credentials: 'omit'
        });
        
        if (error.value) {
            console.error('Search error:', error.value);
        }
        
        console.log('Search response:', data.value);
        results.value = data.value?.data || [];
        totalPages.value = data.value?.last_page || 0;
        loading.value = false;
    }

    const index = async () => {
        loading.value = true;
        console.log('API Base URL:', config.public.apiBase);
        const { data, error } = await useFetch('/recipes', {
            baseURL: config.public.apiBase,
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            credentials: 'omit'
        });
        
        if (error.value) {
            console.error('Index error:', error.value);
        }
        
        console.log('Index response:', data.value);
        results.value = data.value?.data || [];
        totalPages.value = data.value?.last_page || 0;
        loading.value = false;
    }

    return {
        query,
        results,
        loading,
        totalPages,
        search,
        index
    };
}