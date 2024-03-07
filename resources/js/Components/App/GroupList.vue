<script setup>

import GroupListItem from "@/Components/App/GroupListItem.vue";
import {Disclosure, DisclosureButton, DisclosurePanel} from "@headlessui/vue";

</script>

<template>
    <div class="p-3 bg-white border h-full rounded overflow-hidden">

        <div class="flex-1 block lg:hidden overflow-hidden">
            <Disclosure v-slot="{ open }">
                <DisclosureButton class="text-left w-full">
                    <div class="flex justify-between items-center">
                        <h2 class="text-2xl font-bold">My Groups</h2>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="w-6 h-6 transition-all"
                             :class="open?'rotate-90 transform':''">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5"/>
                        </svg>
                    </div>
                </DisclosureButton>
                <DisclosurePanel class="font-small">
                    <GroupListItem/>
                </DisclosurePanel>
            </Disclosure>
        </div>

        <div class="flex-col h-full overflow-hidden hidden lg:flex">
            <h2 class="text-2xl font-bold mb-6">My Groups</h2>
            <GroupListItem/>
        </div>

    </div>
</template>

<style scoped>

</style>
