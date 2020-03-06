<template>
    <div class="flex flex-col py-1">
        <div v-if="$page.wink.author">
            <a class="flex items-center px-3 py-2 hover:bg-teal-400 hover:text-white text-base group" :href="`/admin/team/${$page.wink.author.id}`">
                <icon-base width="14" height="14" icon-fill="fill-gray-800" icon-name="profile" classes="mr-2 group-hover:fill-white">
                    <profile />
                </icon-base>
                My Profile
            </a>
            <a class="flex items-center px-3 py-2 hover:bg-teal-400 hover:text-white text-base group" :href="route('wink.spa')">
                <icon-base width="14" height="14" icon-fill="fill-gray-800" icon-name="users" classes="mr-2 group-hover:fill-white">
                    <users />
                </icon-base>
                New Post
            </a>
            <a class="flex items-center px-3 py-2 hover:bg-teal-400 hover:text-white text-base group" :href="route('wink.logout')">
                <icon-base width="14" height="14" icon-fill="fill-gray-800" icon-name="logout" classes="mr-2 group-hover:fill-white">
                    <logout />
                </icon-base>
                Logout
            </a>
        </div>
        <a v-else class="flex items-center px-3 py-2 hover:bg-teal-400 hover:text-white text-base group" :href="route('wink.auth.login')">
            <icon-base width="14" height="14" icon-fill="fill-gray-800" icon-name="login" classes="mr-2 group-hover:fill-white">
                <lock-closed />
            </icon-base>
            Login
        </a>
    </div>
</template>

<script>
import IconBase from '@/Shared/IconBase';
import Users from '@/Shared/Icons/Users';
import Logout from '@/Shared/Icons/Logout';
import LockClosed from '@/Shared/Icons/LockClosed';
import Profile from '@/Shared/Icons/Profile';

export default {
    components: {
        Users,
        Logout,
        Profile,
        IconBase,
        LockClosed,
    },
}
</script>
