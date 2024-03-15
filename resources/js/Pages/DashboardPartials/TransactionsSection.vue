<script setup>

import TransactionListItem from "@/Components/TransactionListItem.vue";
</script>

<template>
    <div class="w-full mt-14 shadow-2xl">
        <div class="overflow-y-hidden rounded-xl border">
            <div class="overflow-x-auto">
                <table class="w-full table-fixed">
                    <thead>
                    <tr class="bg-emerald-400 text-left text-xs font-semibold uppercase tracking-widest text-white">
                        <th colspan="4" class="px-5 py-3">Payment History</th>
                    </tr>
                    </thead>
                    <tbody class="w-full">
                    <TransactionListItem v-for="index in 5" :key="index" />
                    </tbody>
                </table>
            </div>
            <div class="flex flex-col items-center border-t bg-white px-5 py-5 sm:flex-row sm:justify-between">
                <span class="text-xs text-gray-600 sm:text-sm"> Showing 1 to 5 of 12 Entries </span>
                <div class="mt-2 inline-flex sm:mt-0">
                    <button class="mr-2 h-12 w-12 rounded-full border text-sm font-semibold text-gray-600 transition duration-150 hover:bg-gray-100">Prev</button>
                    <button class="h-12 w-12 rounded-full border text-sm font-semibold text-gray-600 transition duration-150 hover:bg-gray-100">Next</button>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
