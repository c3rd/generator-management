<template>
    <Head title="Adicionar Funcionário" />
    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center gap-5">
                <GoBack />
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ pageProps.employee ? 'Editar Funcionário' :
                    'Adicionar Funcionário' }}</h2>
            </div>
        </template>
        <div class="container py-12">
            <div class="bg-white rounded-lg p-10">
                <form @submit.prevent="submit">
                    <div>
                        <InputLabel for="firstName" value="Nome" />
                        <TextInput id="firstName" type="text" class="mt-1 w-full" v-model="form.firstName" required autofocus/>
                        <InputError class="mt-2" :message="form.errors.firstName" />

                    </div>
                    <div class="mt-5">
                        <InputLabel for="lastName" value="Sobrenome" />
                        <TextInput id="lastName" type="text" class="mt-1 w-full" v-model="form.lastName" required />
                        <InputError class="mt-2" :message="form.errors.lastName" />

                    </div>
                    <div class="mt-5">
                        <InputLabel for="birthDate" value="Data de Nascimento" />
                        <TextInput id="birthDate" type="text" class="mt-1 w-full" v-model="form.birthDate" required />
                        <InputError class="mt-2" :message="form.errors.birthDate" />

                    </div>
                    <div class="mt-5">
                        <InputLabel for="cpf" value="Cpf" />
                        <TextInput id="cpf" type="text" class="mt-1 w-full" v-model="form.cpf" required />
                        <InputError class="mt-2" :message="form.errors.cpf" />

                    </div>
                    <div class="mt-5">
                        <InputLabel for="monthlyRate" value="Salário" />
                        <TextInput id="monthlyRate" type="text" class="mt-1 w-full" v-model="form.monthlyRate" required />
                        <InputError class="mt-2" :message="form.errors.monthlyRate" />

                    </div>
                    <div class="flex justify-center">
                        <PrimaryButton class="mt-5 ml-4" :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing">{{ pageProps.employee ? 'Atualizar' : 'Adicionar' }}
                        </PrimaryButton>
                    </div>
                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, usePage } from '@inertiajs/vue3';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import GoBack from '@/Components/GoBack.vue';

const pageProps = usePage().props;

const form = useForm({
    firstName: pageProps.employee ? pageProps.employee.first_name : null,
    lastName: pageProps.employee ? pageProps.employee.last_name : null,
    birthDate: pageProps.employee ? pageProps.employee.birth_date : null,
    monthlyRate: pageProps.employee ? pageProps.employee.monthly_rate : null,
    cpf: pageProps.employee ? pageProps.employee.cpf : null,
});

const submit = () => {
    if (pageProps.employee) {
        form.put(route('employees.update', pageProps.employee.id));
    } else {
        form.post(route('employees.store'));
    }
};

</script>
