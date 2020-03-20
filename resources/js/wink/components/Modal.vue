<template>
    <transition name="modal">
        <div class="z-50 w-full h-screen fixed top-0 pt-12 left-0 modal-mask overflow-y-scroll" @click="handleClicks">
            <div class="bg-contrast rounded shadow-lg max-w-md mx-auto my-10 p-5 modal-container">
                <slot />
            </div>
        </div>
    </transition>
</template>

<script>
export default {
    created () {
        document.addEventListener('keydown', this.handleEscape);
        document.body.classList.add('overflow-hidden');
    },
    destroyed () {
        document.removeEventListener('keydown', this.handleEscape);
        document.body.classList.remove('overflow-hidden');
    },
    methods: {
        handleEscape (e) {
            e.stopPropagation();

            if (e.keyCode == 27) {
                this.close();
            }
        },
        close () {
            this.$emit('close');
        },
        handleClicks (e) {
            if (e.target.classList.contains('modal-mask')) {
                this.close();
            }
        },
    },
}
</script>
