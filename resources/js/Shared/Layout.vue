<template>
    <div>
        <modal />
        <flash-message />
        <tailwind-nav />

    <!--Header-->
    <div class="relative w-full m-0 py-8 bg-teal-500">
            <div class="flex flex-col container max-w-7xl mx-auto text-center items-center break-normal">
                    <!--Title-->
                    <div class="ml-0">
                        <inertia-link :href="route('posts.home')" class="cursor-pointer">
                            <logo position="center" />
                        </inertia-link>
                        <p class="text-xl md:text-2xl text-teal-100 mb-4 uppercase">Welcome to my Journey</p>
                        <img src="/img/signature.png" class="w-200p mx-auto h-auto"/>
                        <div class="block mt-4 -ml-10">
                            <h1 class="inline-block align-middle text-center text-xl text-teal-200 font-sigmar leading-none">
                                Kicking cancer's butt <br />since 01/24/2020
                            </h1>
                        </div>
                    </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex container mx-auto max-w-7xl py-8 relative min-h-50">
            <slot />
        </div>

        <!-- Site Footer -->
        <site-footer />
    </div>
</template>

<script>
import Logo from '@/Shared/Logo';
import Modal from '@/Shared/Modal';
import User from '@/Shared/Icons/User';
import Dropdown from '@/Shared/Dropdown';
import IconBase from '@/Shared/IconBase';
import MainMenu from '@/Shared/MainMenu';
import UserMenu from '@/Shared/UserMenu';
import SiteFooter from '@/Shared/SiteFooter';
import Breadcrumbs from '@/Shared/Breadcrumbs';
import TailwindNav from '@/Shared/TailwindNav';
import FlashMessage from '@/Shared/FlashMessage';
import LockClosed from '@/Shared/Icons/LockClosed';
import CheveronDown from '@/Shared/Icons/CheveronDown';

export default {
    components: {
        Logo,
        User,
        Modal,
        IconBase,
        UserMenu,
        MainMenu,
        Dropdown,
        SiteFooter,
        LockClosed,
        Breadcrumbs,
        TailwindNav,
        FlashMessage,
        CheveronDown,
    },
    props: {
        title: String,
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
