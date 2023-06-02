<template>
    <div class="flex items-center justify-center mb-5">
        <div>
            <nav class="" aria-label="Pagination">
                <component :is="link.url && !link.active ? 'Link' : 'span'" v-for="link in links" :href="link.url" v-html="link.label"
                    class="text-gray-900 text-sm px-2 py-1 hover:bg-gray-200" :class="link.active ? 'font-bold bg-gray-200' : ''">

                </component>
            </nav>
        </div>
    </div>
</template>
  
<script setup>

defineProps({
    links: Object,
});
</script>