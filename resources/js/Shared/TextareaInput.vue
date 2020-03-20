<template>
    <div>
        <label v-if="label" class="form-label" :for="id">{{ label }}:</label>
        <textarea :id="id" ref="input" v-bind="$attrs" class="form-textarea" :class="[errorClass, borderClass]" :value="value" :placeholder="placeholder" @input="$emit('input', $event.target.value)" />
        <div v-if="errors.length" class="form-error">{{ errors[0] }}</div>
    </div>
</template>

<script>
import autosize from 'autosize';

export default {
    inheritAttrs: false,
    props: {
        id: {
            type: String,
            default () {
            return `textarea-input-${this._uid}`
            },
        },
        value: String,
        label: String,
        errors: {
            type: Array,
            default: () => [],
        },
        border: {
            type: Boolean,
            default: true,
        },
        autosize: {
            type: Boolean,
            default: false,
        },
        placeholder: {
            type: String,
            default: 'Type here...',
        },
    },
    computed: {
        errorClass () {
            return this.errors.length ? 'error' : '';
        },
        borderClass () {
            return this.border ? '' : 'border-0';
        },
    },
    mounted () {
        if (this.autosize) {
            autosize(this.$refs.input);
        }
    },
    methods: {
        focus () {
            this.$refs.input.focus();
        },
        select () {
            this.$refs.input.select();
        },
    },
}
</script>
