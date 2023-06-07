<template>
    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Clientes</h2>
                <Link :href="route('customers.create')" class="bg-black py-2 px-4 text-white rounded-lg">Adicionar Cliente
                </Link>
            </div>
        </template>
        <section class="flex flex-col items-center justify-center">
            <div v-if="$page.props.flash.message" class="bg-red-500 rounded-md flex justify-between gap-5 py-2 px-10 mt-5">
                <p>
                    {{ $page.props.flash.message }}
                </p>
                <span>X</span>
            </div>
            <SearchBar :filters="filters" />
            <Table>
                <template #thead>
                    <tr>
                        <th scope="col" class="px-6 py-4">
                            Nome Completo
                        </th>
                        <th scope="col" class="px-6 py-4">
                            Identidade
                        </th>
                        <th scope="col" class="px-6 py-4">
                            Email
                        </th>
                        <th scope="col" class="px-6 py-4">
                            Telefone
                        </th>
                        <th scope="col" class="px-6 py-4">
                            Contratos Ativos
                        </th>
                        <th scope="col" class="px-6 py-4">
                            <span class="sr-only">Edit</span>
                        </th>
                    </tr>
                </template>
                <tr v-if="customers.data.length === 0"
                    class="border-b transition duration-100 ease-in-out hover:bg-neutral-100">
                    <td colspan="6" class="">Nenhum
                        registro encontrado.</td>
                </tr>
                <tr v-else v-for="customer in customers.data" @click="viewItem(customer.id)"
                    class="border-b transition duration-100 ease-in-out hover:bg-neutral-200 cursor-pointer">
                    <td scope="row" class="whitespace-nowrap px-6 py-4">
                        {{ customer.full_name }}
                    </td>
                    <td class="whitespace-nowrap px-6 py-4">
                        {{ customer.identification_number }}
                    </td>
                    <td class="whitespace-nowrap px-6 py-4">
                        {{ customer.email }}
                    </td>
                    <td class="whitespace-nowrap px-6 py-4">
                        {{ customer.phone_number }}
                    </td>
                    <td class="whitespace-nowrap px-6 py-4">
                        {{ customer.active_contracts }}
                    </td>
                    <td @click.stop class="whitespace-nowrap px-6 py-4">
                        <Link :href="route('customers.edit', customer.id)"
                            class="font-medium text-blue-600 dark:text-blue-500 hover:underline"> Edit </Link>
                        <button @click="confirmCustomerDeletion(customer.id)"
                            class="font-medium text-red-500 dark:text-red-500 hover:underline"> Delete </button>
                    </td>
                </tr>
            </Table>
            <Pagination :links="customers.links"></Pagination>
            <Modal :show="confirmingCustomerDeletion" @close="closeModal">
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
                            @click="deleteCustomer">
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
import { Link, useForm, usePage, router } from '@inertiajs/vue3';
import Modal from '@/Components/Modal.vue';
import DangerButton from '@/Components/DangerButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import { ref } from 'vue';
import Pagination from '@/Components/Pagination.vue';
import SearchBar from '@/Components/SearchBar.vue';

defineProps({
    customers: {
        type: Object,
    },
    filters: Object,
});

const confirmingCustomerDeletion = ref(false);
let registerId = ref(null);

const form = useForm({});

const confirmCustomerDeletion = (id) => {
    confirmingCustomerDeletion.value = true;
    registerId = id;
};

const deleteCustomer = () => {
    form.delete(route('customers.destroy', registerId), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onFinish: () => form.reset(),
    });
};

const closeModal = () => {
    confirmingcustomerDeletion.value = false;
    registerId.value = false;

    form.reset();
};

const viewItem = (id) => {
    router.get(route('customers.show', id));
}
</script>

<style lang="scss" scoped></style>