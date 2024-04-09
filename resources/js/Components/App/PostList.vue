<script setup>
import PostItem from "@/Components/App/PostItem.vue";

defineProps({
    posts: Array
})

const post1 = {
    user: {
        id: 1,
        avatar: 'https://randomuser.me/api/portraits/men/74.jpg',
        name: 'John Smith'
    },
    group: null,
    attachments: [
        {
            id: 1,
            name: 'test.png',
            url: 'https://picsum.photos/1000',
            mime: 'image/png'
        },
        {
            id: 2,
            name: 'test2.png',
            url: 'https://picsum.photos/1000',
            mime: 'image/png'
        },
        {
            id: 3,
            name: 'MyDocument.docx',
            url: '#',
            mime: 'application/msword'
        }
    ],
    body: `<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's
    standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a
    type specimen book.</p>

    <p>It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
    It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages,
    and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</p>`,
    created_at: '2023-11-19 15:12:00'
}

const post2 = {
    user: {
        id: 2,
        avatar: 'https://randomuser.me/api/portraits/men/79.jpg',
        name: 'James Does'
    },
    group: {
        id: 1,
        name: 'Laravel Developers'
    },
    body: `<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's
    standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a
    type specimen book.</p>

    <p>It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
    It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages,
    and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</p>`,
    created_at: '2023-08-08 15:12:00'
}

</script>

<template>
    <div class="overflow-scroll mt-2 hide-scroller">
        <PostItem v-for="post of posts" :key="post.id" :post="post"/>
    </div>
</template>

<style scoped>
</style>
