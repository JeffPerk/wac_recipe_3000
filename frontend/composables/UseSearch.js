export const useSearch = () => {
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
        const { data } = await useFetch('api/recipes/search', { email: email.value, keyword: keyword.value, ingredient: ingredient.value });
        results.value = data.value.data;
        totalPages.value = data.value.last_page;
        loading.value = false;
    }

    return {
        email,
        keyword,
        ingredient,
        results,
        loading,
        totalPages,
        search
    };
}