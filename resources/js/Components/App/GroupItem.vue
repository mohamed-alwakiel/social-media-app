<script setup>
defineProps({
    image: String,
    title: String,
    description: String
})
</script>

<template>
    <div class="mb-4 hover:bg-gray-200 cursor-pointer p-2 rounded">
        <div class="flex items-start gap-2 ">
            <img :src="image" class="w-[32px] rounded-full" alt="">
            <div>
                <h3 class="font-black text-l">{{ title }}</h3>
                <div class="text-xs text-gray-500">{{ description }}</div>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
