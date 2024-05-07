<template>
    <div class="w-full mt-14 shadow-2xl">
        <div class="overflow-y-hidden rounded-xl border">
            <div class="overflow-auto">
                <table class="w-full text-sm text-left rtl:text-right">
                    <thead class="text-md text-gray-700 bg-gray-50 dark:bg-gray-700 dark:text-gray-400 border-b-2 border-gray-500">
                    <!-- Payment History Title -->
                    <tr class="bg-emerald-400 text-left text-lg font-semibold uppercase tracking-widest text-white">
                        <th colspan="4" class="px-5 py-3">Payment History</th>
                    </tr>
                    <!-- Search and Filter Options -->
                    <tr class="text-center">
                        <!-- Account Email Search -->
                        <th class="py-3 px-3 border-r-2 border-gray-500">
                            <input type="text" placeholder="Search by Account Email" class="w-full border p-2 rounded-md focus:outline-none text-emerald-400 placeholder-emerald-400">
                        </th>
                        <!-- Date Filter -->
                        <th class="py-3 px-3 border-r-2 border-gray-500 flex justify-around">
                            <p class="text-xl text-gray-500">Date</p>

                            <div>
                                <button class="border p-2 rounded-md focus:outline-none text-emerald-400 hover:bg-emerald-200">Desc</button>
                                <button class="ml-2 border p-2 rounded-md focus:outline-none text-emerald-400 hover:bg-emerald-200">Asc</button>
                            </div>
                        </th>
                        <!-- Amount Filter -->
                        <th class="py-3 px-3 border-r-2 border-gray-500">
                            <select class="w-full border p-2 rounded-md focus:outline-none text-emerald-400">
                                <option value="" selected disabled>Select Transaction Type</option>
                                <option value="received">Received</option>
                                <option value="sent">Sent</option>
                            </select>
                        </th>
                        <!-- Status Filter -->
                        <th class="py-3 px-3">
                            <select class="w-full border p-2 rounded-md focus:outline-none text-emerald-400">
                                <option value="" selected disabled>Select Status</option>
                                <!-- Add status options here -->
                            </select>
                        </th>
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
<script setup>
import TransactionListItem from "@/Components/TransactionListItem.vue";
</script>
