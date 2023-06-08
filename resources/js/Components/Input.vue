<template>
    <div class="relative border-b-2 inline-flex justify-center w-full">
        <input v-maska :data-maska="dataMaska" type="text" placeholder=" "
            class="pb-0.5 w-full z-10 bg-transparent focus:ring-0 focus:border-transparent border-transparent text-slate-500 focus:text-slate-700 peer"
            :value="modelValue" @input="$emit('update:modelValue', $event.target.value)" ref="input">
        <div class="border-sky-500 absolute top-full transition-all duration-300 bg-sky-500 w-0 h-0.5 peer-focus:w-full">
        </div>
        <label
            class="absolute -top-3 -left-2 transition-all duration-300 bg-white text-slate-500 scale-75 peer-placeholder-shown:scale-100 peer-placeholder-shown:top-2.5 peer-placeholder-shown:left-2 peer-placeholder-shown:text-slate-500 peer-focus:-top-3 peer-focus:-left-2 peer-focus:scale-75 peer-focus:text-sky-500">
            {{ labelText }}
        </label>
    </div>
</template>

<script setup>
import { vMaska } from "maska";
import { onMounted, ref } from 'vue';

defineProps({
    modelValue: {
        type: String,
        required: true,
    },
    labelText: String,
    dataMaska: String,
});

defineEmits(['update:modelValue']);

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});

defineExpose({ focus: () => input.value.focus() });

</script>