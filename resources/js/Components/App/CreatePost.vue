<script setup>
import {ref} from "vue";
import TextAreaInput from "@/Components/TextAreaInput.vue";
import {useForm} from "@inertiajs/vue3";

const postCreating = ref(false)
const newPostForm = useForm({
    body: ''
})

function submitPost() {
    newPostForm.post(route('post.create'), {
        onSuccess: () => {
            newPostForm.reset()
        }
    });

}

</script>

<template>
    <div class="bg-white border p-3 rounded">
        <TextAreaInput @click="postCreating = !postCreating" v-model="newPostForm.body" :autoResize="true"
                       class="mb-2 w-full" placeholder="Click here to create new post" rows="2"/>
        <div v-if="postCreating" class="flex justify-between">
            <button type="submit"
                    class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 relative">
                Attach Files
                <input type="file" class="absolute left-0 top-0 right-0 bottom-0 opacity-0">
            </button>
            <button type="submit" @click="submitPost"
                    class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                Submit
            </button>
        </div>
    </div>
</template>

<style scoped>

</style>
