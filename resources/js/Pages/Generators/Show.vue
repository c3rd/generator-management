<template>
    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center gap-5">
                <GoBack />
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Gerador</h2>
            </div>
        </template>
        <div class="grid place-items-center mt-10">
            <div class="max-w-md bg-white border border-gray-200 rounded-lg shadow flex">
                <div class="w-full border-r border-r-slate-300">
                    <img :src="'../storage/jk-placeholder-image.jpg'" class="bg-black bg-contain" alt="">
                </div>
                <div class=" w-full p-5">
                    <ul>
                        <li><strong>Serial:</strong> {{ generator.serial }}</li>
                        <li><strong>Modelo:</strong> {{ generator.model }}</li>
                        <li><strong>Marca:</strong> {{ generator.brand }}</li>
                        <li><strong>Horímetro:</strong> {{ generator.hourmeter }}</li>
                    </ul>
                </div>
            </div>
            <h2 class="mt-5 text-2xl">Últimos Serviços</h2>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import GoBack from '@/Components/GoBack.vue'

defineProps({
    generator: Array,
})

</script>

<style lang="scss" scoped></style>