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
                        <InputVue id="first_name" label-text="Nome*" v-model="form.first_name" autofocus />
                        <InputError class="mt-2" :message="form.errors.first_name" />
                    </div>
                    <div class="mt-5">
                        <InputVue id="last_name" label-text="Sobrenome*" v-model="form.last_name" />
                        <InputError class="mt-2" :message="form.errors.last_name" />
                    </div>
                    <div class="mt-5">
                        <InputVue v-model="form.birth_date" label-text="Data de Nascimento" onfocus="(this.type='date')"
                            onfocusout="(this.value == '' ? this.type='text' : this.type='date')" />
                        <InputError class="mt-2" :message="form.errors.birth_date" />

                    </div>
                    <div class="mt-5">
                        <InputVue v-maska data-maska="###.###.###-##" id="cpf" label-text="Cpf*" v-model="form.cpf" />
                        <InputError class="mt-2" :message="form.errors.cpf" />
                    </div>
                    <div class="mt-5">
                        <InputVue v-maska data-maska="9.99#,##" data-maska-tokens="9:[0-9]:repeated" data-maska-reversed
                            id="monthly_rate" label-text="Salário*" v-model="form.monthly_rate" />
                        <InputError class="mt-2" :message="form.errors.monthly_rate" />
                    </div>
                    <div class="flex justify-between gap-5">
                        <div class="mt-5 w-full">
                            <InputVue v-model="form.start_date" label-text="Data de Inicio" onfocus="(this.type='date')"
                                onfocusout="(this.value == '' ? this.type='text' : this.type='date')" />
                            <InputError class="mt-2" :message="form.errors.start_date" />
                        </div>
                        <div class="mt-5 w-full">
                            <InputVue v-model="form.end_date" label-text="Data do Fim" onfocus="(this.type='date')"
                                onfocusout="(this.value == '' ? this.type='text' : this.type='date')" />
                            <InputError class="mt-2" :message="form.errors.end_date" />
                        </div>
                    </div>
                    <div class="flex justify-center">
                        <PrimaryButton class="mt-10 ml-4" :class="{ 'opacity-25': form.processing }"
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
import InputVue from '@/Components/Input.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import GoBack from '@/Components/GoBack.vue';
import { vMaska } from "maska"

const pageProps = usePage().props;

const form = useForm({
    first_name: pageProps.employee ? pageProps.employee.first_name : '',
    last_name: pageProps.employee ? pageProps.employee.last_name : '',
    birth_date: pageProps.employee ? pageProps.employee.birth_date : '',
    monthly_rate: pageProps.employee ? parseFloat(pageProps.employee.monthly_rate).toFixed(2) : '',
    cpf: pageProps.employee ? pageProps.employee.cpf : '',
    start_date: pageProps.employee ? pageProps.employee.start_date : '',
    end_date: pageProps.employee ? pageProps.employee.end_date : null,
});

const submit = () => {
    if (pageProps.employee) {
        form.put(route('employees.update', pageProps.employee.id));
    } else {
        form.post(route('employees.store'));
    }
};

</script>
