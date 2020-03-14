<template>
    <div class="bg-gray-200 h-300p py-4 shadow-md">
        <div v-for="article in $page.news" :key="article.id" class="flex max-w-7xl mx-auto px-4 sm:px-6 lg:px-2 py-3 border-b border-teal-500 cursor-pointer hover:bg-teal-500 group" @click="showNews(article.id)">
            <span class="text-sm text-teal-400 italic group-hover:text-white mr-8">
                {{ article.readable_created_at }}
            </span>
            <h1 class="text-lg text-teal-500 font-semibold group-hover:text-white">
                {{ article.title }}
            </h1>
        </div>
        <div v-if="isEmpty($page.news)" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-2 py-3">
            <h1 class="text-lg text-gray-800 font-semibold">
                No "quick news" available at this time.
            </h1>
        </div>
    </div>
</template>

<script>
export default {
    methods: {
        showNews (id) {
            this.$inertia.visit(this.route('news.show', id));
        },
    },
}
</script>
