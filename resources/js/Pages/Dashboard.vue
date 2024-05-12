<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import TransactionsSection from "@/Pages/DashboardPartials/TransactionsSection.vue";
import BalanceSection from "@/Components/BalanceSection.vue";
import PendingTransactions from "@/Components/PendingTransactions.vue";
import SideBar from "@/Components/SideBar.vue";
import SendMoneyButton from "@/Components/SendMoneyButton.vue";
import WithdrawMoneyButton from "@/Components/WithdrawMoneyButton.vue";
import SearchBar from "@/Pages/DashboardPartials/SearchBar.vue";
import Modal from "@/Pages/DashboardPartials/Modal.vue";
import CreditCardForm from "@/Components/CreditCardForm.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import TransferFundsForm from "@/Pages/DashboardPartials/TransferFundsForm.vue";
</script>

<template>
    <AppLayout title="Dashboard">
        <!--                <template #header>-->
        <!--                    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">-->
        <!--                        Dashboard-->
        <!--                    </h2><br>-->
        <!--                </template>-->

        <div>
            <div class="grid grid-cols-1 max-w-7xl mx-auto py-5 sm:px-6 lg:px-8">
                <!--                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">-->
                <!--                    <h2>=== Backend Testing playground ===</h2><br><br>-->

                <!--                    <div class="flex justify-between">-->
                <!--                        <div>-->
                <!--                            <section>-->
                <!--                                <h3 style="color: white">Your balance: </h3>-->
                <!--                                <h3 style="color: grey">${{ $props.currentAccount.balance }}</h3>-->
                <!--                            </section>-->
                <!--                            <br><br>-->

                <!--                            <section>-->
                <!--                                <form @submit="submit">-->
                <!--                                    <label for="amount" style="padding-right: 5px; color: grey;">Enter amount to-->
                <!--                                        transfer:</label><br>-->
                <!--                                    <input type="number" id="amount" name="amount" v-model="form.amount"> <br>-->
                <!--                                    <label for="email" style="padding-right: 5px; color: grey;">Enter receiver-->
                <!--                                        email:</label><br>-->
                <!--                                    <input type="email" id="email" name="email" v-model="form.email"><br>-->
                <!--                                    <button type="submit" style=" border: 1px solid grey; margin-top: 5px">Send-->
                <!--                                    </button>-->
                <!--                                </form>-->
                <!--                            </section>-->
                <!--                        </div>-->
                <!--                        <section>-->
                <!--                            <h2 class="font-bold text-2xl text-emerald-400">Sent Transactioons: </h2>-->

                <!--                            <ul>-->
                <!--                                <li v-for="(transaction, index) in sentTransactions" :key="index">-->
                <!--                                    <div class="border border-gray-600 mb-3">-->
                <!--                                        <p>Transaction senderId: {{ transaction.from_account_id }}</p>-->
                <!--                                        <p>Transaction receiverId: {{ transaction.to_account_id }}</p>-->
                <!--                                        <p>Amount: {{ transaction.fromAmount }}</p>-->
                <!--                                        <p>Status: {{ transaction.status }}</p>-->
                <!--                                    </div>-->
                <!--                                </li>-->
                <!--                            </ul>-->
                <!--                        </section>-->
                <!--                        <section>-->
                <!--                            <h2 class="font-bold text-2xl text-emerald-400">Received Transactions: </h2>-->

                <!--                            <ul>-->
                <!--                                <li v-for="(transaction, index) in receivedTransactions" :key="index">-->
                <!--                                    <div class="border border-gray-600 mb-3">-->
                <!--                                        <p>Transaction senderId: {{ transaction.from_account_id }}</p>-->
                <!--                                        <p>Transaction receiverId: {{ transaction.to_account_id }}</p>-->
                <!--                                        <p>Amount: {{ transaction.toAmount }}</p>-->
                <!--                                        <p>Status: {{ transaction.status }}</p>-->
                <!--                                        &lt;!&ndash; Testing refund functionality &ndash;&gt;-->
                <!--                                        <a :href="'/refund-transaction/' + transaction.id">Refund</a><br>-->
                <!--                                        <a :href="'/complete-transaction/' + transaction.id">Accept</a>-->
                <!--                                    </div>-->
                <!--                                </li>-->
                <!--                            </ul>-->
                <!--                        </section>-->
                <!--                        <a class="h-8 overflow-hidden text-md font-medium transition rounded-full py-1 px-3 text-emerald-400 bg-emerald-400/10 ring-1 ring-inset ring-emerald-400/20 hover:bg-emerald-400/10 hover:text-emerald-300 hover:ring-emerald-300"-->
                <!--                           href="/withdraw">Withdraw Money</a>-->
                <!--                        <h1>Converted 20000 MKD to {{ convertedCurrency }} JPY.</h1>-->
                <!--                    </div>-->
                <!--                </div>-->
                <div class="mt-3">
                    <div class="w-full bg-white rounded-3xl shadow-lg flex justify-between pb-5">
                        <div>
                            <div class="pl-10 pt-5 text-5xl font-semibold mb-2 text-cyan-400">Balance:</div>
                            <div class="pl-10 ml-10 mr-10 mt-6 text-6xl font-bold text-gray-400">
                                {{ $props.currentAccount.account.balance.toFixed(2) }}<span
                                class="ml-2 text-3xl">{{ $props.currentAccount.account.currency }}</span></div>

                        </div>
                        <div class="mt-10 w-4/12 mr-10">
                            <SendMoneyButton @click="showModal('Send Money')"/>
                            <WithdrawMoneyButton @click="showModal('Withdraw Money')"/>
                            <Modal v-if="isModalOpen" @close="closeModal" :title="modalTitle">
                                <template v-if="modalTitle === 'Send Money'">
                                    <TransferFundsForm :closeModal="closeModal"/>
                                </template>
                                <template v-else-if="modalTitle === 'Withdraw Money'">
                                    <CreditCardForm :closeModal="closeModal" :currency="$props.currentAccount.account.currency"/>
                                </template>
                            </Modal>
                        </div>
                    </div>
                </div>
                <SideBar v-if="sidebarActive" :sendMoneyActive="sendMoneyActive" :withdrawActive="withdrawActive"
                         @close="closeSidebar"/>
                <TransactionsSection :currentAccount="$props.currentAccount" :transactions="$props.transactions.data"
                                     :links="$props.transactions.links"/>
            </div>
        </div>
    </AppLayout>
</template>

<script>
// import {useForm} from '@inertiajs/vue3';
//
// const form = useForm({
//     amount: '',
//     email: '',
// });
//
// function submit(e) {
//     e.preventDefault(); // Prevent the default form submission
//     form.post('/transfer-funds');
// }

export default {
    data() {
        return {
            sidebarActive: false,
            sendMoneyActive: false,
            withdrawActive: false,
            isModalOpen: false,
            modalTitle: ""
        }
    },
    props: {
        currentAccount: Object,
        transactions: Object,
        convertedCurrency: null,
    },
    methods: {
        showSendMoney() {
            this.sidebarActive = true;
            this.sendMoneyActive = true;
            this.withdrawActive = false;
        },
        showWithdraw() {
            this.sidebarActive = true;
            this.sendMoneyActive = false;
            this.withdrawActive = true;
        },
        closeSidebar() {
            this.sendMoneyActive = false;
            this.withdrawActive = false;
            this.sidebarActive = false;
        },
        showModal(title) {
            this.modalTitle = title;
            this.isModalOpen = true;
        },
        closeModal() {
            this.isModalOpen = false;
        }
    }
}
</script>
