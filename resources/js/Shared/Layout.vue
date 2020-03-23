<template>
    <div class="w-full relative">
        <modal />
        <flash-message />
        <portal-target name="unsplashModal" class="absolute w-full" style="z-index: 60;" />
        <top-nav :background-color="getTopNavBackground()" />
        <portal-target name="mega" class="absolute w-full z-10" />

        <!--Header-->
        <div v-if="! isAdminPage()" class="relative w-full m-0 pt-8 pb-12 bg-teal-500">
            <div class="flex flex-col container max-w-7xl mx-auto text-center items-center break-normal">
                <!--Title-->
                <div class="ml-0">
                    <inertia-link :href="route('posts.home')" class="cursor-pointer">
                        <logo position="center" />
                    </inertia-link>
                    <p class="text-xl md:text-2xl text-teal-100 mb-4 uppercase">Welcome to my Journey</p>
                    <img src="/img/signature.png" class="w-200p mx-auto h-auto">
                    <div class="block mt-4">
                        <h1 class="inline-block align-middle text-center text-xl text-teal-200 font-sigmar leading-none">
                            Kicking cancer's butt <br>since 01/24/2020
                        </h1>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex flex-col container mx-auto max-w-7xl py-8 relative min-h-50">
            <portal-target name="adminTopNav" />
            <slot />
        </div>

        <!-- Site Footer -->
        <site-footer />
    </div>
</template>

<script>
import Hub from 'Events/hub';
import Logo from '@/Shared/Logo';
import Modal from '@/Shared/Modal';
import SiteFooter from '@/Shared/SiteFooter';
import TopNav from '@/Shared/TopNav';
import FlashMessage from '@/Shared/FlashMessage';

export default {
    components: {
        Logo,
        Modal,
        SiteFooter,
        TopNav,
        FlashMessage,
    },
    props: {
        title: String,
    },
    created () {
        window.document.addEventListener('click', this.onWindowClick);
    },
    beforeDestroy () {
        window.removeEventListener('click', this.onWindowClick);
    },
    methods: {
        onWindowClick (event) {
            Hub.$dispatch('closeAll', { target: event.target });
        },
        isAdminPage () {
            return this.isPath('admin') ? true : false;
        },
        getTopNavBackground () {
            return this.isAdminPage() ? 'bg-teal-500' : 'bg-white';
        },
    },
    head: {
        title: function () {
            return {
                inner: this.title,
            }
        },
    },
}
</script>
