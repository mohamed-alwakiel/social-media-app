<script setup>
import {onMounted, ref} from 'vue';

const model = defineModel({
    type: String,
    required: true,
});

const props = defineProps({
    placeholder: String,
    autoResize: {
        type: Boolean,
        default: false
    }
})

const input = ref(null);

defineExpose({focus: () => input.value.focus()});

function adjustAreaHeight() {
    if (props.autoResize) {
        input.value.style.height = 'auto';
        input.value.style.height = input.value.scrollHeight + 'px';
    }
}

function onInputChange() {
    adjustAreaHeight()
}

onMounted(() => {
    adjustAreaHeight()
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});

</script>

<template>
    <textarea
        class="border-gray-300 gray:border-gray-700 white:bg-gray-900 dark:text-gray-300 focus:border-indigo-500
        dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
        v-model="model"
        @input="onInputChange"
        ref="input"
        :placeholder="placeholder"
    ></textarea>
</template>
