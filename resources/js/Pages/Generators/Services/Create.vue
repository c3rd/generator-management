<template>
    <Head title="Adicionar Cliente" />
    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center gap-5">
                <GoBack />
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ pageProps.service ? 'Editar Serviço' :
                    'Adicionar Serviço' }}</h2>
            </div>
        </template>
        <div class="container py-12">
            <div class="bg-white rounded-lg p-10">
                <form @submit.prevent="submit">
                    <div class="mt-5 flex items-center justify-between gap-5">
                        <div class="w-1/3">
                            <InputVue id="name" label-text="Descrição*" v-model="form.name" />
                            <InputError class="mt-2" :message="form.errors.name" />

                        </div>
                        <div class="w-2/3">
                            <InputVue id="hourmeter" label-text="Horímetro*" v-model="form.hourmeter" v-maska data-maska="9.99#,##" data-maska-tokens="9:[0-9]:repeated" data-maska-reversed />
                            <InputError class="mt-2" :message="form.errors.hourmeter" />
                        </div>
                    </div>

                    <div class="mt-5">
                        <InputLabel for="service_date" value="Data do Serviço" />
                        <VueDatePicker placeholder="Selecione a data do serviço" close-on-scroll
                            v-model="form.service_date" auto-apply :enable-time-picker="false" format="dd/MM/yyyy" model-type="yyyy-MM-dd"/>
                        <InputError class="mt-2" :message="form.errors.service_date" />
                        
                        <div class="flex items-center justify-center gap-2 w-1/3">
                            <InputLabel for="next_service_date" value="Data" />
                            <input type="radio" name="next_service_type" id="next_service_date" value="next_service_date"
                                v-model="form.next_service_type" checked>
                            <InputLabel for="next_service_hourmeter" value="Horímetro" />
                            <input type="radio" name="next_service_type" id="next_service_hourmeter" value="next_service_hourmeter"
                                v-model="form.next_service_type">
                        </div>

                        <div v-if="form.next_service_type === 'next_service_date'">
                            <VueDatePicker placeholder="Selecione a data do próximo serviço" close-on-scroll
                                v-model="form.next_service" auto-apply :enable-time-picker="false" format="dd/MM/yyyy" model-type="yyyy-MM-dd"/>
                            <InputError class="mt-2" :message="form.errors.next_service" />
                        </div>
                        <div v-else>
                            <InputVue id="next_service_hourmeter" label-text="Horímetro" v-model="form.next_service_hourmeter" />
                            <InputError class="mt-2" :message="form.errors.next_service_hourmeter" />
                        </div>
                    </div>
                    <div class="mt-5 flex items-center justify-between gap-5">
                        <div class="w-2/3">
                            <select name="employee" id="employee" v-model="form.employee_id">
                                <option v-for="employee in employees" :value="employee.id">
                                    {{ employee.full_name }}
                                </option>
                            </select>
                            <InputError class="mt-2"
                                :message="form.errors.identification_type ? form.errors.identification_type : form.errors.identification_number" />
                        </div>
                    </div>
                    <div class="flex justify-center">
                        <PrimaryButton class="mt-10 ml-4" :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing">{{ pageProps.service ? 'Atualizar' : 'Adicionar' }}
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
import InputVue from '@/Components/Input.vue';
import VueDatePicker from '@vuepic/vue-datepicker';
import { vMaska } from "maska";
import '@vuepic/vue-datepicker/dist/main.css';

const pageProps = usePage().props;

const form = useForm({
    name: pageProps.service ? pageProps.service.name : '',
    hourmeter: pageProps.service ? parseFloat(pageProps.employee.hourmeter).toFixed(2) : '',
    next_service_hourmeter: pageProps.service ? parseFloat(pageProps.employee.next_service_hourmeter).toFixed(2) : '',
    next_service_date: pageProps.service ? pageProps.service.next_service_date : '',
    employee_id: pageProps.service ? pageProps.service.employee_id : '',
    generator_id: pageProps.service ? pageProps.service.generator_id : '',
});

const submit = () => {
    if (pageProps.service) {
        form.put(route('services.update', pageProps.service.id));
    } else {
        form.post(route('services.store'));
    }
};

</script>
