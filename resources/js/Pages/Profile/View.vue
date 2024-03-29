<script setup>


import {computed, ref} from 'vue'
import {TabGroup, TabList, Tab, TabPanels, TabPanel} from '@headlessui/vue'
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import TabItem from "@/Pages/Profile/Partials/TabItem.vue";
import Edit from "@/Pages/Profile/Edit.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import {usePage} from "@inertiajs/vue3";


const props = defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
    user: {
        type: Object
    }
});

const authUser = usePage().props.auth.user;
const isMyProfile = computed(() => authUser && authUser.id === props.user.id)

</script>

<template>
    <AuthenticatedLayout>
        <div class="w-[800px] bg-white mx-auto h-full overflow-auto hide-scroller">
            <div class="relative">
                <img
                    src="https://images.pexels.com/photos/133633/pexels-photo-133633.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
                    class="h-[200px] w-full object-cover" alt="" srcset="">
                <div class="flex">
                    <img
                        src="https://cdn.iconscout.com/icon/free/png-256/free-avatar-370-456322.png?f=webp"
                        class="ml-[64px] w-[128px] h-[128px] -mt-[64px]" alt="" srcset="">
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
                        <Tab v-if="isMyProfile" as="template" v-slot="{ selected }">
                            <TabItem text="About" :selected="selected"></TabItem>
                        </Tab>

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
                    </TabList>

                    <TabPanels class="mt-2">
                        <TabPanel v-if="isMyProfile" key="about">
                            <Edit :must-verify-email="mustVerifyEmail" :status="status"/>
                        </TabPanel>
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
                    </TabPanels>
                </TabGroup>
            </div>
        </div>
    </AuthenticatedLayout>

</template>

<style scoped>

</style>

