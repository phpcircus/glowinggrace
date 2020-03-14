<template>
    <layout title="News">
        <div class="border-sides flex flex-col bg-purple-400 shadow-md container mx-auto -mt-16 max-w-7xl">
            <div class="p-6 border-t-4 border-white">
                <div class="text-center">
                    <p class="text-3xl text-white font-bold uppercase mb-4 pb-4 border-b border-teal-200">Quick News</p>
                    <h1 class="font-bold break-normal text-2xl text-gray-800 md:text-4xl">{{ news.title }}</h1>
                </div>
                <form @submit.prevent="submit">
                    <div class="flex flex-col pt-4">
                        <text-input v-model="news.title" :errors="getErrors('title')" class="mb-6 w-full md:w-1/2" label="Headline" />
                        <textarea-input v-model="news.body" :errors="getErrors('body')" rows="8" class="pb-8 w-full md:w-1/2" label="Body" />
                    </div>
                    <div class="border-t border-teal-200 flex items-center pt-4">
                        <loading-button :loading="sending" class="btn btn-blue" type="submit">Create News Item</loading-button>
                    </div>
                </form>
            </div>
        </div>
    </layout>
</template>

<script>
import Layout from '@/Shared/Layout';
import IconBase from '@/Shared/IconBase';
import TextInput from '@/Shared/TextInput';
import TextareaInput from '@/Shared/TextareaInput';
import LoadingButton from '@/Shared/LoadingButton';

export default {
    components: {
        Layout,
        IconBase,
        TextInput,
        TextareaInput,
        LoadingButton,
    },
    data () {
        return {
            sending: false,
            news: {
                title: null,
                body: null,
            },
        }
    },
    methods: {
        submit () {
            this.sending = true;

            this.$inertia.post(this.route('news.store'), this.news).then( () => {
                this.sending = false;
            });
        },
    },
}
</script>
