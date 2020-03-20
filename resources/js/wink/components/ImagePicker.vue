<template>
    <div>
        <input type="file" class="hidden" :id="'imageUpload'+_uid" accept="image/*" v-on:change="loadSelectedImage">

        <div class="mb-0">
            Please <label :for="'imageUpload'+_uid" class="cursor-pointer underline">upload</label> an image
            <span v-if="$page.wink.supplementals.unsplash_key">or</span>
            <a v-if="$page.wink.supplementals.unsplash_key" href="#" @click.prevent="openUnsplashModal" class="text-text-color underline">search Unsplash</a>
        </div>
        <portal v-if="unsplashModalShown" to="unsplashModal">
            <unsplash-modal />
        </portal>

        <cropper-modal v-if="cropperModalShown"
                       :image="file"
                       :viewport ="{ width: 600, height: 400 }"
                       :boundary="{ width: 600, height: 400 }"
                       @close="closeCropperModal"
                       @cancel="cancelCropperModal"></cropper-modal>
    </div>
</template>

<script>
import Hub from 'Events/hub';
import Preloader from '@/wink/partials/Preloader';
import CropperModal from '@/wink/components/CropperModal';
import UnsplashModal from '@/wink/partials/UnsplashModal';

export default {
    components: {
        Preloader,
        CropperModal,
        UnsplashModal,
    },
    props: [],
    data () {
        return {
            file: null,
            imageUrl: '',
            uploadProgress: 100,
            unsplashModalShown: false,
            cropperModalShown: false,
        }
    },
    created () {
        Hub.$listen('closeUnsplash', () => {
            this.unsplashModalShown = false;
        });
    },
    methods: {
        /**
         * Open unsplash modal.
         */
        openUnsplashModal() {
            this.unsplashModalShown = true;
        },

        /**
         * Load the selected image into the Cropper.
         */
        loadSelectedImage (event){
            this.file = event.target.files[0];

            this.showCropperModal();
        },

        /**
         * Open the cropper modal.
         */
        showCropperModal () {
            this.cropperModalShown = true;
        },

        /**
         * Close the cropper modal.
         */
        closeCropperModal ({image}) {
            this.cropperModalShown = false;
            this.imageUrl = image;
            this.$emit('changed', {url: image, caption: ''});
        },

        /**
         * Close and Cancel the cropper modal.
         */
        cancelCropperModal () {
            this.cropperModalShown = false;
        }
    }
}
</script>
