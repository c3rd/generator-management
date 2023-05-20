<template>
    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Geradores</h2>
                <Link :href="route('generators.create')" class="bg-black py-2 px-4 text-white rounded-lg">Adicionar Gerador
                </Link>
            </div>
        </template>
        <div class="py-5">
            <ul>
                <li v-for="generator in generators">
                    {{ generator }}
                    <Link :href="route('generators.edit', generator.id)"> Edit </Link>
                </li>
            </ul>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Link } from '@inertiajs/vue3';
defineProps({
    generators: {
        type: Array
    }
});
</script>

<style lang="scss" scoped></style>