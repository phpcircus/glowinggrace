<template>
    <div class="flex w-full items-center mb-2 px-4 md:px-0">
        <inertia-link v-if="! onIndexPage && ! onNonPostsPage" class="flex items-center px-3 py-2 border border-teal-500 text-teal-500 hover:bg-teal-500 hover:text-white text-base group" :href="route('admin.posts.index')">
            <icon-base width="14" height="14" icon-fill="fill-teal-500" icon-name="back" classes="mr-2 group-hover:fill-white">
                <arrow-left />
            </icon-base>
            Back To Posts
        </inertia-link>
        <div class="ml-auto flex items-center">
            <span v-if="canPublish" class="flex items-center px-3 py-2 text-teal-500 border border-r-0 border-teal-500 hover:bg-teal-500 hover:text-white text-base cursor-pointer group" href="#" @click="publishClicked()">
                <icon-base width="14" height="14" icon-fill="fill-teal-500" icon-name="publish" classes="mr-2 group-hover:fill-white">
                    <newspaper />
                </icon-base>
                Publish
            </span>
            <span v-if="canUnpublish" class="flex items-center px-3 py-2 text-teal-500 border border-r-0 border-teal-500 hover:bg-teal-500 hover:text-white text-base cursor-pointer group" href="#" @click="unpublishClicked()">
                <icon-base width="18" height="18" icon-fill="fill-teal-500" icon-name="unpublish" view="22 22" classes="mr-2 group-hover:fill-white">
                    <close />
                </icon-base>
                Unpublish
            </span>
            <loading-button v-if="currentlyEditingPost" :loading="saving" theme="dark" type="button" class="flex items-center px-3 py-2 text-base cursor-pointer group" :class="saveButtonColors" href="#" @clicked="saveClicked()">
                <icon-base width="14" height="14" icon-name="save" classes="mr-2 group-hover:fill-white" :class="saveIconColors">
                    <save />
                </icon-base>
                Save
            </loading-button>
            <inertia-link v-if="onIndexPage" class="flex items-center px-3 py-2 border border-teal-500 text-teal-500 hover:bg-teal-500 hover:text-white text-base group" :class="rightBorderForNewPost" :href="route('admin.posts.create')">
                <icon-base width="14" height="14" icon-fill="fill-teal-500" icon-name="compose" classes="mr-2 group-hover:fill-white">
                    <compose />
                </icon-base>
                New Post
            </inertia-link>
        </div>
    </div>
</template>

<script>
import ArrowLeft from '@/Shared/Icons/ArrowLeft';
import Close from '@/Shared/Icons/Close';
import Compose from '@/Shared/Icons/Compose';
import Hub from 'Events/hub';
import IconBase from '@/Shared/IconBase';
import LoadingButton from '@/Shared/LoadingButton';
import Newspaper from '@/Shared/Icons/Newspaper';
import Save from '@/Shared/Icons/Save';

export default {
    store: ['workingPost'],
    components: {
        Save,
        Close,
        Compose,
        IconBase,
        Newspaper,
        ArrowLeft,
        LoadingButton,
    },
    data () {
        return {
            saving: false,
        }
    },
    computed: {
        currentlyEditingPost () {
            return this.workingPost.id !== '';
        },
        canPublish () {
            return this.workingPost.id !== '' && this.workingPost.published == false;
        },
        canUnpublish () {
            return this.workingPost.id !== '' && this.workingPost.published == true;
        },
        onIndexPage () {
            return (this.pathEndsWith('posts') || this.pathEndsWith('posts/'));
        },
        onNonPostsPage () {
            if (this.isPath('admin/tshirts') || this.isPath('admin/news')) {
                return true;
            }

            return false;
        },
        rightBorderForNewPost () {
            if(! this.onIndexPage) {
                return 'border-r-0';
            }

            return '';
        },
        saveButtonColors () {
            return `${this.saving ? 'bg-teal-500 text-white border border-teal-500' : 'border border-teal-500 text-teal-500'} hover:bg-teal-500 hover:text-white`;
        },
        saveIconColors () {
            return `${this.saving ? 'fill-white' : 'fill-teal-500'}`;
        },
    },
    created () {
        Hub.$listen('postSaving', () => {
            this.saving = true;
        });
        Hub.$listen('postFinishedSaving', () => {
            setTimeout(() => {
                this.saving = false;
            }, 1000);
        });
    },
    methods: {
        saveClicked () {
            Hub.$dispatch('saveClicked');
        },
        publishClicked () {
            Hub.$dispatch('publishClicked');
        },
        unpublishClicked () {
            Hub.$dispatch('unpublishClicked');
        },
    },
}
</script>
