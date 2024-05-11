<template>
    <nav class="text-center py-2 bg-cyan-400">
        <template v-for="(link, index) in links" :key="index">
            <inertia-link
                :href="link.url || ''"
                :class="[
          'inline-block py-1 px-3 rounded-lg text-lg mr-1',
          link.active ? 'bg-white text-gray-400' : '',
          !link.active ? 'text-white' : '',
          !link.url ? 'text-white cursor-not-allowed' : 'hover:bg-white hover:text-gray-400'
        ]"
                v-html="link.label"
            ></inertia-link>
        </template>
    </nav>
</template>

<script>
import { defineComponent } from 'vue';
import { Link as InertiaLink } from '@inertiajs/inertia-vue3';

export default defineComponent({
    components: {
        InertiaLink
    },
    props: {
        links: {
            type: Array,
            required: true
        }
    }
});
</script>

<style scoped>
/* Add any scoped styles here */
</style>
