<template>
    <div class="w-full mt-14 shadow-xl">
        <div class="overflow-y-hidden rounded-xl border">
            <div class="overflow-auto">
                <table class="w-full text-sm text-left rtl:text-right overflow-hidden">
                    <thead class="text-md text-gray-700 bg-gray-50 dark:bg-gray-700 dark:text-gray-400 border-b-2 border-gray-200">
                    <!-- Payment History Title -->
                    <tr class="bg-emerald-400 text-left text-xl font-bold uppercase tracking-wider text-white">
                        <th colspan="4" class="px-6 py-3">Transactions History</th>
                    </tr>
                    <!-- Search and Filter Options -->
                    <tr class="text-center">
                        <!-- Account Email Search -->
                        <th class="py-3 px-3 border-r-2 border-gray-200">
                            <input v-model="filters.email" @input="applyFilters" type="text" placeholder="Search By Account Email" class="w-full border p-2 rounded-md focus:outline-none text-gray-400 placeholder-gray-400 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-gray-400 dark:focus:border-indigo-600 focus:ring-gray-400 dark:focus:ring-indigo-600 shadow-sm">
                        </th>
                        <!-- Date Filter -->
                        <th class="py-3 px-3 border-r-2 border-gray-200">
                            <div class="w-full flex items-center justify-around">
                            <p class="text-lg text-gray-400 py-1">Created Date</p>
                            <div class="flex flex-col text-gray-400  cursor-pointer">
<!--                                <v-icon name="md-keyboardarrowup-round" class="w-5 h-5" />-->
<!--                                <v-icon name="md-keyboardarrowdown-round" class="w-5 h-5" />-->
                                <button @click="toggleSortDirection" class="text-gray-400 cursor-pointer">
                                    <v-icon :name="sortDirection === 'asc' ? 'md-keyboardarrowup-round' : 'md-keyboardarrowdown-round'" class="w-8 h-8" />
                                </button>
                            </div>
                            </div>
                        </th>
                        <!-- Amount Filter -->
                        <th class="py-3 px-3 border-r-2 border-gray-200">
                            <select v-model="filters.received" @change="applyFilters" class="w-full border p-2 rounded-md focus:outline-none text-gray-400 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-gray-400 dark:focus:border-indigo-600 focus:ring-gray-400 dark:focus:ring-indigo-600 shadow-sm">
                                <option value="" selected disabled>Select Transaction Type</option>
                                <option :value="null">All</option>
                                <option :value="true">Received</option>
                                <option :value="false">Sent</option>
                            </select>
                        </th>
                        <!-- Status Filter -->
                        <th class="py-3 px-3">
                            <select v-model="filters.status" @change="applyFilters" class="w-full border p-2 rounded-md focus:outline-none text-gray-400 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-gray-400 dark:focus:border-indigo-600 focus:ring-gray-400 dark:focus:ring-indigo-600 shadow-sm">
                                <option value="" selected disabled>Select Status</option>
                                <option value="<>">All</option>
                                <option value="refunded">Refunded</option>
                                <option value="pending">Pending</option>
                                <option value="completed">Completed</option>
                            </select>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <TransactionListItem v-for="transaction in filteredTransactions" :key="transaction" :transaction="transaction" :account="$props.currentAccount"/>
                    </tbody>
                    <Pagination :links="filteredLinks" @pageChange="fetchTransactions"/>
                </table>
            </div>
        </div>
    </div>
</template>
<script setup>
import TransactionListItem from "@/Components/TransactionListItem.vue";
import Pagination from "@/Pages/DashboardPartials/Pagination.vue";
import {defineProps, ref} from 'vue';

const props = defineProps(['currentAccount', 'transactions', 'links']);


const filters = ref({
    email: '',
    received: '',
    status: ''
});

const sortDirection = ref('desc');
const filteredTransactions = ref(props.transactions);
const filteredLinks = ref(props.links);


const toggleSortDirection = () => {
    sortDirection.value = sortDirection.value === 'asc' ? 'desc' : 'asc';
    applyFilters();
};

const applyFilters = async () => {
    const filterData = {
        email: filters.value.email,
        received: filters.value.received,
        status: filters.value.status,
        sortOrder: sortDirection.value
    };

    try {
        const response = await axios.post('/dashboard/filters', filterData);
        console.log('Filters applied successfully:', response.transactions);
        filteredTransactions.value = response.data.data;
        filteredLinks.value = response.data.links;
    } catch (error) {
        console.error('Error applying filters:', error);
    }
};

const fetchTransactions = async (pageUrl) => {
    try {
        const response = await axios.get(pageUrl);
        console.log('Fetched transactions successfully:', response.data);
        filteredTransactions.value = response.data.data;
        filteredLinks.value = response.data.links;
    } catch (error) {
        console.error('Error fetching transactions:', error);
    }
};
</script>

