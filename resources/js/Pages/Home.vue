<script setup>

import GroupList from "@/Components/App/GroupList.vue";
import FriendList from "@/Components/App/FriendList.vue";
import CreatePost from "@/Components/App/CreatePost.vue";
import PostList from "@/Components/App/PostList.vue";
import {Head} from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

defineProps({
    posts: Object
})

</script>

<template>
    <Head title="Social Media website"/>

    <AuthenticatedLayout>
        <div class="grid md:grid-cols-12 gap-4 p-4 h-full">
            <div class="md:col-span-6 lg:col-span-3 lg:order-1 lg:h-full overflow-hidden">
                <GroupList/>
            </div>
            <div class="md:col-span-6 lg:col-span-3 lg:order-3 lg:h-full overflow-hidden">
                <FriendList/>
            </div>
            <div class="md:col-span-12 lg:col-span-6 lg:order-2 h-[500px] lg:h-full flex flex-col overflow-hidden">
                <CreatePost/>
                <PostList :posts="posts.data" class="flex-1"/>
            </div>

        </div>
    </AuthenticatedLayout>

</template>

<style>

</style>
