<template>
    <Head title="Adicionar Gerador" />
    <AuthenticatedLayout>
        <template #header>
            <div class="flex gap-5">

                <Link :href="route('generators')"><i class="fa-solid fa-info"></i>Voltar</Link>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ pageProps.generator ? 'Editar Gerador' : 'Adicionar Gerador' }}</h2>
            </div>
        </template>
        <div class="container py-12">
            <div class="bg-white rounded-lg p-10">
                <form @submit.prevent="submit">
                    <div>
                        <InputLabel for="serial" value="Serial" />
                        <TextInput id="serial" type="text" class="mt-1 w-full" v-model="form.serial" required autofocus>

                        </TextInput>
                        <InputError class="mt-2" :message="form.errors.serial" />

                    </div>
                    <div class="mt-5">
                        <InputLabel for="brand" value="Marca" />
                        <TextInput id="brand" type="text" class="mt-1 w-full" v-model="form.brand" required>

                        </TextInput>
                        <InputError class="mt-2" :message="form.errors.brand" />

                    </div>
                    <div class="mt-5">
                        <InputLabel for="model" value="Modelo" />
                        <TextInput id="model" type="text" class="mt-1 w-full" v-model="form.model" required>

                        </TextInput>
                        <InputError class="mt-2" :message="form.errors.model" />

                    </div>
                    <div class="mt-5">
                        <InputLabel for="hourmeter" value="Horímetro" />
                        <TextInput id="hourmeter" type="text" class="mt-1 w-full" v-model="form.hourmeter" required>

                        </TextInput>
                        <InputError class="mt-2" :message="form.errors.hourmeter" />

                    </div>
                    <div class="flex justify-center">
                        <PrimaryButton class="mt-5 ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">{{ pageProps.generator ? 'Atualizar' : 'Adicionar' }}</PrimaryButton>
                    </div>
                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, Link, usePage } from '@inertiajs/vue3';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

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
