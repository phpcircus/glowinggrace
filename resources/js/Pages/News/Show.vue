<template>
    <layout title="News">
        <div class="flex flex-col container mx-auto max-w-7xl">
            <div class="w-full flex">
                <inertia-link :href="route('posts.home')" class="flex items-center mx-6 md:mx-0 mb-2 group no-underline">
                    <icon-base icon-fill="fill-gray-600" classes="mr-2 group-hover:fill-gray-400">
                        <arrow-left />
                    </icon-base>
                    <span class="text-gray-600 text-base group-hover:text-gray-400">Home</span>
                </inertia-link>
            </div>
            <!--Title-->
            <div class="flex flex-col md:flex-row items-start md:items-center pt-8 md:pt-16 mb-2">
                <h1 class="font-bold break-normal text-gray-800 ml-6 md:ml-0 text-lg md:text-2xl">{{ article.title }}</h1>
                <span class="text-sm text-gray-600 italic ml-6 md:ml-auto">
                    {{ article.author.name }} posted {{ article.readable_created_at }}
                </span>
            </div>

            <!--Container-->
            <div class="container max-w-7xl mx-auto">
                <div class="mx-6 md:mx-0">
                    <div class="flex flex-col bg-white w-full px-4 py-8 text-base md:text-xl text-gray-800 leading-normal shadow-md rounded-lg">
                        <!--Post Content-->
                        <p v-html="article.body" />
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
    props: {
        article: {
            type: [Array, Object],
            default: () => ({}),
        },
    },
    components: {
        Layout,
        IconBase,
        ArrowLeft,
    },
}
</script>
