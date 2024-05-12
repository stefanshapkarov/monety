<template>
    <form @submit.prevent="submit">
        <div class="mb-4 relative">
            <div class="relative">
                <!-- Search input -->
                <label for="searchQuery" class="block  font-semibold text-gray-500">Account</label>
                <input
                    id="searchQuery"
                    type="text"
                    v-model="searchQuery"
                    @input="onSearchInput"
                    placeholder="Search account"
                    autocomplete="off"
                    class="w-full px-4 py-2 text-sm text-gray-800 placeholder-gray-500 bg-white border border-gray-300 rounded-md shadow-sm dark:bg-gray-900 dark:text-gray-300 dark:placeholder-gray-600 dark:border-gray-700 focus:outline-none focus:ring-emerald-400 focus:border-emerald-400 dark:focus:ring-indigo-600 dark:focus:border-indigo-600"
                />

                <!-- Hidden input to bind form.email to searchQuery -->
                <input name="email" type="hidden" v-model="form.email"/>

                <!-- Search results list -->
                <ul
                    v-if="filteredAccounts.length && !selectedAccount"
                    class="mt-1 bg-white border border-gray-300 rounded-md shadow-lg dark:bg-gray-800 divide-y divide-gray-200  w-full z-10 absolute"
                >
                    <li
                        v-for="account in filteredAccounts"
                        :key="account.id"
                        @click="selectAccount(account)"
                        class="px-4 py-3 text-sm text-gray-800 cursor-pointer hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700 flex justify-items-center items-center"
                    >
                        <div class="h-8 flex-shrink-0">
                            <img class="h-full w-full rounded-full" :src="account.profile_photo_url" alt="Alt text"/>
                        </div>
                        <span class="ml-5">{{ account.name }} - {{ account.email }}</span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="mb-4">
            <label for="amount" class="block font-semibold text-gray-500">Amount</label>
            <input v-model="form.amount" name="amount" type="number" id="amount" step="any"
                   class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm dark:bg-gray-900 dark:text-gray-300 dark:placeholder-gray-600 dark:border-gray-700 focus:outline-none focus:ring-emerald-400 focus:border-emerald-400 dark:focus:ring-indigo-600 dark:focus:border-indigo-600 "/>
        </div>
        <div class="flex justify-end">
            <PrimaryButton>Send</PrimaryButton>
        </div>
    </form>
</template>

<script setup>
import {useForm} from '@inertiajs/vue3';
import {ref} from "vue";
import axios from "axios";
import {defineProps} from 'vue';
import SecondaryButton from "@/Components/SecondaryButton.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

const props = defineProps(['closeModal']);

const form = useForm({
    amount: '',
    email: '',
});

const submit = async (e) => {
    e.preventDefault(); // Prevent the default form submission
    form.post('/transfer-funds', {
        onSuccess: () => {
            props.closeModal();
        },
    });
};

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
    searchQuery.value = account.email;
    form.email = account.email;
};

const onSearchInput = () => {
    selectedAccount.value = null;
    searchAccounts();
    form.email = '';
};
</script>
