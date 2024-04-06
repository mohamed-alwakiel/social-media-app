<script setup>


import {computed, ref} from 'vue'
import {TabGroup, TabList, Tab, TabPanels, TabPanel} from '@headlessui/vue'
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import TabItem from "@/Pages/Profile/Partials/TabItem.vue";
import Edit from "@/Pages/Profile/Edit.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import {usePage, useForm} from "@inertiajs/vue3";
import {XMarkIcon, CheckCircleIcon, CameraIcon} from "@heroicons/vue/24/outline/index.js";


const props = defineProps({
    errors: Object,
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
    success: {
        type: String,
    },
    user: {
        type: Object
    }
});

const profileImagesForm = useForm({
    avatar: null,
    cover: null,
})

const authUser = usePage().props.auth.user;
const isMyProfile = computed(() => authUser && authUser.id === props.user.id)
const avatarImageSrc = ref('')
const coverImageSrc = ref('')
const showNotification = ref(true)

// Cover
function OnCoverChange(event) {
    console.log(event)
    profileImagesForm.cover = event.target.files[0]
    if (profileImagesForm.cover) {
        const reader = new FileReader()
        reader.onload = () => {
            console.log("onload")
            coverImageSrc.value = reader.result;
        }
        reader.readAsDataURL(profileImagesForm.cover)
    }
}

function resetCoverImage() {
    profileImagesForm.cover = null
    coverImageSrc.value = null
}

function submitCoverImage() {
    profileImagesForm.post(route('profile.updateProfileImages'), {
        onSuccess: () => {
            resetCoverImage()
            setTimeout(() => {
                showNotification.value = false
            }, 3000)
        }
    })
}

// Avatar
function OnAvatarChange(event) {
    console.log(event)
    profileImagesForm.avatar = event.target.files[0]
    if (profileImagesForm.avatar) {
        const reader = new FileReader()
        reader.onload = () => {
            console.log("onload")
            avatarImageSrc.value = reader.result;
        }
        reader.readAsDataURL(profileImagesForm.avatar)
    }
}

function resetAvatarImage() {
    profileImagesForm.avatar = null
    avatarImageSrc.value = null
}

function submitAvatarImage() {
    profileImagesForm.post(route('profile.updateProfileImages'), {
        onSuccess: () => {
            resetAvatarImage()
            setTimeout(() => {
                showNotification.value = false
            }, 3000)
        }
    })
}


</script>

