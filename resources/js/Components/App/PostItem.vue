<script setup>

import {Disclosure, DisclosureButton, DisclosurePanel, Menu, MenuButton, MenuItems, MenuItem} from '@headlessui/vue'
import {
    PencilIcon,
    TrashIcon,
    EllipsisVerticalIcon,
    HandThumbUpIcon,
    ChatBubbleLeftRightIcon,
    ArrowDownTrayIcon
} from '@heroicons/vue/20/solid'
import PostUserHeader from "@/Components/App/PostUserHeader.vue";
import {router} from "@inertiajs/vue3";
import {isImage} from "@/helper.js";
import {PaperClipIcon, XMarkIcon} from "@heroicons/vue/20/solid/index.js";
import {computed} from "vue";

const props = defineProps({
    post: Object
})

const emit = defineEmits(['editClick'])

function openEditModal() {
    emit('editClick', props.post)
}

function deletePost() {
    if (window.confirm("Are you sure you want to delete this post ?")) {
        router.delete(route('post.destroy', props.post), {
            preserveScroll: true
        })
    }
}

function AttachmentGridShowClass(count) {
    switch (count) {
        case 1:
            return 'grid-cols-1';
        case 2:
        case 4:
            return 'sm:grid-cols-2 gap-2';
        default:
            return 'sm:grid-cols-2 md:grid-cols-3 gap-2'
    }
}

</script>

<template>
    <div class="mt-4 bg-white border rounded p-4 shadow">
        <!-- Post Creator Details -->
        <div class="flex items-center justify-between mb-2">
            <PostUserHeader :post="post"/>
            <div class="">
                <Menu as="div" class="relative inline-block text-left">
                    <div>
                        <MenuButton
                            class="w-8 h-8 rounded-full hover:bg-black/10 flex justify-center items-center transition"
                        >
                            <EllipsisVerticalIcon
                                class="h-5 w-5"
                                aria-hidden="true"
                            />
                        </MenuButton>
                    </div>

                    <transition
                        enter-active-class="transition duration-100 ease-out"
                        enter-from-class="transform scale-95 opacity-0"
                        enter-to-class="transform scale-100 opacity-100"
                        leave-active-class="transition duration-75 ease-in"
                        leave-from-class="transform scale-100 opacity-100"
                        leave-to-class="transform scale-95 opacity-0"
                    >
                        <MenuItems
                            class="absolute right-0 mt-2 w-32 origin-top-right divide-y divide-gray-100 rounded-md bg-white shadow-lg ring-1 ring-black/5 focus:outline-none"
                        >
                            <div class="px-1 py-1">
                                <MenuItem v-slot="{ active }">
                                    <button
                                        @click="openEditModal"
                                        :class="[
                                                active ? 'bg-indigo-500 text-white' : 'text-gray-900',
                                                 'group flex w-full items-center rounded-md px-2 py-2 text-sm',]"
                                    >
                                        <PencilIcon
                                            class="mr-2 h-5 w-5"
                                            aria-hidden="true"
                                        />
                                        Edit
                                    </button>
                                </MenuItem>
                                <MenuItem v-slot="{ active }">
                                    <button
                                        @click="deletePost"
                                        :class="[ active ? 'bg-indigo-500 text-white' : 'text-gray-900',
                                            'group flex w-full items-center rounded-md px-2 py-2 text-sm',]"
                                    >
                                        <TrashIcon
                                            class="mr-2 h-5 w-5 "
                                            aria-hidden="true"
                                        />
                                        Delete
                                    </button>
                                </MenuItem>
                            </div>

                        </MenuItems>
                    </transition>
                </Menu>
            </div>
        </div>
        <!-- Post Body -->
        <div>
            <Disclosure v-slot="{ open }">
                <div v-if="!open" class="ck-content-output" v-html="post.body.substring(0,150)"/>
                <template v-if="post.body.length > 200">
                    <DisclosurePanel class="font-small">
                        <div class="ck-content-output" v-html="post.body"/>
                    </DisclosurePanel>
                    <div class="flex justify-end">
                        <DisclosureButton class="text-blue-400 hover:underline mb-2">
                            {{ open ? '... Read Less' : '... Read More' }}
                        </DisclosureButton>
                    </div>
                </template>
            </Disclosure>
        </div>
        <!-- Post Attachments -->
        <div class="grid"
             :class="AttachmentGridShowClass(post.attachments.length)">
            <div v-for="(attachment,index) of post.attachments.slice(0,6)" class="relative rounded group">
                <div v-if="index === 5"
                     class="absolute left-0 top-0 right-0 bottom-0 z-10 bg-black/50 flex items-center justify-center text-white">
                    + {{ post.attachments.length - 6 }} more
                </div>
                <!-- download -->
                <button
                    class="z-20 w-8 h-8 hover:bg-gray-500 hover:text-gray-100 flex items-center justify-center cursor-pointer absolute top-2
                    right-2 rounded bg-gray-300 text-gray-800 opacity-0 group-hover:opacity-100 transition-all">
                    <ArrowDownTrayIcon class="w-8 h-8 p-2"/>
                </button>
                <!-- download -->
                <div v-if="isImage(attachment)"
                     class="object-cover aspect-square">
                    <img :src="attachment.url" :alt="attachment.name" class="w-full h-full"/>
                </div>
                <div v-else
                     class="aspect-square border flex flex-col justify-center items-center text-gray-500 bg-gray-100 p-3 overflow-hidden break-words">
                    <PaperClipIcon class="w-12 h-12 mb-2"/>
                    <small class="text-center">
                        {{ attachment.name }}
                    </small>
                </div>
            </div>
        </div>
        <!-- Post Reactions -->
        <div class="mt-3 grid gap-2 grid-cols-2">
            <button class="flex justify-center items-center rounded py-2 bg-gray-100 hover:bg-gray-300">
                <HandThumbUpIcon class="w-6 h-6"/>
                <span class="ml-2">
                        Like
                    </span>
            </button>
            <button class="flex justify-center items-center rounded py-2 bg-gray-100 hover:bg-gray-300">
                <ChatBubbleLeftRightIcon class="w-6 h-6"/>
                <span class="ml-2">
                        Comment
                    </span>
            </button>
        </div>
    </div>

</template>

<style scoped>

</style>
