<script setup>
import {ref} from "vue";

const postCreating = ref(false)
</script>

<template>
    <div class="bg-white border p-3 rounded">
        <div @click="postCreating = !postCreating"
             class="p-3 text-gray-500 border dark:border-gray-300 rounded my-4 cursor-pointer">
            click here to create new post
        </div>
        <div v-if="postCreating" class="flex justify-between">
            <button type="submit"
                    class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 relative">
                Attach Files
                <input type="file" class="absolute left-0 top-0 right-0 bottom-0 opacity-0">
            </button>
            <button type="submit"
                    class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                Submit
            </button>
        </div>
    </div>
</template>

<style scoped>

</style>
