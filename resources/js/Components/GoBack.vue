<template>
    <button @click="back">
        <div
            class="w-10 h-10 flex items-center hover:bg-black hover:text-white justify-center text-2xl border-2 border-black rounded-full">
            <i class="fa-solid fa-arrow-left"></i>
        </div>
    </button>
</template>

<script setup>
const back = () => {
    window.history.back();
}
</script>

<style lang="scss" scoped></style>