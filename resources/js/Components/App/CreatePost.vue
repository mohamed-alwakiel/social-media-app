<script setup>
import {ref} from "vue";
import TextAreaInput from "@/Components/TextAreaInput.vue";
import {useForm, usePage} from "@inertiajs/vue3";
import PostModal from "@/Components/App/PostModal.vue";

const authUser = usePage().props.auth.user;
const showModal = ref(false)
const newPost = ref({
    id: null,
    body: '',
    user: authUser
})

function showCreatePostModal() {
    showModal.value = true
}

</script>

<template>
    <div class="bg-white border p-3 rounded">
        <div @click="showCreatePostModal" class="cursor-pointer p-3 border-2 border-gray-300 text-gray-500 rounded-md shadow-sm w-full">
            Click here to create new post
        </div>
        <!--        <div class="flex justify-between">-->
        <!--            <button type="submit"-->
        <!--                    class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 relative">-->
        <!--                Attach Files-->
        <!--                <input type="file" class="absolute left-0 top-0 right-0 bottom-0 opacity-0">-->
        <!--            </button>-->
        <!--            <button type="submit" @click="submitPost"-->
        <!--                    class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">-->
        <!--                Submit-->
        <!--            </button>-->
        <!--        </div>-->

        <PostModal :post="newPost" v-model="showModal"/>
    </div>
</template>

<style scoped>

</style>