<template>
    <AuthenticatedLayout>
        <div class="max-w-[800px] mx-auto h-full overflow-auto hide-scroller">
            <div
                v-show="showNotification && success"
                class="my-2 p-2 font-medium text-sm bg-emerald-500 text-white"
            >
                {{ success }}
            </div>

            <div
                v-if="errors.cover"
                class="my-2 p-2 font-medium text-sm bg-red-400 text-white"
            >
                {{ errors.cover }}
            </div>

            <div class="group relative bg-white">
                <img
                    :src="coverImageSrc || user.cover_url || '/img/cover_default.jpg'"
                    class="h-[200px] w-full object-cover" alt="" srcset="">
                <div class="absolute top-2 right-2">
                    <div v-if="!coverImageSrc" class="bg-white p-1 opacity-0 rounded group-hover:opacity-100 ">
                        <button
                            class="flex items-center bg-gray-50 hover:bg-gray-100 text-gray-800 py-1 px-2 text-xs">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="w-3 h-3 mr-2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M6.827 6.175A2.31 2.31 0 0 1 5.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 0 0-1.134-.175 2.31 2.31 0 0 1-1.64-1.055l-.822-1.316a2.192 2.192 0 0 0-1.736-1.039 48.774 48.774 0 0 0-5.232 0 2.192 2.192 0 0 0-1.736 1.039l-.821 1.316Z"/>
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M16.5 12.75a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0ZM18.75 10.5h.008v.008h-.008V10.5Z"/>
                            </svg>
                            Update Cover Image
                            <input type="file" class="absolute left-0 top-0 bottom-0 right-0 opacity-0 cursor-pointer"
                                   @change="OnCoverChange">
                        </button>
                    </div>
                    <div v-else class="flex gap-2 bg-white p-1 opacity-0 rounded group-hover:opacity-100 ">
                        <button
                            @click="resetCoverImage"
                            class="flex items-center bg-gray-50 hover:bg-gray-100 text-gray-800 py-1 px-2 text-xs">
                            <XMarkIcon class="h-3 w-3 mr-2"/>
                            Cancel
                        </button>
                        <button
                            @click="submitCoverImage"
                            class="flex items-center bg-gray-800 hover:bg-gray-900 text-gray-100 py-1 px-2 text-xs">
                            <CheckCircleIcon class="h-4 w-4 mr-2"/>
                            Submit
                        </button>
                    </div>
                </div>
                <div class="flex">
                    <div
                        class="flex items-center rounded-full justify-center group/avatar relative -mt-[64px] ml-[64px] w-[128px] h-[128px]">
                        <img
                            :src="avatarImageSrc || user.avatar_url || '/img/avatar_default.png'"
                            class="w-full h-full object-cover rounded-full" alt="" srcset="">
                        <button
                            v-if="!avatarImageSrc"
                            class="absolute left-0 top-0 right-0 bottom-0 bg-black/25 text-gray-800 rounded-full
                                opacity-0 rounded group-hover/avatar:opacity-100 flex items-center justify-center">
                            <CameraIcon class="w-8 h-8"/>
                            <input type="file"
                                   class="absolute left-0 top-0 bottom-0 right-0 opacity-0 cursor-pointer"
                                   @change="OnAvatarChange">
                        </button>
                        <div v-else
                             class="absolute top-1 right-0 flex flex-col gap-2 opacity-0 rounded group-hover/avatar:opacity-100">
                            <button
                                @click="resetAvatarImage"
                                class="flex items-center justify-center w-7 h-7 bg-red-500/80 text-white rounded-full">
                                <XMarkIcon class="h-5 w-5"/>
                            </button>
                            <button
                                @click="submitAvatarImage"
                                class="flex items-center justify-center w-7 h-7 bg-emerald-500/80 text-white rounded-full">
                                <CheckCircleIcon class="h-5 w-5"/>
                            </button>
                        </div>
                    </div>
                    <div class="flex-1 p-4 flex justify-between item-center">
                        <h2 class="font-bold text-lg">{{ user.name }}</h2>
                        <PrimaryButton v-if="isMyProfile">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="w-4 h-4 mr-3">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125"/>
                            </svg>
                            Edit Profile
                        </PrimaryButton>
                    </div>
                </div>

            </div>
            <div class="border-t">
                <TabGroup>
                    <TabList class="pl-[250px] flex bg-white">
                        <Tab as="template" v-slot="{ selected }">
                            <TabItem text="Posts" :selected="selected"></TabItem>
                        </Tab>

                        <Tab as="template" v-slot="{ selected }">
                            <TabItem text="Friends" :selected="selected"></TabItem>
                        </Tab>

                        <Tab as="template" v-slot="{ selected }">
                            <TabItem text="Followers" :selected="selected"></TabItem>
                        </Tab>
                        <Tab as="template" v-slot="{ selected }">
                            <TabItem text="Photos" :selected="selected"></TabItem>
                        </Tab>

                        <Tab v-if="isMyProfile" as="template" v-slot="{ selected }">
                            <TabItem text="My Profile" :selected="selected"></TabItem>
                        </Tab>
                    </TabList>

                    <TabPanels class="mt-2">
                        <TabPanel key="posts" class="bg-white p-3 shadow">
                            Posts Content
                        </TabPanel>
                        <TabPanel key="friends" class="bg-white p-3 shadow">
                            Friends Content
                        </TabPanel>
                        <TabPanel key="followers" class="bg-white p-3 shadow">
                            Followers Content
                        </TabPanel>
                        <TabPanel key="photos" class="bg-white p-3 shadow">
                            Photos Content
                        </TabPanel>
                        <TabPanel v-if="isMyProfile" key="about">
                            <Edit :must-verify-email="mustVerifyEmail" :status="status"/>
                        </TabPanel>                    </TabPanels>
                </TabGroup>
            </div>
        </div>
    </AuthenticatedLayout>

</template>

<style scoped>

</style>

