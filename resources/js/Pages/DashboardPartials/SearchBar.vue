<template>
    <div class="relative">
        <!-- Search input -->
        <label for="email" class="">Account</label>
        <input
            id="email"
            type="text"
            v-model="searchQuery"
            @input="onSearchInput"
            placeholder="Search account"
            class="w-full px-4 py-2 text-sm text-gray-800 placeholder-gray-500 bg-white border border-gray-300 rounded-md shadow-sm dark:bg-gray-900 dark:text-gray-300 dark:placeholder-gray-600 dark:border-gray-700 focus:outline-none focus:ring-emerald-400 focus:border-emerald-400 dark:focus:ring-indigo-600 dark:focus:border-indigo-600"
        />

        <!-- Search results list -->
        <ul
            v-if="filteredAccounts.length && !selectedAccount"
            class="mt-1 bg-white border border-gray-300 rounded-md shadow-lg dark:bg-gray-800 divide-y divide-gray-200  w-full"
        >
            <li
                v-for="account in filteredAccounts"
                :key="account.id"
                @click="selectAccount(account)"
                class="px-4 py-3 text-sm text-gray-800 cursor-pointer hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700"
            >
                {{ account.name }} - {{ account.email }}
            </li>
        </ul>
    </div>
</template>

<script>
import { ref } from 'vue';
import axios from 'axios';

export default {
    setup() {
        const searchQuery = ref('');
        const filteredAccounts = ref([]);
        const selectedAccount = ref(null);

        const searchAccounts = async () => {
            try {
                const response = await axios.get('/search/accounts', {
                    params: {
                        query: searchQuery.value
                    }
                });
                filteredAccounts.value = response.data;
            } catch (error) {
                console.error('Error searching accounts:', error);
            }
        };

        const selectAccount = (account) => {
            selectedAccount.value = account;
            // Fill the input field with the selected account's email
            searchQuery.value = account.email;
        };

        const onSearchInput = () => {
            // Reset selectedAccount when the search input changes
            selectedAccount.value = null;
            searchAccounts();
        };

        return { searchQuery, filteredAccounts, searchAccounts, selectAccount, selectedAccount, onSearchInput };
    }
};
</script>
