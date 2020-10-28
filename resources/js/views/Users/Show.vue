<template>
    <div class="flex flex-col items-center">
        <div class="relative mb-8">
            <div class="z-10 h-64 overflow-hidden w-100">
                <img class="object-cover w-full" src="https://images.unsplash.com/photo-1593642634524-b40b5baae6bb?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1489&q=80" alt="user backgroud image">
            </div>

            <div class="absolute bottom-0 left-0 z-20 flex items-center ml-12 -mb-8">
                <div class="w-32">
                    <img src="https://cdn.pixabay.com/photo/2014/07/09/10/04/man-388104_960_720.jpg" alt="profile image for user" class="object-cover w-32 h-32 border-4 border-gray-200 rounded-full shadow-lg">
                </div>
                <p class="ml-4 text-2xl text-gray-100">{{ user.data.attributes.name }}</p>
            </div>
        </div>

        <p v-if="postLoading">Loading posts...</p>

        <Post v-else v-for="post in posts.data" :key="post.data.post_id" :post="post" />

        <p v-if="!postLoading && posts.data.length < 1">No posts found. Get started</p>
    </div>
</template>

<script>
import Post from '../../components/Post';

    export default {
        name: "Show",

        components: {
            Post,
        },

        data: () => {
            return {
                user: null,
                posts: null,
                userLoading: true,
                postLoading: true,
            }
        },

        mounted() {
            // users profile
            axios.get('/api/users/' + this.$route.params.userId)
                .then((res) => {
                    this.user = res.data;
                }).catch((error) => {
                    console.log('Unable to fetch the user from the server.');
                })
                .finally(() => {
                    this.userLoading = false;
                });

            // users posts
            axios.get('/api/users/' + this.$route.params.userId + '/posts')
                .then((res) => {
                    this.posts = res.data;
                }).catch((error) => {
                    console.log('Unable to fetch the user from the server.');
                })
                .finally(() => {
                    this.postLoading = false;
                });
        }
    }
</script>

<style scoped>

</style>