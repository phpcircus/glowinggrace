<template>
    <div class="w-full bg-contrast z-50 fixed left-0 top-0 p-12 overflow-y-scroll">
        <div class="container py-20">
            <div class="flex items-center">
                <h2 class="mr-auto text-2xl text-gray-800 font-semibold">Search Unsplash</h2>

                <button class="btn-primary mr-4" v-if="selectedUnsplashImage" @click="closeUnplashModalAndInsertImage">Choose Selected Image</button>
                <button class="btn-light" @click="closeUnsplashModal">Cancel</button>
            </div>

            <input type="text" class="my-10 border-b border-very-light focus:outline-none w-full"
                    v-if="$page.wink.supplementals.unsplash_key"
                    v-model="unsplashSearchTerm"
                    ref="unsplashSearch"
                    placeholder="search">

            <preloader v-if="searchingUnsplash" class="mt-10"></preloader>

            <div v-if="! searchingUnsplash && unsplashImages.length" class="flex flex-wrap mt-5">
                <div class="w-1/4 p-1 cursor-pointer" v-for="image in unsplashImages" @click="selectedUnsplashImage = image">
                    <div class="h-48 w-full bg-cover border-primary"
                            :class="{'border-4': selectedUnsplashImage && selectedUnsplashImage.id == image.id}" :style="{ backgroundImage: 'url(' + image.urls.thumb + ')' }"></div>
                </div>

                <div class="w-1/4 p-1" v-if="unsplashImages.length == 19">
                    <div class="bg-primary text-center flex items-center justify-center h-full">
                        <button class="text-contrast hover:underline" @click="getImagesFromUnsplash(unsplashPage + 1)">More >></button>
                    </div>
                </div>
            </div>

            <div v-if="! searchingUnsplash && ! unsplashImages.length">
                <h4 class="text-center">No images found when searching for {{ unsplashSearchTerm }}.</h4>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import Hub from 'Events/hub';
import Preloader from '@/wink/partials/Preloader';

export default {
    props: {
        searchTerm: {
            type: String,
            required: false,
            default: () => 'sunflowers',
        },
    },
    components: {
        Preloader,
    },
    data () {
        return {
            selectedUnsplashImage: null,
            unsplashSearchTerm: this.searchTerm,
            unsplashPage: 1,
            searchingUnsplash: true,
            unsplashImages: [],
        }
    },
    watch: {
        unsplashSearchTerm () {
            this.search();
        }
    },
    mounted () {
        this.$nextTick(() => {
            this.$refs.unsplashSearch.focus();
        });

        this.search();
    },
    methods: {
        search () {
            this.debouncer(() => {
                this.getImagesFromUnsplash();
            });
        },
        getImagesFromUnsplash (page = 1) {
            let unsplashKey = this.$page.wink.supplementals.unsplash_key;
            if (! unsplashKey) {
                return this.alertError('Please configure your Unsplash API Key.');
            }

            this.unsplashPage = page;

            this.searchingUnsplash = true;

            axios.get('https://api.unsplash.com/search/photos?client_id=' + unsplashKey +
                '&orientation=landscape&per_page=19' +
                '&query=' + this.unsplashSearchTerm +
                '&page=' + page
            ).then(response => {
                this.unsplashImages = response.data.results;

                this.searchingUnsplash = false;
            }).catch(error => {
                let errors = error.response.data.errors;

                this.searchingUnsplash = false;
            });
        },

        /**
         * Select an unsplash Image.
         */
        closeUnplashModalAndInsertImage () {
            Hub.$dispatch('imageChanged', {
                url: this.selectedUnsplashImage.urls.regular,
                caption: 'Photo by <a href="' + this.selectedUnsplashImage.user.links.html + '">' + this.selectedUnsplashImage.user.name + '</a> on <a href="https://unsplash.com">Unsplash</a>',
            });

            this.closeUnsplashModal();
        },

        /**
         * Close unsplash modal.
         */
        closeUnsplashModal () {
            this.unsplashSearchTerm = '';
            Hub.$dispatch('closeUnsplash');
            this.selectedUnsplashImage = null;
        },
    },
}
</script>
