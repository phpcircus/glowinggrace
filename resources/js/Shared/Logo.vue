<template>
    <div class="w-full" :class="logoPosition">
        <h1 class="font-sigmar inline-block font-bold text-3xl md:text-5xl text-purple-700 site-title leading-none">Glowing<span class="font-medium text-teal-100">GRACE</span></h1>
    </div>
</template>

<script>
export default {
    props: {
        position: {
            type: String,
            default: 'center',
        },
    },
    computed: {
        logoPosition () {
            if (this.position === 'left') {
                return 'text-left';
            } else if (this.position === 'center') {
                return 'text-center mx-auto';
            } else {
                return 'text-right';
            }
        },
    },
}
</script>
