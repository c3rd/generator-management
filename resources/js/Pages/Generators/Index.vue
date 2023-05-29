<template>
    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Geradores</h2>
                <Link :href="route('generators.create')" class="bg-black py-2 px-4 text-white rounded-lg">Adicionar Gerador
                </Link>
            </div>
        </template>
        <section class="flex flex-col justify-center mt-6">

            <SearchBar :filters="filters" />
            <Table>
                <template #thead>
                    <tr>
                        <th scope="col" class="px-6 py-4">
                            Serial
                        </th>
                        <th scope="col" class="px-6 py-4">
                            Marca
                        </th>
                        <th scope="col" class="px-6 py-4">
                            Modelo
                        </th>
                        <th scope="col" class="px-6 py-4">
                            Horímetro
                        </th>
                        <th scope="col" class="px-6 py-4">
                            <span class="sr-only">Edit</span>
                        </th>
                    </tr>
                </template>
                <tr v-if="generators.data.length === 0"
                    class="border-b transition duration-100 ease-in-out hover:bg-neutral-100">
                    <td colspan="5" class="">Nenhum
                        registro encontrado.</td>
                </tr>
                <tr v-else v-for="generator in generators.data"
                    class="border-b transition duration-100 ease-in-out hover:bg-neutral-200">
                    <td scope="row" class="whitespace-nowrap px-6 py-4">
                        {{ generator.serial }}
                    </td>
                    <td class="whitespace-nowrap px-6 py-4">
                        {{ generator.brand }}
                    </td>
                    <td class="whitespace-nowrap px-6 py-4">
                        {{ generator.model }}
                    </td>
                    <td class="whitespace-nowrap px-6 py-4">
                        {{ generator.hourmeter }}
                    </td>
                    <td class="whitespace-nowrap px-6 py-4">
                        <Link :href="route('generators.edit', generator.id)"
                            class="font-medium text-blue-600 dark:text-blue-500 hover:underline"> Edit </Link>
                        <button @click="confirmGeneratorDeletion(generator.id)"
                            class="font-medium text-red-500 dark:text-red-500 hover:underline"> Delete </button>
                    </td>
                </tr>
            </Table>
            <Pagination :links="generators.links"></Pagination>
            <Modal :show="confirmingGeneratorDeletion" @close="closeModal">
                <div class="p-6">
                    <h2 class="text-lg font-medium text-gray-900">
                        Are you sure you want to delete your account?
                    </h2>

                    <p class="mt-1 text-sm text-gray-600">
                        Once your account is deleted, all of its resources and data will be permanently deleted. Please
                        enter your password to confirm you would like to permanently delete your account.
                    </p>

                    <div class="mt-6 flex justify-end">
                        <SecondaryButton @click="closeModal"> Cancelar </SecondaryButton>

                        <DangerButton class="ml-3" :class="{ 'opacity-25': form.processing }" :disabled="form.processing"
                            @click="deleteGenerator">
                            Excluir
                        </DangerButton>
                    </div>
                </div>
            </Modal>
        </section>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Table from '@/Components/Table.vue';
import { Link, useForm, usePage } from '@inertiajs/vue3';
import Modal from '@/Components/Modal.vue';
import DangerButton from '@/Components/DangerButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import { ref } from 'vue';
import Pagination from '@/Components/Pagination.vue';
import SearchBar from '@/Components/SearchBar.vue';

defineProps({
    generators: {
        type: Object,
    },
    filters: String,
});

const page = usePage();

console.log(page.props);

const confirmingGeneratorDeletion = ref(false);
let registerId = ref(null);

const form = useForm({});

const confirmGeneratorDeletion = (id) => {
    confirmingGeneratorDeletion.value = true;
    registerId = id;
};

const deleteGenerator = () => {
    form.delete(route('generators.destroy', registerId), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onFinish: () => form.reset(),
    });
};

const closeModal = () => {
    confirmingGeneratorDeletion.value = false;
    registerId.value = false;

    form.reset();
};
</script>

<style lang="scss" scoped></style>