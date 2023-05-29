<template>
    <div class="flex items-center justify-center mb-5">
        <div>
            <nav class="" aria-label="Pagination">
                <Link v-for="link in links" :href="link.url" v-html="link.label" class="bg-slate-300 text-sm px-2 py-1 hover:bg-slate-400">

                </Link>
            </nav>
        </div>
    </div>
</template>
  
<script setup>

import { Link } from '@inertiajs/vue3';

defineProps({
    links: Object,
});
</script>