<template>
    <div>
        <modal />
        <flash-message />

    <!--Header-->
    <div class="relative w-full m-0 pb-16 pt-8 md:pt-12 md:pb-24 bg-teal-500">
            <div class="absolute top-0 right-0">
                <dropdown class="text-right" width="180" :nav="true">
                    <div slot="trigger" class="flex items-center cursor-pointer select-none">
                        <div class="flex text-white focus:text-teal-200 px-4 py-2 mr-1 whitespace-no-wrap group">
                            <icon-base icon-function="user" icon-fill="fill-white" classes="text-lg ml-1 mt-1 group-hover:fill-teal-200">
                                <user />
                            </icon-base>
                            <icon-base icon-function="cheveron-down" icon-fill="fill-white" classes="text-lg ml-1 mt-1 group-hover:fill-teal-200">
                                <cheveron-down />
                            </icon-base>
                        </div>
                    </div>
                    <div slot="dropdown" class="shadow-lg bg-white rounded text-sm">
                        <user-menu />
                    </div>
                </dropdown>
            </div>
            <div class="hidden md:inline-block absolute top-80 xl:top-110 left-0">
                <div class="transform -rotate-30">
                    <img class="inline-block align-middle h-40p w-auto mr-4" src="/img/colorectal_cancer_logo.png" />
                    <h1 class="inline-block align-middle text-center text-3xl xl:text-5xl text-white font-damion leading-none opacity-50">
                        Kicking cancer's butt <br />since 01/24/2020
                    </h1>
                </div>
            </div>
            <div class="flex flex-col container max-w-7xl mx-auto text-center items-center break-normal">
                    <!--Title-->
                    <div class="ml-0">
                        <inertia-link :href="route('posts.home')" class="cursor-pointer">
                            <logo position="center" />
                        </inertia-link>
                        <p class="text-xl md:text-2xl text-teal-100 mb-4 uppercase">Welcome to my Journey</p>
                        <img src="/img/signature.png" class="w-200p mx-auto h-auto"/>
                        <div class="block md:hidden mt-4 -ml-10">
                            <img class="inline-block align-middle h-40p w-auto mr-4" src="/img/colorectal_cancer_logo.png" />
                            <h1 class="inline-block align-middle text-center text-xl text-teal-200 font-sigmar leading-none">
                                Kicking cancer's butt <br />since 01/24/2020
                            </h1>
                        </div>
                    </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex container mx-auto max-w-7xl py-8 relative">
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
