<script setup>

import FriendItem from "@/Components/App/FriendItem.vue";
import TextInput from "@/Components/TextInput.vue";
import {ref} from "vue";

const searchKeyword = ref('')
</script>

<template>
    <text-input :model-value="searchKeyword" class="my-4 w-full" placeholder="search for groups"/>
    <div class="overflow-auto hide-scroller h-[200px] lg:flex-1">
        <div v-if="false" class="text-gray-500 flex text-center p-4">You don't have any friends yet.</div>
        <div v-else>
            <FriendItem image="https://picsum.photos/150" title="Steph Jobs"/>
            <FriendItem image="https://picsum.photos/150" title="Elon Musk"/>
            <FriendItem image="https://picsum.photos/150" title="Steph Jobs"/>
            <FriendItem image="https://picsum.photos/150" title="Elon Musk"/>
            <FriendItem image="https://picsum.photos/150" title="Steph Jobs"/>
            <FriendItem image="https://picsum.photos/150" title="Elon Musk"/>
            <FriendItem image="https://picsum.photos/150" title="Steph Jobs"/>
            <FriendItem image="https://picsum.photos/150" title="Elon Musk"/>
            <FriendItem image="https://picsum.photos/150" title="Steph Jobs"/>
            <FriendItem image="https://picsum.photos/150" title="Elon Musk"/>
        </div>
    </div>
</template>

<style scoped>

</style>
