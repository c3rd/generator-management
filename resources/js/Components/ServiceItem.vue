<template>
    <div class="bg-white p-8 flex flex-col items-center justify-center gap-2 w-1/3 shadow-lg">
        <slot name="icon"></slot>
        <div>
            <h3>
                <slot name="heading"></slot>
            </h3>
            <slot></slot>
        </div>
    </div>
</template>

<script setup>

</script>