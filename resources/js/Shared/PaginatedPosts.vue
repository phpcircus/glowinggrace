<template>
    <div class="flex flex-col">
        <div class="flex flex-wrap justify-between -mx-6">
            <inertia-link v-for="post in posts" :key="post.id" :href="route('posts.show', post.id)" class="w-full md:w-1/3 p-6 flex flex-col">
                <div class="flex-1 bg-white rounded-t rounded-b-none overflow-hidden shadow-lg">
                    <a href="#" class="flex flex-wrap no-underline hover:no-underline">
                        <img :src="post.featured_image" class="h-auto w-full rounded-t pb-6">
                            <p class="w-full pt-6 px-6">
                                <template v-for="(tag, index) in post.tags">
                                    <div :key="tag.id" class="inline-block">
                                        <span class="text-gray-600 text-sm md:text-base">{{ tag.name }}</span>
                                        <span v-if="post.tags.length > index + 1" class="-ml-1">,&nbsp;</span>
                                    </div>
                                </template>
                            </p>
                        <div class="w-full font-bold text-xl text-gray-900 px-6">{{ post.title }}</div>
                        <p class="text-gray-800 font-serif text-base px-6 mb-5">
                            {{ post.excerpt }}
                        </p>
                    </a>
                </div>
                    <div class="flex-none mt-auto bg-white rounded-b rounded-t-none overflow-hidden shadow-lg p-6">
                        <div class="flex items-center justify-between mb-4">
                        <p class="text-gray-600 text-xs md:text-sm font-semibold">{{ post.readable_publish_date }}</p>
                        <p class="text-gray-800 text-xs md:text-sm font-semibold ml-auto pr-8">{{ calculateReadTime(post.body) }}</p>
                        </div>
                    </div>
            </inertia-link>
        </div>
        <div class="container mx-auto w-500p">
            <pagination :links="links" />
        </div>
    </div>
</template>

<script>
import ReadTime from '@/mixins/ReadTime';
import Pagination from '@/Shared/Pagination';

export default {
    props: {
        posts: {
            type: Array,
            default: () => [],
        },
        links: {
            type: Array,
            default: () => [],
        },
    },
    components: {
        Pagination,
    },
    mixins: [
        ReadTime,
    ],
}
</script>
