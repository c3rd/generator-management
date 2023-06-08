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
                    <div class="mt-5 flex items-center justify-between gap-5">
                        <div class="w-1/3">
                            <InputVue id="first_name" label-text="Nome*" v-model="form.first_name" />
                            <InputError class="mt-2" :message="form.errors.first_name" />

                        </div>
                        <div class="w-2/3">
                            <InputVue id="last_name" label-text="Sobrenome*" v-model="form.last_name" />
                            <InputError class="mt-2" :message="form.errors.last_name" />

                        </div>
                    </div>
                    <div class="mt-5 flex items-center justify-between gap-5">
                        <div class="w-2/3">
                            <InputVue id="identification_number" :data-maska="form.identification_type === 'cpf' ? '###.###.###-##' : '##.###.###-#'"
                                label-text="Identidade*" v-model="form.identification_number" />
                            <InputError class="mt-2" :message="form.errors.identification_type ? form.errors.identification_type : form.errors.identification_number" />
                        </div>

                        <div class="flex items-center justify-center gap-2 w-1/3">
                            <InputLabel for="rg" value="RG" />
                            <input type="radio" name="identification_type" id="rg" value="rg"
                                v-model="form.identification_type" checked>
                            <InputLabel for="cpf" value="CPF" />
                            <input type="radio" name="identification_type" id="cpf" value="cpf" v-model="form.identification_type">
                        </div>
                    </div>
                    <div class="flex justify-between gap-5 mt-5">
                        <div class="w-full">
                            <InputVue id="email" label-text="Email*" v-model="form.email" />
                            <InputError class="mt-2" :message="form.errors.email" />

                        </div>
                        <div class="w-full">
                            <InputVue id="phone_number" data-maska="(##) # ####-####" label-text="Telefone"
                                v-model="form.phone_number" />
                            <InputError class="mt-2" :message="form.errors.phone_number" />

                        </div>
                    </div>
                    <div class="mt-5">
                        <InputVue id="cep" data-maska="#####-###" label-text="CEP" v-model="cep" />
                        <InputError class="mt-2" :message="form.errors.cep" />
                    </div>
                    <div class="flex justify-center items-center gap-2 mt-5">
                        <InputVue id="address" class="w-4/5" v-model="form.address" label-text="Endereço" />
                        <InputVue id="address_number" class="w-1/5" v-model="form.address_number" label-text="Nº" />
                    </div>
                    <div class="flex justify-center items-center gap-2 mt-5">
                        <InputVue id="address_info" class="w-full" v-model="form.address_info" label-text="Bairro" />
                        <InputVue id="city" class="w-1/3" v-model="form.city" label-text="Cidade" />
                        <InputVue id="uf" class="w-1/3" v-model="form.uf" label-text="Estado" />
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
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import GoBack from '@/Components/GoBack.vue';
import '@vuepic/vue-datepicker/dist/main.css';
import debounce from "lodash/debounce";
import { watch, ref } from 'vue';
import axios from 'axios';
import InputVue from '@/Components/Input.vue';

const pageProps = usePage().props;

const form = useForm({
    first_name: pageProps.customer ? pageProps.customer.first_name : '',
    last_name: pageProps.customer ? pageProps.customer.last_name : '',
    identification_number: pageProps.customer ? pageProps.customer.identification_number : '',
    identification_type: pageProps.customer ? pageProps.customer.identification_type : '',
    email: pageProps.customer ? pageProps.customer.email : '',
    phone_number: pageProps.customer ? pageProps.customer.phone_number : '',
    cep: pageProps.customer ? pageProps.customer.cep : '',
    address: pageProps.customer ? pageProps.customer.address : '',
    address_number: pageProps.customer ? pageProps.customer.address_number : '',
    address_info: pageProps.customer ? pageProps.customer.address_info : '',
    city: pageProps.customer ? pageProps.customer.city : '',
    uf: pageProps.customer ? pageProps.customer.uf : '',
});

let cep = ref(form.cep);

const submit = () => {
    if (pageProps.customer) {
        form.put(route('customers.update', pageProps.customer.id));
    } else {
        form.post(route('customers.store'));
    }
};

watch(cep, debounce(async function (value) {
    form.cep = cep;
    if (value.length > 0 && value.length < 9) {
        form.errors.cep = "Cep Inválido.";
        return;
    } else {
        form.errors.cep = "";
    }

    if (value.length === 9) {
        try {
            let result = await axios.get(`https://viacep.com.br/ws/${value}/json/`);
            if (result.data.erro === true) {
                form.errors.cep = "Cep Inválido.";
            } else {
                form.address = result.data.logradouro;
                form.address_info = result.data.bairro;
                form.city = result.data.localidade;
                form.uf = result.data.uf;
            }
        } catch (error) {
            form.errors.cep = "Houve um erro na localização pelo cep.";
        }
    }
}, 300));

</script>
