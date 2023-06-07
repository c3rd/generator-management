<template>
    <Head title="Adicionar Cliente" />
    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center gap-5">
                <GoBack />
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ pageProps.customer ? 'Editar Cliente' :
                    'Adicionar Cliente' }}</h2>
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
                        <InputLabel for="birth_date" value="Número de Identificação" />
                        <TextInput id="identification_number" v-maska data-maska="['###.###.###-##', '##.###.###-#']" type="text" class="mt-1 w-full" v-model="form.identification_number" required/>
                        <InputError class="mt-2" :message="form.errors.identification_number" />

                        <InputLabel for="rg" value="RG" />
                        <input type="radio" name="identification_number" id="rg" value="rg">
                        <InputLabel for="cpf" value="CPF" />
                        <input type="radio" name="identification_number" id="cpf" value="cpf">
                    </div>
                    <div class="mt-5">
                        <InputLabel for="email" value="email" />
                        <TextInput  id="email" type="email" class="mt-1 w-full"
                            v-model="form.email" required />
                        <InputError class="mt-2" :message="form.errors.email" />

                    </div>
                    <div class="mt-5">
                        <InputLabel for="phone_number" value="Telefone" />
                        <TextInput  id="phone_number" type="text" class="mt-1 w-full"
                            v-model="form.phone_number" required />
                        <InputError class="mt-2" :message="form.errors.phone_number" />

                    </div>
                    <div class="mt-5">
                        <InputLabel for="cep" value="Cep" />
                        <TextInput id="cep" type="text" class="mt-1 w-full"
                            v-model="form.cep" required />
                        <InputError class="mt-2" :message="form.errors.cep" />
                    </div>
                    <div class="flex justify-center">
                        <PrimaryButton class="mt-10 ml-4" :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing">{{ pageProps.customer ? 'Atualizar' : 'Adicionar' }}
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
import '@vuepic/vue-datepicker/dist/main.css';
import { vMaska } from "maska"

const pageProps = usePage().props;

const form = useForm({
    first_name: pageProps.customer ? pageProps.customer.first_name : '',
    last_name: pageProps.customer ? pageProps.customer.last_name : '',
    birth_date: pageProps.customer ? pageProps.customer.identification_number : '',
    birth_date: pageProps.customer ? pageProps.customer.identification_type : '',
    monthly_rate: pageProps.customer ? pageProps.customer.email : '',
    cpf: pageProps.customer ? pageProps.customer.phone_number : '',
    start_date: pageProps.customer ? pageProps.customer.cep : null,
    end_date: pageProps.customer ? pageProps.customer.address : null,
    end_date: pageProps.customer ? pageProps.customer.address_number : null,
    end_date: pageProps.customer ? pageProps.customer.address_info : null,
    end_date: pageProps.customer ? pageProps.customer.city : null,
    end_date: pageProps.customer ? pageProps.customer.uf : null,
});

const submit = () => {
    if (pageProps.customer) {
        form.put(route('customers.update', pageProps.customer.id));
    } else {
        form.post(route('customers.store'));
    }
};

</script>
