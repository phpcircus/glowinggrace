<script>
export default {
    data () {
        return {}
    },
    created () {
        document.body.classList.add('overflow-hidden');
    },
    destroyed () {
        document.body.classList.remove('overflow-hidden');
    },
}
</script>

<template>
    <transition name="modal">
            <slot/>
    </transition>
</template>
