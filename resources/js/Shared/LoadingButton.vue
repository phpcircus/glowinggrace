<template>
    <button :disabled="loading" class="flex items-center" :type="type" v-on="listeners">
        <div v-if="loading" class="spinner mr-2" />
        <slot />
    </button>
</template>

<script>
import Hub from 'Events/hub';

export default {
    props: {
        loading: Boolean,
        type: {
            type: String,
            default: 'submit',
        },
        theme: {
            type: String,
            default: 'light',
        },
    },
    computed: {
        listeners () {
            if (this.type === 'button') {
                return { click: this.buttonClicked }
            }

            return null;
        },
    },
    methods: {
        buttonClicked () {
            this.$emit('clicked');
        },
    },
}
</script>
