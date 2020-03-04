<template>
    <layout title="Blog Home">
        <div class="flex flex-col -mt-16 md:-mt-24">
            <featured-post :featured="featured" />
            <paginated-posts :posts="older" :links="links" />
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
