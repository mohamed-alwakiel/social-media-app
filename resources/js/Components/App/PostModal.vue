<script setup>
import {computed, onMounted, reactive, ref, watch} from 'vue'
import {
    TransitionRoot,
    TransitionChild,
    Dialog,
    DialogPanel,
    DialogTitle,
} from '@headlessui/vue'
import TextAreaInput from "@/Components/TextAreaInput.vue";
import PostUserHeader from "@/Components/App/PostUserHeader.vue";
import {XMarkIcon} from '@heroicons/vue/20/solid'
import {useForm} from "@inertiajs/vue3";

const props = defineProps({
    post: {
        type: Object,
        required: true
    },
    modelValue: Boolean
})

const form = useForm({
    id: null,
    body: ''
})

const show = computed({
    get: () => props.modelValue,
    set: (value) => emit('update:modelValue', value)
})

const emit = defineEmits(['update:modelValue'])

watch(() => props.post, () => {
    form.id = props.post.id
    form.body = props.post.body
})

function closeModal() {
    show.value = false
}

function submit() {
    form.put(route('post.update', props.post.id), {
        preserveScroll: true,
        onSuccess: () => {
            show.value = false
        }
    })
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
                                    Update Post
                                    <button @click="show = false"
                                            class="w-8 h-8 rounded-full hover:bg-black/10 flex justify-center items-center transition">
                                        <XMarkIcon class="w-4 h-4"></XMarkIcon>
                                    </button>
                                </DialogTitle>
                                <div class="px-4 py-2">
                                    <PostUserHeader :post="post" :show-time="false" class="mb-4"/>
                                    <TextAreaInput v-model="form.body" :autoResize="true" class="w-full hide-scroller"/>
                                </div>

                                <div class="p-4">
                                    <button
                                        type="button"
                                        class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500
                                        focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                                        @click="submit"
                                    >
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
