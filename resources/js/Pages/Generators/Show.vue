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
            <div class="flex justify-center items-center gap-2 mt-5">
                <h2 class="text-2xl">Últimos Serviços</h2>
                <Link :href="route('generators.services.create', generator.id)"
                    class="bg-black py-2 px-4 text-white rounded-lg">Adicionar Serviço
                </Link>
            </div>
        </div>
        <div class="max-w-7xl grid place-items-center mx-auto">
            <Table>
                <template #thead>
                    <tr>
                        <th scope="col" class="px-6 py-4">
                            Descrição
                        </th>
                        <th scope="col" class="px-6 py-4">
                            Data do Serviço
                        </th>
                        <th scope="col" class="px-6 py-4">
                            Horímetro
                        </th>
                        <th scope="col" class="px-6 py-4">
                            Funcionário Responsável
                        </th>
                        <th scope="col" class="px-6 py-4">
                            <span class="sr-only">Edit</span>
                        </th>
                    </tr>
                </template>
                <tr v-if="services.data.length === 0"
                    class="border-b transition duration-100 ease-in-out hover:bg-neutral-100">
                    <td colspan="5" class="">Nenhum
                        registro encontrado.</td>
                </tr>
                <tr v-else v-for="service in services.data"
                    class="border-b transition duration-100 ease-in-out hover:bg-neutral-200">
                    <td scope="row" class="whitespace-nowrap px-6 py-4">
                        {{ service.name }}
                    </td>
                    <td class="whitespace-nowrap px-6 py-4">
                        {{ service.service_date }}
                    </td>
                    <td class="whitespace-nowrap px-6 py-4">
                        {{ service.hourmeter }}
                    </td>
                    <td class="whitespace-nowrap px-6 py-4">
                        {{ service.employee }}
                    </td>
                    <td @click.stop class="whitespace-nowrap px-6 py-4">
                        <Link :href="route('generators.services.edit', {generator: generator.id, service: service.id})"
                            class="font-medium text-blue-600 dark:text-blue-500 hover:underline"> Edit </Link>
                    </td>
                </tr>
            </Table>
            <Pagination :links="services.links"></Pagination>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import GoBack from '@/Components/GoBack.vue';
import { Link } from '@inertiajs/vue3';
import Table from '@/Components/Table.vue';
import Pagination from '@/Components/Pagination.vue';

defineProps({
    generator: Object,
    services: Object,
})

</script>

<style lang="scss" scoped></style>