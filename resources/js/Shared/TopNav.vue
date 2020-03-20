<template>
    <nav :class="backgroundColor">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-0">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center h-full">
                    <div class="flex-shrink-0">
                        <img class="h-8 w-8" src="/img/colorectal_cancer_logo.png" alt="colorectal cancer awareness"></img>
                    </div>
                    <div class="h-full hidden md:block">
                        <div class="h-full ml-10 flex items-baseline">
                            <inertia-link :href="route('home')" class="h-full px-3 py-5 text-sm font-semibold mr-4 uppercase focus:outline-none" :class="linkColors">Home</inertia-link>
                            <a href="https://gofundme.com/help-kimberlyn-fight-cancer" target="_blank" class="h-full px-3 py-5 text-sm font-semibold uppercase focus:outline-none" :class="linkColors">Gofundme</a>
                            <a href="#" class="mega h-full px-3 py-5 text-sm font-semibold uppercase focus:outline-none" :class="linkColors" @click="megaOpen = ! megaOpen">Quick News</a>
                            <portal v-if="megaOpen" to="mega">
                                <quick-news />
                            </portal>
                        </div>
                    </div>
                </div>
                <div class="hidden md:block">
                    <dropdown class="mt-1 md:ml-auto " width="180" top="0" :nav="true">
                        <div slot="trigger" class="flex items-center cursor-pointer select-none group">
                            <div v-if="! $page.wink.author">
                                <div class="flex text-teal-500 focus:text-teal-300 px-4 py-2 mr-1 whitespace-no-wrap cursor-pointer group">
                                    <icon-base icon-function="user" icon-fill="fill-teal-500" classes="text-lg ml-1 mt-1 group-hover:fill-teal-300">
                                        <user />
                                    </icon-base>
                                    <icon-base icon-function="cheveron-down" icon-fill="fill-teal-500" classes="text-lg ml-1 mt-1 group-hover:fill-teal-300">
                                        <cheveron-down />
                                    </icon-base>
                                </div>
                            </div>
                            <div v-else>
                                <button class="max-w-xs flex items-center text-sm rounded-full text-white focus:outline-none focus:shadow-solid">
                                    <img class="h-12 w-12 rounded-full" :src="$page.wink.author.avatar" alt="" />
                                </button>
                            </div>
                        </div>
                        <div slot="dropdown" class="mt-3 shadow-sm bg-gray-200 rounded text-sm">
                            <user-menu />
                        </div>
                    </dropdown>
                </div>
                <div class="menu focus:underline-mr-2 flex md:hidden cursor-pointer" @click="open = ! open">
                    <svg xmlns="http://www.w3.org/2000/svg" class="pointer-events-none" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#718096" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>
                </div>
            </div>
        </div>
        <div v-show="open" class="block md:hidden">
            <div class="pt-2 pb-3 sm:px-3">
                <inertia-link :href="route('home')" class="block px-3 py-2 text-base font-bold text-purple focus:outline-none focus:text-white focus:bg-purple-600 hover:text-white hover:bg-purple-600">Home</inertia-link>
                <a href="https://gofundme.com/help-kimberlyn-fight-cancer" target="_blank" class="block px-3 py-2 text-base font-bold text-purple focus:outline-none focus:text-white focus:bg-purple-600 hover:text-white hover:bg-purple-600">Gofundme</a>
                <a href="#" class="mega block px-3 py-2 text-base font-bold text-purple focus:outline-none focus:text-white focus:bg-purple-600 hover:text-white hover:bg-purple-600" @click="megaOpen = ! megaOpen">Quick News</a>
                <a v-if="! $page.wink.author" class="flex items-center px-3 py-2 text-base font-bold text-purple focus:outline-none focus:text-white focus:bg-purple-600 hover:text-white hover:bg-purple-600 group" :href="route('wink.auth.login')">
                    Login
                </a>
            </div>
            <div v-if="$page.wink.author" class="pt-4 pb-3 border-t border-gray-700">
                <div class="flex items-center px-5">
                    <div class="flex-shrink-0">
                        <img class="h-10 w-10 rounded-full" :src="$page.wink.author.avatar" :alt="$page.wink.author.name" />
                    </div>
                    <div class="ml-3">
                        <div class="text-base font-medium leading-none text-gray-900">{{ $page.wink.author.name }}</div>
                        <div class="mt-1 text-sm font-medium leading-none text-gray-900">{{ $page.wink.author.email }}</div>
                    </div>
                </div>
                <div class="mt-3">
                    <a :href="`/admin/team/${$page.wink.author.id}`" class="block px-3 py-2 text-base font-medium text-gray-900 hover:text-white hover:bg-teal-500 focus:outline-none focus:text-white focus:bg-teal-500">Profile</a>
                    <a :href="route('wink.spa')" class="mt-1 block px-3 py-2 text-base font-medium text-gray-900 hover:text-white hover:bg-teal-500 focus:outline-none focus:text-white focus:bg-teal-500">New Post</a>
                    <a :href="route('wink.auth.login')" class="mt-1 block px-3 py-2 text-base font-medium text-gray-900 hover:text-white hover:bg-teal-500 focus:outline-none focus:text-white focus:bg-teal-500">Logout</a>
                </div>
            </div>
        </div>
    </nav>
</template>

<script>
import Hub from 'Events/hub';
import User from '@/Shared/Icons/User';
import Activities from '@/Shared/Icons/Activities';
import LockClosed from '@/Shared/Icons/LockClosed';
import Dropdown from '@/Shared/Dropdown';
import QuickNews from '@/Shared/QuickNews';
import IconBase from '@/Shared/IconBase';
import UserMenu from '@/Shared/UserMenu';
import CheveronDown from '@/Shared/Icons/CheveronDown';

export default {
    props: {
        backgroundColor: {
            type: String,
            required: true,
        },
    },
    components: {
        User,
        Activities,
        LockClosed,
        Dropdown,
        QuickNews,
        IconBase,
        UserMenu,
        CheveronDown,
    },
    data () {
        return {
            open: false,
            megaOpen: false,
        }
    },
    computed: {
        linkColors () {
            if (this.backgroundColor === 'bg-white') {
                return 'text-purple-600 bg-white focus:text-white focus:bg-purple-600 hover:text-white hover:bg-purple-600';
            }

            return 'text-white bg-teal-500 focus:text-purple-600 focus:bg-white hover:text-purple-600 hover:bg-white';
        },
    },
    created () {
        Hub.$listen('closeAll', (obj) => {
            if (! obj.target.classList.contains('menu') && this.open === true) {
                this.open = false;
            }
            if (! obj.target.classList.contains('mega') && this.megaOpen === true) {
                this.megaOpen = false;
            }
        });
    },
}
</script>
