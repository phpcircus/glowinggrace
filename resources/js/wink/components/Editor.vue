<template>
    <div style="position: relative">
        <div id="sidebar-controls" class="flex items-center">
            <button id="show-controls" class="inline-block align-middle rounded-full w-8 h-8 border border-light text-light hover:bg-light hover:text-contrast text-center" @click="showSideControls">+</button>

            <div class="inline-block align-middle controls hidden pl-4 bg-contrast">
                <button class="w-8 h-8 pl-2 pt-1" @click="openImageUploader()">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="fill-current w-3">
                        <path d="M0 4c0-1.1.9-2 2-2h16a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm11 9l-3-3-6 6h16l-5-5-2 2zm4-4a2 2 0 1 0 0-4 2 2 0 0 0 0 4z" />
                    </svg>
                </button>
                <button class="w-8 h-8 pl-2 pt-1" @click="$emit('openingHTMLEmbedder')">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="fill-current w-3">
                        <path d="M.7 9.3l4.8-4.8 1.4 1.42L2.84 10l4.07 4.07-1.41 1.42L0 10l.7-.7zm18.6 1.4l.7-.7-5.49-5.49-1.4 1.42L17.16 10l-4.07 4.07 1.41 1.42 4.78-4.78z" />
                    </svg>
                </button>
                <button class="w-8 h-8 pl-2 pt-1" @click="addDivider">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="fill-current w-3">
                        <path d="M4 12a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm6 0a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm6 0a2 2 0 1 1 0-4 2 2 0 0 1 0 4z" />
                    </svg>
                </button>
            </div>
        </div>

        <div ref="editor" />

        <image-uploader post-id="postId" @updated="applyImage" />
        <html-embedder post-id="postId" @adding="addHTML" />
    </div>
</template>

<script>
import DividerBlot from '@/wink/components/editorComponents/DividerBlot';
import HTMLBlot from '@/wink/components/editorComponents/HTMLBlot';
import HTMLEmbedder from '@/wink/components/editorComponents/HTMLEmbedder';
import Hub from 'Events/hub';
import ImageBlot from '@/wink/components/editorComponents/ImageBlot';
import ImageUploader from '@/wink/components/editorComponents/ImageUploader';
import Parchment from 'parchment';
import Quill from 'quill';

export default {
    components: {
        'image-uploader': ImageUploader,
        'html-embedder': HTMLEmbedder,
    },
    props: {
        value: {
            type: String,
            default: '',
        },

        postId: {
            type: String,
        }
    },
    data (){
        return {
            editor: null,
            editorBody: this.body
        }
    },
    mounted () {
        this.editor = this.createEditor();
        this.handleEditorValue();
        this.handleClicksInsideEditor();
        this.initSideControls();
    },
    methods: {
        /**
         * Create an instance of the editor.
         */
        createEditor () {
            Quill.register(ImageBlot, true);
            Quill.register(DividerBlot, true);
            Quill.register(HTMLBlot, true);

            const icons = Quill.import('ui/icons');
            icons.header[3] = require('!html-loader!quill/assets/icons/header-3.svg');

            return new Quill(this.$refs.editor, {
                modules: {
                    syntax: true,
                    toolbar: [
                        ['bold', 'italic', 'underline', 'strike', 'code'],
                        [{'header': '2'}, {'header': '3'}],
                        [{'list': 'ordered'}, {'list': 'bullet'}, 'link'],
                        ['blockquote', 'code-block'],
                    ],
                },
                theme: 'bubble',
                scrollingContainer: 'html, body',
                placeholder: 'Starting writing now...',
            });
        },
        handleEditorValue () {
            this.editor.root.innerHTML = this.value;

            this.editor.on('text-change', () => {
                this.$emit('input', this.editor.getText() ? this.editor.root.innerHTML : '');
            });
        },
        handleClicksInsideEditor () {
            this.editor.root.addEventListener('click', (ev) => {
                let blot = Parchment.find(ev.target, true);

                if (blot instanceof ImageBlot) {
                    var values = blot.value(blot.domNode)['captioned-image'];
                    values.existingBlot = blot;
                    this.openImageUploader(values);
                }
            });
        },
        initSideControls () {
            let Block = Quill.import('blots/block');

            this.editor.on(Quill.events.EDITOR_CHANGE, (eventType, range) => {
                let sidebarControls = document.getElementById('sidebar-controls');

                if (eventType !== Quill.events.SELECTION_CHANGE) return;

                if (range == null) return;

                if (range.length === 0) {
                    let [block, offset] = this.editor.scroll.descendant(Block, range.index);

                    if (block != null && block.domNode.firstChild instanceof HTMLBRElement) {
                        let lineBounds = this.editor.getBounds(range);
                        sidebarControls.classList.remove('active');
                        sidebarControls.style.display = 'block';
                        sidebarControls.style.left = (lineBounds.left - 50) + 'px';
                        sidebarControls.style.top = (lineBounds.top - 2) + 'px';
                    } else {
                        sidebarControls.style.display = 'none';

                        sidebarControls.classList.remove('active');
                    }
                } else {
                    sidebarControls.style.display = 'none';
                    sidebarControls.classList.remove('active');
                }
            });
        },
        showSideControls () {
            document.getElementById('sidebar-controls').classList.toggle('active');
            this.editor.focus();
        },
        openImageUploader (data = null) {
            Hub.$dispatch('openingImageUploader', data);
        },
        applyImage ({url, caption, existingBlot, layout}) {
            let values = {
                url: url,
                caption: caption,
                layout: layout,
            };

            if (existingBlot) {
                return existingBlot.replaceWith('captioned-image', values);
            }

            let range = this.editor.getSelection(true);

            this.editor.insertEmbed(range.index, 'captioned-image', values, Quill.sources.USER);

            this.editor.setSelection(range.index + 1, Quill.sources.SILENT);
        },
        addDivider () {
            let range = this.editor.getSelection(true);

            this.editor.insertText(range.index, '\n', Quill.sources.USER);
            this.editor.insertEmbed(range.index + 1, 'divider', true, Quill.sources.USER);
            this.editor.setSelection(range.index + 2, Quill.sources.SILENT);
        },
        addHTML ({content}) {
            let range = this.editor.getSelection(true);

            this.editor.insertEmbed(range.index, 'html', {
                content: content,
            }, Quill.sources.USER);

            this.editor.setSelection(range.index + 1, Quill.sources.SILENT);
        },
    }
}
</script>
