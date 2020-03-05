<template>
    <layout title="Blog Home">
        <div class="flex flex-col w-full -mt-16 md:-mt-24">
            <featured-post v-if="featured" :featured="featured" />
            <paginated-posts v-if="older" :posts="older" :links="links" />
            <template v-if="! older && ! featured">
                <div class="w-full text-center mt-16 md:mt-24 bg-white shadow-md">
                    <h1 class="font-damion text-3xl text-purple-700">
                        No posts available at this time. Check back soon!
                    </h1>
                </div>
            </template>
        </div>
    </layout>
</template>

<script>
import Layout from '@/Shared/Layout';
import FeaturedPost from '@/Shared/FeaturedPost';
import PaginatedPosts from '@/Shared/PaginatedPosts';

export default {
    props: {
        posts: {
            type: [Object,Array],
            default: () => ({}),
        },
    },
    components: {
        Layout,
        FeaturedPost,
        PaginatedPosts,
    },
    data () {
        return {
            featured: {},
            older: [],
            links: [],
        }
    },
    created () {
        this.featured = this.posts.data.length > 0 ? this.posts.data[0] : {};
        let posts = this.posts.data;
        this.links = this.posts.links;
        this.older = Array.isArray(posts) ? this.setOlderPosts(posts) : [];
    },
    methods: {
        setOlderPosts (posts) {
            posts.shift();

            return posts;
        },
    },
}
</script>
