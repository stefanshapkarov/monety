<template>
    <div class="w-full mt-5 shadow-2xl">
        <div class="overflow-y-hidden rounded-xl border">
            <div class="overflow-auto">
                <table class="w-full text-sm text-left rtl:text-right">
                    <thead class="text-md text-gray-700 bg-gray-50 dark:bg-gray-700 dark:text-gray-400 border-b-2 border-gray-200">
                    <!-- Payment History Title -->
                    <tr class="bg-emerald-400 text-left text-xl font-bold uppercase tracking-wider text-white">
                        <th colspan="4" class="px-5 py-5">Transactions History</th>
                    </tr>
                    <!-- Search and Filter Options -->
                    <tr class="text-center">
                        <!-- Account Email Search -->
                        <th class="py-3 px-3 border-r-2 border-gray-200">
                            <input type="text" placeholder="Search By Account Email" class="w-full border p-2 rounded-md focus:outline-none text-gray-200 placeholder-gray-400 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-gray-400 dark:focus:border-indigo-600 focus:ring-gray-400 dark:focus:ring-indigo-600 shadow-sm">
                        </th>
                        <!-- Date Filter -->
                        <th class="py-3 px-3 border-r-2 border-gray-200">
                            <div class="w-full flex items-center justify-around">
                            <p class="text-xl text-gray-400 py-1">Created Date</p>
                            <div class="flex flex-col text-gray-400  cursor-pointer">
                                <v-icon name="md-keyboardarrowup-round" class="w-5 h-5" />
                                <v-icon name="md-keyboardarrowdown-round" class="w-5 h-5" />
                            </div>
                            </div>
                        </th>
                        <!-- Amount Filter -->
                        <th class="py-3 px-3 border-r-2 border-gray-200">
                            <select class="w-full border p-2 rounded-md focus:outline-none text-gray-400 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-gray-400 dark:focus:border-indigo-600 focus:ring-gray-400 dark:focus:ring-indigo-600 shadow-sm">
                                <option value="" selected disabled>Select Transaction Type</option>
                                <option value="received">Received</option>
                                <option value="sent">Sent</option>
                            </select>
                        </th>
                        <!-- Status Filter -->
                        <th class="py-3 px-3">
                            <select class="w-full border p-2 rounded-md focus:outline-none text-gray-400 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-gray-400 dark:focus:border-indigo-600 focus:ring-gray-400 dark:focus:ring-indigo-600 shadow-sm">
                                <option value="" selected disabled>Select Status</option>
                                <option value="canceled">Canceled</option>
                                <option value="pending">Pending</option>
                                <option value="completed">Completed</option>
                            </select>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <TransactionListItem v-for="transaction in $props.transactions" :key="transaction" :transaction="transaction" :account="$props.currentAccount"/>
                    </tbody>
                </table>
            </div>
        </div>
        <Pagination :links="$props.links"/>
    </div>
</template>
<script setup>;
import TransactionListItem from "@/Components/TransactionListItem.vue";
import Pagination from "@/Pages/DashboardPartials/Pagination.vue";

</script>

<script>
export default {
    props: {
        currentAccount: Object,
        transactions: Array,
        links: Array
    }
}
</script>
