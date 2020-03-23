<template>
    <layout title="New Post">
        <portal v-if="isPath('admin')" to="adminTopNav">
            <admin-top-nav />
        </portal>
        <div class="w-full bg-white pt-4">
            <div class="flex flex-col max-w-7xl px-8">
                <div class="flex w-full">
                    <div v-if="! isEmpty(errors)" class="flex flex-col w-500p rounded bg-red-300 p-4 mt-2 mb-4">
                        <span v-for="(value, name) in errors" :key="name" class="text-red-800 text-sm font-semibold">
                            {{ value[0] }}
                        </span>
                    </div>
                    <div class="flex items-center ml-auto">
                        <span class="flex items-center px-3 py-2 text-base cursor-pointer group" href="#" @click="settingsModal()">
                            <icon-base width="18" height="18" icon-fill="fill-teal-500" icon-name="settings" classes="mr-2 group-hover:fill-teal-300">
                                <cog />
                            </icon-base>
                        </span>
                        <span class="flex items-center px-3 py-2 ml-auto text-base cursor-pointer group" href="#" @click="seoModal()">
                            <icon-base width="18" height="18" view="20 20" icon-fill="fill-teal-500" icon-name="seo" classes="mr-2 group-hover:fill-teal-300">
                                <search />
                            </icon-base>
                        </span>
                    </div>
                </div>
                <h2 v-if="ready && ! entry" class="text-center font-normal">
                    404 — Post not found
                </h2>

                <div v-if="ready && entry" class="flex flex-col w-full p-6">
                    <textarea-autosize v-model="form.title" placeholder="Give your post a title..." class="text-3xl w-full focus:outline-none mb-10" />

                    <editor v-model="form.body" :post-id="id" />
                </div>
            </div>

            <!-- General Settings Modal -->
            <modal v-if="settingsModalShown" @close="closeSettingsModal">
                <div class="input-group pt-0">
                    <label for="slug" class="input-label">Slug</label>
                    <input id="slug" v-model="form.slug" type="text" class="input" placeholder="Give me a slug">
                </div>

                <div class="input-group">
                    <label for="author_id" class="input-label">Author</label>
                    <select id="author_id" v-model="form.author_id" name="author_id" class="input">
                        <option v-for="author in $page.wink.authors" :key="author.id" :value="author.id">{{ author.name }}</option>
                    </select>
                </div>

                <div class="input-group">
                    <label for="tag_ids" class="input-label mb-4">Tags</label>
                    <multi-select v-model="form.tags" :options="$page.wink.tags" option-id="id" option-text="name" />
                </div>

                <div class="input-group">
                    <label for="excerpt" class="input-label">Excerpt</label>
                    <textarea id="excerpt" v-model="form.excerpt" rows="10" class="input" placeholder="What's this post about?" />
                </div>

                <div class="mt-10">
                    <button class="btn-sm btn-primary" @click="closeSettingsModal">Done</button>
                </div>
            </modal>

            <!-- Publishing Modal -->
            <modal v-if="publishingModalShown" @close="publishingModalShown = false">
                <div v-if="form.title == 'Post Title' || !form.slug || form.slug.startsWith('draft-')" class="mb-10 text-red">
                    Make sure your post has a friendly title and slug.
                </div>

                <div class="input-group pt-0">
                    <label class="input-label">Publish Date (M/D/Y H:M) UTC</label>
                    <date-time-picker v-model="form.publish_date" />
                    <form-errors :errors="errors.publish_date" />
                </div>

                <div class="mt-10">
                    <button v-if="! form.published" v-loading="status" class="btn-sm btn-primary" @click="publishPost">Publish this post</button>
                    <button v-if="form.published" v-loading="status" class="btn-sm btn-primary" @click="publishPost">Update Post</button>
                    <button v-if="form.published" v-loading="status" class="btn-sm ml-1 btn-light" @click="unpublishPost">Convert to draft</button>
                    <button class="btn-sm ml-1 btn-light" @click="publishingModalShown = false">Cancel</button>
                </div>
            </modal>

            <!-- SEO & Social Modal -->
            <seo-modal v-if="seoModalShown" :input="form.meta" @close="closeSeoModal" />

            <!-- Featured Image Modal -->
            <featured-image-uploader :post-id="form.id" :current-image-url="form.featured_image" :current-caption="form.featured_image_caption" @changed="featuredImageChanged" />
        </div>
    </layout>
</template>

<script>
import AdminTopNav from '@/Shared/AdminTopNav';
import axios from 'axios';
import Cog from '@/Shared/Icons/Cog';
import Editor from '@/wink/components/Editor';
import FeaturedImageUploader from './FeaturedImageUploader';
import FormErrors from '@/wink/components/FormErrors';
import Hub from 'Events/hub';
import IconBase from '@/Shared/IconBase';
import Layout from '@/Shared/Layout';
import Modal from '@/wink/components/Modal';
import MultiSelect from '@/wink/components/MultiSelect';
import Search from '@/Shared/Icons/Search';
import SeoModal from '@/wink/components/SEOModal';

