<template>
    <div class="overflow-x-auto border rounded-xl ml-5 shadow-2xl">
        <div class="min-w-full">
            <table class="table-auto w-50 ">
                <thead class="bg-gray-400">
                <tr class="text-left">
                    <th class="px-4 py-2" colspan="4">Pending Transactions</th> <!-- Assuming there are 4 columns -->
                </tr>
                </thead>
                <tbody>
                <tr v-for="(transaction, index) in pendingTransactions" :key="index" class="bg-gray-100 border-b border-gray-200">
                    <td class="px-4 py-2">{{ transaction.id }}</td>
                    <td class="px-4 py-2">{{ transaction.amount }}</td>
                    <td class="px-4 py-2">{{ transaction.date }}</td>
                    <td class="px-4 py-2">
                        <button @click="acceptTransaction(transaction)" class="bg-gray-500 hover:bg-gray-400 text-white font-bold py-1 px-2 rounded">
                            <v-icon name="hi-check" />
                        </button>
                        <button @click="acceptTransaction(transaction)" class="bg-gray-500 hover:bg-gray-400 text-white font-bold py-1 px-2 rounded ml-2">
                            <v-icon name="bi-x-lg" />
                        </button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';

// Sample pending transactions data
const pendingTransactions = ref([
    { id: 'Transaction1', amount: '$100', date: '2024-03-15' },
    { id: 'Transaction2', amount: '$150', date: '2024-03-16' },
    { id: 'Transaction3', amount: '$200', date: '2024-03-17' },
    { id: 'Transaction4', amount: '$200', date: '2024-03-17' },
    { id: 'Transaction5', amount: '$200', date: '2024-03-17' }
]);

// Method to handle accepting a transaction
const acceptTransaction = (transaction) => {
    // Handle accept action
    console.log('Accepted transaction:', transaction);
};

// Method to handle declining a transaction
const declineTransaction = (transaction) => {
    // Handle decline action
    console.log('Declined transaction:', transaction);
};
</script>

<style>
/* You can add custom styles here */
</style>
