<template>
    <layout title="News">
        <admin-sub-layout>
            <div class="flex flex-col bg-white shadow-md container mx-auto max-w-7xl">
                <div class="p-6">
                    <form @submit.prevent="submit">
                        <div class="flex flex-col">
                            <text-input v-model="news.title" :errors="getErrors('title')" class="mb-12 w-full h-8 text-3xl" height="64" :border="false" placeholder="Enter a news headline..." />
                            <textarea-input v-model="news.body" :errors="getErrors('body')" rows="8" class="pb-8 w-full" :border="false" placeholder="Start typing your news here..." />
                        </div>
                        <div class="flex items-center pt-4">
                            <loading-button :loading="sending" class="btn btn-blue" type="submit">Create News Item</loading-button>
                        </div>
                    </form>
                </div>
            </div>
        </admin-sub-layout>
    </layout>
</template>

<script>
import AdminSubLayout from '@/Shared/AdminSubLayout';
import IconBase from '@/Shared/IconBase';
import Layout from '@/Shared/Layout';
import LoadingButton from '@/Shared/LoadingButton';
import TextInput from '@/Shared/TextInput';
import TextareaInput from '@/Shared/TextareaInput';

export default {
    components: {
        Layout,
        IconBase,
        TextInput,
        TextareaInput,
        LoadingButton,
        AdminSubLayout,
    },
    data () {
        return {
            sending: false,
            news: {
                title: 'News Headline',
                body: null,
            },
        }
    },
    methods: {
        submit () {
            this.sending = true;

            this.$inertia.post(this.route('admin.news.store'), this.news).then( () => {
                this.sending = false;
            });
        },
    },
}
</script>
