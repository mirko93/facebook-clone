<template>
    <div>
        <img class="object-cover w-full"
             :src="imageObject.data.attributes.path"
             alt="user background cover image"
             ref="userImage">
    </div>
</template>

<script>
import Dropzone from 'dropzone';

export default {
    name: "UploadableImage",

    props: [
        'userImage',
        'imageWidth',
        'imageHeight',
        'location',
    ],

    data: () => {
        return {
            dropzone: null,
            uploadedImage: null,
        }
    },

    mounted() {
        this.dropzone = new Dropzone(this.$refs.userImage, this.settings);
    },

    computed: {
        settings() {
            return {
                paramName: 'image',
                url: '/api/user-images',
                acceptedFiles: 'image/*',
                params: {
                    'width': this.imageWidth,
                    'height': this.imageHeight,
                    'location': this.location,
                },
                headers: {
                    'X-CSRF-TOKEN': document.head.querySelector('meta[name=csrf-token]').content,
                },
                success: (e, res) => {
                    this.uploadedImage = res;
                }
            };
        },
        imageObject() {
            return this.uploadedImage || this.userImage;
        }
    }
}
</script>

<style scoped>

</style>
