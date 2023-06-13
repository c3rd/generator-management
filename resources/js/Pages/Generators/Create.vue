<template>
    <Head title="Adicionar Gerador" />
    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center gap-5">
                <GoBack />
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ pageProps.generator ? 'Editar Gerador' :
                    'Adicionar Gerador' }}</h2>
            </div>
        </template>
        <div class="container py-12">
            <div class="bg-white rounded-lg p-10">
                <form @submit.prevent="submit">
                    <div>
                        <InputVue id="serial" label-text="Número de Série*" v-model="form.serial" autofocus />
                        <InputError class="mt-2" :message="form.errors.serial" />
                    </div>
                    <div class="mt-5">
                        <InputVue id="brand" label-text="Marca*" v-model="form.brand" />
                        <InputError class="mt-2" :message="form.errors.brand" />
                    </div>
                    <div class="mt-5">
                        <InputVue id="model" label-text="Modelo*" v-model="form.model" />
                        <InputError class="mt-2" :message="form.errors.model" />
                    </div>
                    <div class="mt-5">
                        <InputVue id="hourmeter" label-text="Horímetro*" v-model="form.hourmeter" />
                        <InputError class="mt-2" :message="form.errors.hourmeter" />
                    </div>
                    <div class="flex justify-center">
                        <PrimaryButton class="mt-5 ml-4" :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing">{{ pageProps.generator ? 'Atualizar' : 'Adicionar' }}
                        </PrimaryButton>
                    </div>
                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, Link, usePage } from '@inertiajs/vue3';
import InputVue from '@/Components/Input.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import GoBack from '@/Components/GoBack.vue';

const pageProps = usePage().props;

const form = useForm({
    serial: pageProps.generator ? pageProps.generator.serial : '',
    brand: pageProps.generator ? pageProps.generator.brand : '',
    model: pageProps.generator ? pageProps.generator.model : '',
    hourmeter: pageProps.generator ? pageProps.generator.hourmeter : ''
});

const submit = () => {
    if (pageProps.generator) {
        form.put(route('generators.update', pageProps.generator.id));
    } else {
        form.post(route('generators.store'));
    }
};

</script>
