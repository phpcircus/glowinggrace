<template>
    <div class="flex flex-col py-1">
        <inertia-link v-if="$page.auth.user" class="flex items-center px-3 py-2 hover:bg-teal-400 hover:text-white text-base group" :href="route('users.edit', $page.auth.user.id)">
            <icon-base width="14" height="14" icon-fill="fill-gray-800" icon-name="profile" classes="mr-2 group-hover:fill-white">
                <profile />
            </icon-base>
            My Profile
        </inertia-link>
        <div v-if="$page.auth.user && $page.auth.user.is_admin">
            <a class="flex items-center px-3 py-2 hover:bg-teal-400 hover:text-white text-base group" :href="route('wink.spa')">
                <icon-base width="14" height="14" icon-fill="fill-gray-800" icon-name="users" classes="mr-2 group-hover:fill-white">
                    <users />
                </icon-base>
                New Post
            </a>
        </div>
        <inertia-link v-if="$page.auth.user" class="flex items-center px-3 py-2 hover:bg-teal-400 hover:text-white text-base group" :href="route('logout')" method="post">
            <icon-base width="14" height="14" icon-fill="fill-gray-800" icon-name="logout" classes="mr-2 group-hover:fill-white">
                <logout />
            </icon-base>
            Logout
        </inertia-link>
        <inertia-link v-else class="flex items-center px-3 py-2 hover:bg-teal-400 hover:text-white text-base group" :href="route('login.form')">
            <icon-base width="14" height="14" icon-fill="fill-gray-800" icon-name="login" classes="mr-2 group-hover:fill-white">
                <lock-closed />
            </icon-base>
            Login
        </inertia-link>
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
