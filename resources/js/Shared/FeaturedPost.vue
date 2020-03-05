<template>
        <!--Featured Post-->
        <div class="w-full bg-white mb-4 rounded-t-lg overflow-hidden shadow-lg">
            <a :href="route('posts.show', featured.id)" class="flex flex-wrap h-auto md:h-500p w-full no-underline hover:no-underline">
                <div class="w-full h-auto md:h-full md:w-2/3 mx-auto md:mx-0 text-center rounded-t">
                    <img :src="featured.featured_image" class="shadow-md">
                    <p class="text-teal-300 text-sm italic font-semibold mt-2">{{ featured.featured_image_caption }}</p>
                </div>
                <div class="w-full h-auto md:h-full md:w-1/3 flex flex-col flex-grow">
                    <div class="flex-1 bg-white rounded-tr-lg overflow-hidden shadow-lg">
                        <p class="w-full pt-6 px-6">
                            <template v-for="(tag, index) in featured.tags">
                                <div :key="tag.id" class="inline-block">
                                    <span class="text-gray-600 text-sm md:text-base">{{ tag.name }}</span>
                                    <span v-if="featured.tags.length > index + 1" class="-ml-1">,&nbsp;</span>
                                </div>
                            </template>
                        </p>
                        <div class="w-full font-bold text-2xl text-gray-900 px-6">{{ featured.title }}</div>
                        <p class="text-gray-800 font-serif text-lg pl-6 pr-8 mb-5">
                            {{ featured.excerpt }}
                        </p>
                    </div>

                    <div class="flex-none mt-auto bg-white rounded-b rounded-t-none overflow-hidden shadow-lg p-6">
                        <div class="flex items-center justify-between mb-4">
                        <p class="text-gray-600 text-xs md:text-sm font-semibold">{{ featured.readable_publish_date }}</p>
                        <p class="text-gray-800 text-xs md:text-sm font-semibold ml-auto pr-8">{{ calculateReadTime(featured.body) }}</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <!--/FeaturedPost-->
</template>

<script>
import ReadTime from '@/mixins/ReadTime';

export default {
    props: {
        featured: {
            type: Object,
            default: () => ({}),
        },
    },
    mixins: [
        ReadTime,
    ],
}
</script>
