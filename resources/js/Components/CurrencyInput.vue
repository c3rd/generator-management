<template>
    <div>
        <div class="relative mt-2 rounded-md shadow-sm">
            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                <span class=" text-gray-900 sm:text-sm">R$ </span>
            </div>
            <input :value="modelValue" @input="$emit('update:modelValue', $event.target.value)" v-maska data-maska="9.99#,##" data-maska-tokens="9:[0-9]:repeated" data-maska-reversed type="text"
                name="price" id="price"
                class="block w-full border-gray-300 px-8 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" />
        </div>
    </div>
</template>

<script setup>
import { vMaska } from "maska"

defineProps(['modelValue'])
defineEmits(['update:modelValue'])
</script>

<style lang="scss" scoped></style>