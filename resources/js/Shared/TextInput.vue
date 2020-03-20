<template>
    <div>
        <label v-if="label" class="form-label" :for="id">{{ label }}:</label>
        <input v-if="mask" :id="id" ref="input" v-mask="'#'" v-bind="$attrs" :step="step" class="form-input" :class="[errorClass, borderClass]" :style="heightStyle" :type="type" :value="value" :placeholder="placeholder" @input="$emit('input', $event.target.value)">
        <input v-else :id="id" ref="input" v-bind="$attrs" :step="step" class="form-input" :class="[errorClass, borderClass]" :style="heightStyle" :type="type" :value="value" :placeholder="placeholder" @input="$emit('input', $event.target.value)">
        <div v-if="errors.length" class="form-error">{{ errors[0] }}</div>
    </div>
</template>

<script>
import { mask } from 'vue-the-mask';

export default {
    directives: { mask },
    inheritAttrs: false,
    props: {
        id: {
            type: String,
            default () {
                return `text-input-${this._uid}`;
            },
        },
        type: {
            type: String,
            default: 'text',
        },
        value: [String, Number],
        label: String,
        placeholder: {
            type: String,
            default: 'Enter a value...',
        },
        mask: {
            type: Boolean,
            default: false,
        },
        errors: {
            type: Array,
            default: () => [],
        },
        step: {
            type: Number,
            default: () => 1,
        },
        height: {
            type: String,
            default: '42',
        },
        border: {
            type: Boolean,
            default: true,
        },
    },
    computed: {
        heightStyle () {
            return `height: ${this.height}px;`
        },
        errorClass () {
            return this.errors.length ? 'error' : '';
        },
        borderClass () {
            return this.border ? '' : 'border-0';
        },
    },
    methods: {
        focus () {
            this.$refs.input.focus();
        },
        select () {
            this.$refs.input.select();
        },
        setSelectionRange (start, end) {
            this.$refs.input.setSelectionRange(start, end);
        },
    },
}
</script>
