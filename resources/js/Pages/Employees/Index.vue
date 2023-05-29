<template>
    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Funcionários</h2>
                <Link :href="route('employees.create')" class="bg-black py-2 px-4 text-white rounded-lg">Adicionar
                Funcionário
                </Link>
            </div>
        </template>
        <div class="py-5">
        </div>
    </AuthenticatedLayout>
</template>

<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Link, Head } from '@inertiajs/vue3';


defineProps({
    employees: {
        type: Array
    }
});

</script>

<style lang="scss" scoped></style>