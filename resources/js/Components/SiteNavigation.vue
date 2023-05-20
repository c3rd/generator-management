<template>
    <header class="sticky top-0 bg-black shadow-lg">
        <nav class="container flex flex-col sm:flex-row items-center gap-4 text-white py-6">
            <Link :href="route('login')"> Página Inicial </Link>
            <Link :href="route('login')"> Sobre Nós </Link>
            <Link :href="route('login')"> Serviços </Link>
            <Link :href="route('login')"> Contato </Link>
        </nav>
    </header>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
</script>

<style lang="scss" scoped>

</style>