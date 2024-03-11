<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
</script>

<template>
    <AppLayout title="Dashboard">
<!--                <template #header>-->
<!--                    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">-->
<!--                        Dashboard-->
<!--                    </h2><br>-->
<!--                </template>-->

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                    <h2>=== Backend Testing playground ===</h2><br><br>

                    <div class="flex justify-between">
                        <div>
                            <section>
                                <h3 style="color: white">Your balance: </h3>
                                <h3 style="color: grey">${{ $props.currentAccount.balance }}</h3>
                            </section>
                            <br><br>

                            <section>
                                <form @submit="submit">
                                    <label for="amount" style="padding-right: 5px; color: grey;">Enter amount to
                                        transfer:</label><br>
                                    <input type="number" id="amount" name="amount" v-model="form.amount"> <br>
                                    <label for="email" style="padding-right: 5px; color: grey;">Enter receiver
                                        email:</label><br>
                                    <input type="email" id="email" name="email" v-model="form.email"><br>
                                    <button type="submit" style=" border: 1px solid grey; margin-top: 5px">Send
                                    </button>
                                </form>
                            </section>
                        </div>
                        <section>
                            <h2 class="font-bold text-2xl text-emerald-400">Sent Transactioons: </h2>

                            <ul>
                                <li v-for="(transaction, index) in sentTransactions" :key="index">
                                    <div class="border border-gray-600 mb-3">
                                        <p>Transaction senderId: {{ transaction.from_account_id }}</p>
                                        <p>Transaction receiverId: {{ transaction.to_account_id }}</p>
                                        <p>Amount: {{ transaction.amount }}</p>
                                        <p>Status: {{ transaction.status }}</p>
                                    </div>
                                </li>
                            </ul>
                        </section>
                        <section>
                            <h2 class="font-bold text-2xl text-emerald-400">Received Transactions: </h2>

                            <ul>
                                <li v-for="(transaction, index) in receivedTransactions" :key="index">
                                    <div class="border border-gray-600 mb-3">
                                        <p>Transaction senderId: {{ transaction.from_account_id }}</p>
                                        <p>Transaction receiverId: {{ transaction.to_account_id }}</p>
                                        <p>Amount: {{ transaction.amount }}</p>
                                        <p>Status: {{ transaction.status }}</p>
                                        <!-- Testing refund functionality -->
                                        <form @submit.prevent="refund(transaction.id)">
                                            <input type="hidden" v-model="transaction.id" name="transactionId">
                                            <button type="submit">Refund</button>
                                        </form>
                                        <form @submit.prevent="complete(transaction.id)">
                                            <input type="hidden" v-model="transaction.id" name="transactionId">
                                            <button type="submit">Accept</button>
                                        </form>
                                    </div>
                                </li>
                            </ul>
                        </section>
                        <a class="h-8 overflow-hidden text-md font-medium transition rounded-full py-1 px-3 text-emerald-400 bg-emerald-400/10 ring-1 ring-inset ring-emerald-400/20 hover:bg-emerald-400/10 hover:text-emerald-300 hover:ring-emerald-300"
                           href="/withdraw">Withdraw Money</a>
                        <h1>Converted 20000 MKD to {{ convertedCurrency }} JPY.</h1>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script>
import {useForm} from '@inertiajs/vue3';

const form = useForm({
    amount: '',
    email: '',
});

function submit(e) {
    e.preventDefault(); // Prevent the default form submission
    form.post('/transfer-funds');
}

export default {
    props: {
        currentAccount: Object,
        sentTransactions: Array,
        receivedTransactions: Array,
        convertedCurrency: null
    },
    methods: {
        "refund": function refund(transactionId) {
            this.$inertia.post('/refund-transaction', { transactionId: transactionId });
        },
        "complete": function complete(transactionId) {
            this.$inertia.post('/complete-transaction', { transactionId: transactionId });
        }
    }
}
</script>
