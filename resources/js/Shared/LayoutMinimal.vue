<template>
    <div>
        <modal />
        <flash-message />

    <!--Header-->
    <div class="relative w-full m-0 py-8 bg-teal-500">
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
            <div class="relative flex flex-col container max-w-7xl mx-auto text-center items-center break-normal">
                <!--Title-->
                    <inertia-link :href="route('posts.home')" class="cursor-pointer">
                        <logo position="center" />
                    </inertia-link>
                    <p class="text-xl md:text-2xl text-teal-100 mb-4 uppercase">Welcome to my Journey</p>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex container mx-auto w-3/4 py-8 relative">
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
