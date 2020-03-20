<template>
    <div class="w-full mt-8 border-b border-gray-400">
        <admin-top-nav />
        <slot />
    </div>
</template>

<script>
import AdminTopNav from '@/Shared/AdminTopNav';

export default {
    components: {
        AdminTopNav,
    },
}
</script>
