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
                        <InputLabel for="first_name" value="Nome" />
                        <TextInput id="first_name" type="text" class="mt-1 w-full" v-model="form.first_name" required
                            autofocus />
                        <InputError class="mt-2" :message="form.errors.first_name" />

                    </div>
                    <div class="mt-5">
                        <InputLabel for="last_name" value="Sobrenome" />
                        <TextInput id="last_name" type="text" class="mt-1 w-full" v-model="form.last_name" required />
                        <InputError class="mt-2" :message="form.errors.last_name" />

                    </div>
                    <div class="mt-5">
                        <InputLabel for="birth_date" value="Data de Nascimento" />
                        <VueDatePicker placeholder="Selecione a data de nascimento" close-on-scroll
                            v-model="form.birth_date" auto-apply :enable-time-picker="false" model-type="yyyy-MM-dd" />
                        <InputError class="mt-2" :message="form.errors.birth_date" />

                    </div>
                    <div class="mt-5">
                        <InputLabel for="cpf" value="Cpf" />
                        <TextInput v-maska data-maska="###.###.###-##" id="cpf" type="text" class="mt-1 w-full"
                            v-model="form.cpf" required />
                        <InputError class="mt-2" :message="form.errors.cpf" />

                    </div>
                    <div class="mt-5">
                        <InputLabel for="monthly_rate" value="Salário" />
                        <CurrencyInput :modelValue="form.monthly_rate" @update:modelValue="newValue => form.monthly_rate = newValue.replace('.', '').replace(',', '.')">

                        </CurrencyInput>
                        <InputError class="mt-2" :message="form.errors.monthly_rate" />
                    </div>
                    <div class="flex justify-between gap-5">
                        <div class="mt-5 w-full">
                            <InputLabel for="start_date" value="Data Início" />
                            <VueDatePicker placeholder="Selecione a data de início" close-on-scroll
                                v-model="form.start_date" auto-apply :enable-time-picker="false" model-type="yyyy-MM-dd" />
                            <InputError class="mt-2" :message="form.errors.start_date" />
                        </div>
                        <div class="mt-5 w-full">
                            <InputLabel for="end_date" value="Data Final" />
                            <VueDatePicker placeholder="Selecione a data de término" close-on-scroll v-model="form.end_date"
                                auto-apply :enable-time-picker="false" model-type="yyyy-MM-dd" />
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
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import GoBack from '@/Components/GoBack.vue';
import VueDatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css';
import { vMaska } from "maska"
import CurrencyInput from '@/Components/CurrencyInput.vue';

const pageProps = usePage().props;

const form = useForm({
    first_name: pageProps.employee ? pageProps.employee.first_name : '',
    last_name: pageProps.employee ? pageProps.employee.last_name : '',
    birth_date: pageProps.employee ? pageProps.employee.birth_date : '',
    monthly_rate: pageProps.employee ? parseFloat(pageProps.employee.monthly_rate).toFixed(2) : '',
    cpf: pageProps.employee ? pageProps.employee.cpf : '',
    start_date: pageProps.employee ? pageProps.employee.start_date : null,
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
