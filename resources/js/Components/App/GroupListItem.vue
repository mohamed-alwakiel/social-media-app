<script setup>

import GroupItem from "@/Components/App/GroupItem.vue";
import TextInput from "@/Components/TextInput.vue";
import {ref} from "vue";

const searchKeyword = ref('')
</script>

<template>
    <text-input :model-value="searchKeyword" class="my-4 w-full" placeholder="search for groups"/>
    <div class="overflow-auto hide-scroller h-[200px] lg:flex-1">
        <div v-if="false" class="text-gray-500 flex text-center p-4">
            You are not joined to any groups
        </div>
        <div v-else>
            <GroupItem image="https://picsum.photos/100" title="Laravel Developer"
                       description="description la la la"/>
            <GroupItem image="https://picsum.photos/100" title="Vue.Js Developer"
                       description="description la la la"/>
            <GroupItem image="https://picsum.photos/100" title="Laravel Developer"
                       description="description la la la"/>
            <GroupItem image="https://picsum.photos/100" title="Vue.Js Developer"
                       description="description la la la"/>
            <GroupItem image="https://picsum.photos/100" title="Laravel Developer"
                       description="description la la la"/>
            <GroupItem image="https://picsum.photos/100" title="Vue.Js Developer"
                       description="description la la la"/>
            <GroupItem image="https://picsum.photos/100" title="Laravel Developer"
                       description="description la la la"/>
            <GroupItem image="https://picsum.photos/100" title="Vue.Js Developer"
                       description="description la la la"/>
            <GroupItem image="https://picsum.photos/100" title="Laravel Developer"
                       description="description la la la"/>
            <GroupItem image="https://picsum.photos/100" title="Vue.Js Developer"
                       description="description la la la"/>
        </div>
    </div>
</template>

<style scoped>

</style>