export default {
    components: {
        Cog,
        Modal,
        Search,
        Layout,
        Editor,
        IconBase,
        SeoModal,
        FormErrors,
        AdminTopNav,
        MultiSelect,
        'featured-image-uploader': FeaturedImageUploader,
    },
    props: {
        id: {
            type: [Number, String],
            default: () => 'new',
        },
        entry: {
            type: [Object, Array],
            default: () => ({}),
        },
    },
    data () {
        return {
            ready: false,
            status: '',
            settingsModalShown: false,
            publishingModalShown: false,
            seoModalShown: false,
            errors: [],
            postBodyWatcher: null,
            form: {
                id: '',
                title: 'Post Title',
                slug: '',
                excerpt: 'New post.',
                tags: [],
                author_id: '',
                featured_image: '',
                featured_image_caption: '',
                body: '',
                published: false,
                publish_date: '',
                meta: {
                    meta_description: '',
                    opengraph_title: '',
                    opengraph_description: '',
                    opengraph_image: '',
                    opengraph_image_width: '',
                    opengraph_image_height: '',
                    twitter_title: '',
                    twitter_description: '',
                    twitter_image: '',
                },
            },
        };
    },
    watch: {
        'form.slug'(val) {
            this.debouncer(() => {
                this.form.slug = this.slugify(val);
            });
        },
        'form.featured_image'() {
            this.save();
        },
        'form.published'(val) {
            if (this.postBodyWatcher) {
                this.postBodyWatcher();
            }

            if (! val) {
                this.watchBodyChangesAndSave();
            }
        },
    },
    created () {
        Hub.$listen('saveClicked', () => this.save());
        Hub.$listen('publishClicked', () => this.publishPost());
        Hub.$listen('unpublishClicked', () => this.unpublishPost());
    },
    mounted () {
        this.loadResources();
        if (! this.isEmpty(this.entry)) {
            this.fillForm(this.entry);
        }

        this.ready = true;
    },
    destroyed () {
        this.resetWorkingPost();
    },
    methods: {
        fillForm (data) {
            this.form.id = data.id;
            this.form.publish_date = data.publish_date;
            this.form.slug = 'draft-' + this.form.id;

            if (this.id != 'new') {
                this.form.title = data.title;
                this.form.slug = data.slug;
                this.form.excerpt = data.excerpt;
                this.form.body = data.body;
                this.form.published = data.published;
                this.form.tags = data.tags || null;
                this.form.author_id = data.author_id || null;
                this.form.featured_image = data.featured_image;
                this.form.featured_image_caption = data.featured_image_caption;
                this.form.meta = {
                    meta_description: data.meta.meta_description || '',
                    opengraph_title: data.meta.opengraph_title || '',
                    opengraph_description: data.meta.opengraph_description || '',
                    opengraph_image: data.meta.opengraph_image || '',
                    opengraph_image_width: data.meta.opengraph_image_width || '',
                    opengraph_image_height: data.meta.opengraph_image_height || '',
                    twitter_title: data.meta.twitter_title || '',
                    twitter_description: data.meta.twitter_description || '',
                    twitter_image: data.meta.twitter_image || '',
                };
            }
            this.$store.workingPost = this.form;
            if (! this.form.published) {
                this.watchBodyChangesAndSave();
            }
        },
        watchBodyChangesAndSave () {
            setTimeout(() => {
                this.postBodyWatcher = this.$watch('form.body', _.debounce(() => this.save(), 1000), {deep: true});
            }, 1000);
        },
        loadResources () {
            this.author = this.entry.author;

            if (! this.form.author_id && this.$page.wink.authors) {
                this.form.author_id = this.$page.wink.author.id;
            }
        },
        updatePostBody (data) {
            this.form.body = data.body;
        },
        updateTitle (val) {
            this.form.title = val;
        },
        settingsModal () {
            this.settingsModalShown = true;
        },
        closeSettingsModal () {
            this.settingsModalShown = false;

            this.save();
        },
        seoModal () {
            this.seoModalShown = true;
        },
        closeSeoModal () {
            this.seoModalShown = false;

            this.save();
        },
        publishingModal () {
            this.publishingModalShown = true;
        },
        featuredImageModal () {
            Hub.$dispatch('openingFeaturedImageUploader');
        },
        featuredImageChanged ({url, caption}) {
            this.form.featured_image = url;
            this.form.featured_image_caption = caption;
        },
        deletePost () {
            console.log('delete post');
            this.resetWorkingPost();
            // this.alertConfirm("Are you sure you want to delete this post?", () => {
            //     this.settingsModalShown = false;

            //     this.http().delete('/api/posts/' + this.id, this.form).then(response => {
            //         this.$router.push({name: 'posts'})
            //     })
            // });
        },
        publishPost () {
            this.form.published = true;
            this.save();
            // this.publishingModalShown = false;
            // this.notifySuccess('Post Published!', 2000);
        },
        unpublishPost () {
            console.log('unpublish post');
            this.form.published = false;
            this.save();
            // this.publishingModalShown = false;
            // this.notifySuccess('Post was converted to a draft!', 2000);
        },
        save () {
            if (this.status) return;
            Hub.$dispatch('postSaving');
            this.errors = [];
            this.status = 'Saving...';

            if (this.form.title != 'Post Title' && (! this.form.slug || this.form.slug.startsWith('draft-'))) {
                this.form.slug = this.slugify(this.form.title);
            }

            axios.post(`/api/admin/posts?id=${this.id}`, { form: this.form }).then(response => {
                if (this.id == 'new') {
                    this.$inertia.visit(this.route('admin.posts.edit', this.form.id), { preserveState: true });
                }
                this.$page.wink_success.message = response.data.status;
                this.status = ''
                Hub.$dispatch('postFinishedSaving');
            }).catch(error => {
                this.errors = error.response.data.errors;
                this.status = '';
                Hub.$dispatch('postFinishedSaving');
            });
        },
        resetWorkingPost () {
            this.$store.workingPost = {
                title: '',
                body: '',
                publish_date: null,
                excerpt: '',
                tags: [],
                author_id: '',
                featured_image: null,
                featured_image_caption: '',
                id: '',
                meta: {},
                published: false,
                slug: '',
            };
        },
    }
}
</script>
