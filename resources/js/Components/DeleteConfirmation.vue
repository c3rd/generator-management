<template>
    <Modal :show="isModalOpen" @close="closeModal">
        <div class="p-6">
            <h2 class="text-lg font-medium text-gray-900">
                <slot name="title"></slot>
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                <slot></slot>
            </p>

            <div class="mt-6 flex justify-end">
                <SecondaryButton @click="closeModal"> Cancelar </SecondaryButton>

                <DangerButton class="ml-3" :class="{ 'opacity-25': form.processing }" :disabled="form.processing"
                    @click="confirmDeletion">
                    Excluir
                </DangerButton>
            </div>
        </div>
    </Modal>
</template>

<script setup>
import Modal from './Modal.vue';
import SecondaryButton from './SecondaryButton.vue';
import DangerButton from './DangerButton.vue';

const props = defineProps({
    registerId: Number,
    isModalOpen: Boolean,
    form: Object,
})

const emit = defineEmits([
    'confirmDeletion',
    'closeModal'
]);

const confirmDeletion = () => {
    emit('confirmDeletion');
}

const closeModal = () => {
    emit('closeModal');
};

</script>

<style lang="scss" scoped></style>