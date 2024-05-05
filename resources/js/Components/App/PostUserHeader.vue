<script setup>
defineProps({
    post: {
        type: Object
    },
    showTime: {
        type: Boolean,
        default: true
    }
})
</script>

<template>
    <div class="flex items-center gap-2">
        <a href="javascript:void(0)">
            <img :src="post.user.avatar_url" alt="user-avatar"
                 class="w-[40px] rounded-full border border-gray-300 transition-all border-2 hover:border-blue-500">
        </a>
        <div>
            <h4 class="font-semibold">
                <a href="javascript:void(0)" class="hover:underline">
                    {{ post.user.name }}
                </a>
                <template v-if="post.group">
                    >
                    <a href="javascript:void(0)" class="hover:underline">
                        {{ post.group.name }}
                    </a>
                </template>
            </h4>
            <p v-if="showTime" class="text-sm text-gray-500">{{ post.created_at }}</p>
        </div>
    </div>
</template>

<style scoped>

</style>
