<script setup>
defineProps({
    type: {
        type: String,
        default: 'submit',
    },
});
</script>

<template>
    <button :type="type" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-emerald-400/10 border border-transparent rounded-md font-semibold text-xs text-white dark:text-emerald-400  tracking-widest hover:bg-gray-700 dark:hover:bg-emerald-400 dark:hover:text-emerald-800 focus:bg-gray-700 dark:focus:bg-emerald-400/10 active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
        <slot />
    </button>
</template>
