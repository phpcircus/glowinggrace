<template>
    <layout title="Post">
        <div class="flex flex-col container mx-auto max-w-7xl">
            <div class="w-full flex">
                <inertia-link :href="route('posts.home')" class="flex items-center ml-6 md:ml-24 mb-2 group no-underline">
                    <icon-base icon-fill="fill-gray-600" classes="mr-2 group-hover:fill-gray-400">
                        <arrow-left />
                    </icon-base>
                    <span class="text-gray-600 text-base group-hover:text-gray-400">Posts</span>
                </inertia-link>
            </div>
            <!--Title-->
            <div class="text-center pt-8 md:pt-16">
                <p class="text-sm md:text-base text-teal-500 font-bold">- {{ post.readable_publish_date }} -<span class="text-gray-900" /></p>
                <h1 class="font-bold break-normal text-3xl md:text-5xl">{{ post.title }}</h1>
            </div>

            <!--image-->
            <div class="container w-full max-w-7xl mx-auto rounded">
                <img :src="post.featured_image" class="mx-auto">
            </div>

            <!--Container-->
            <div class="container max-w-5xl mx-auto mt-0 md:-mt-32">
                <div class="mx-0 sm:mx-6">
                    <div class="bg-white w-full p-8 md:p-24 text-xl md:text-2xl text-gray-800 leading-normal shadow-md rounded-lg">
                        <!--Post Content-->
                        <p v-html="post.body" />
                        <!--/ Post Content-->
                    </div>
                </div>
            </div>
        </div>
    </layout>
</template>

<script>
import Layout from '@/Shared/Layout';
import IconBase from '@/Shared/IconBase';
import ArrowLeft from '@/Shared/Icons/ArrowLeft';

export default {
    components: {
        Layout,
        IconBase,
        ArrowLeft,
    },
    props: {
        post: {
            type: [Array, Object],
            default: () => ({}),
        },
    },
}
</script>
