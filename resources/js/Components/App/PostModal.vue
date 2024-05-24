<script setup>
import {computed, ref, watch} from 'vue'
import {Dialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot,} from '@headlessui/vue'
import PostUserHeader from "@/Components/App/PostUserHeader.vue";
import {XMarkIcon, PaperClipIcon, BookmarkIcon} from '@heroicons/vue/20/solid'
import {useForm} from "@inertiajs/vue3";
import ClassicEditor from "@ckeditor/ckeditor5-build-classic";
import {isImage} from "@/helper.js";

const props = defineProps({
    post: {
        type: Object,
        required: true
    },
    modelValue: Boolean
})

/**
 * {
 *     file: File,
 *     url: '',
 * }
 * @type {Ref<UnwrapRef<*[]>>}
 */
const attachmentFiles = ref([])

const form = useForm({
    id: null,
    body: ''
})

const show = computed({
    get: () => props.modelValue,
    set: (value) => emit('update:modelValue', value)
})

const emit = defineEmits(['update:modelValue'])

const editor = ClassicEditor;
const editorConfig = {
    toolbar: {
        items: ['heading', '|', 'bold', 'italic', '|', 'link', '|', 'bulletedList', 'numberedList', '|', 'outdent', 'indent',
            '|', 'blockQuote']
    }
};

watch(() => props.post, () => {
    form.id = props.post.id
    form.body = props.post.body
})

function closeModal() {
    show.value = false
    form.reset()
    attachmentFiles.value = []
}

function submit() {
    if (form.id) {
        form.put(route('post.update', props.post.id), {
            preserveScroll: true,
            onSuccess: () => {
                show.value = false
                form.reset()
            }
        })
    } else {
        form.post(route('post.create'), {
            preserveScroll: true,
            onSuccess: () => {
                show.value = false
                form.reset()
            }
        });
    }
}

async function onAttachmentChoose($event) {
    for (const file of $event.target.files) {
        const selectedFile = {
            file,
            url: await readFile(file)
        }
        attachmentFiles.value.push(selectedFile)
    }
    $event.target.value = null;
}

async function readFile(file) {
    return new Promise((res, rej) => {
        if (isImage(file)) {
            const reader = new FileReader();
            reader.onload = () => {
                res(reader.result)
            }
            reader.onerror = rej
            reader.readAsDataURL(file)
        } else {
            res(null)
        }
    })
}

function removeFile(file) {
    attachmentFiles.value = attachmentFiles.value.filter(f => f !== file)
}

</script>


<template>

    <teleport to="body">
        <TransitionRoot appear :show="show" as="template">
            <Dialog as="div" @close="closeModal" class="relative z-10">
                <TransitionChild
                    as="template"
                    enter="duration-300 ease-out"
                    enter-from="opacity-0"
                    enter-to="opacity-100"
                    leave="duration-200 ease-in"
                    leave-from="opacity-100"
                    leave-to="opacity-0"
                >
                    <div class="fixed inset-0 bg-black/25"/>
                </TransitionChild>

                <div class="fixed inset-0 overflow-y-auto">
                    <div
                        class="flex min-h-full items-center justify-center text-center"
                    >
                        <TransitionChild
                            as="template"
                            enter="duration-300 ease-out"
                            enter-from="opacity-0 scale-95"
                            enter-to="opacity-100 scale-100"
                            leave="duration-200 ease-in"
                            leave-from="opacity-100 scale-100"
                            leave-to="opacity-0 scale-95"
                        >
                            <DialogPanel
                                class="w-full max-w-md transform overflow-hidden rounded bg-white
                                text-left align-middle shadow-xl transition-all"
                            >
                                <DialogTitle
                                    as="h3"
                                    class="font-medium bg-gray-100 text-gray-900 p-4 flex items-center justify-between"
                                >
                                    {{ form.id ? 'Update Post' : 'Create Post' }}
                                    <button @click="show = false"
                                            class="w-8 h-8 rounded-full hover:bg-black/10 flex justify-center items-center transition">
                                        <XMarkIcon class="w-4 h-4"></XMarkIcon>
                                    </button>
                                </DialogTitle>
                                <div class="px-4 py-2">
                                    <PostUserHeader :post="post" :show-time="false" class="mb-4"/>
                                    <ckeditor :editor="editor" v-model="form.body" :config="editorConfig"></ckeditor>

                                    <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-2 mt-3">
                                        <div v-for="(attachment,index) of attachmentFiles"
                                             class="relative rounded group">
                                            <!-- Cancel -->
                                            <button
                                                @click="removeFile(attachment)"
                                                class="absolute z-20 right-3 top-3 flex items-center justify-center w-7 h-7 bg-black/20 text-white rounded-full hover:bg-black/40">
                                                <XMarkIcon class="h-5 w-5"/>
                                            </button>
                                            <!-- Cancel -->
                                            <div v-if="isImage(attachment.file)"
                                                 class="object-cover aspect-square">
                                                <img :src="attachment.url" :alt="attachment.file.name"
                                                     class="w-full h-full"/>
                                            </div>
                                            <div v-else
                                                 class="aspect-square border flex flex-col justify-center items-center text-gray-500 bg-gray-100 p-3 overflow-hidden break-words">
                                                <PaperClipIcon class="w-12 h-12 mb-2"/>
                                                <small class="text-center">
                                                    {{ attachment.file.name }}
                                                </small>
                                            </div>

                                        </div>
                                    </div>

                                </div>

                                <div class="p-4 flex gap-2">
                                    <button
                                        type="button"
                                        class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm
                                        hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 justify-center
                                        focus-visible:outline-offset-2 focus-visible:outline-indigo-600 flex items-center w-full
                                        relative "
                                    >
                                        <PaperClipIcon class="w-4 h-4 mr-2"></PaperClipIcon>
                                        Attach Files
                                        <input @click.stop @change="onAttachmentChoose" type="file" multiple
                                               class="absolute left-0 top-0 right-0 bottom-0 opacity-0">
                                    </button>
                                    <button
                                        type="button"
                                        class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm
                                        hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 flex items-center
                                        focus-visible:outline-offset-2 focus-visible:outline-indigo-600 justify-center w-full"
                                        @click="submit"
                                    >
                                        <BookmarkIcon class="w-4 h-4 mr-2"></BookmarkIcon>
                                        Submit
                                    </button>
                                </div>
                            </DialogPanel>
                        </TransitionChild>
                    </div>
                </div>
            </Dialog>
        </TransitionRoot>
    </teleport>

</template>

<style scoped>

</style>
