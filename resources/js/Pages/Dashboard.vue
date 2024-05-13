<template>
    <AppLayout title="Dashboard">
        <div>
            <div class="grid grid-cols-1 max-w-7xl mx-auto py-5 sm:px-6 lg:px-8">
                <div class="mt-3">
                    <div class="w-full bg-white rounded-3xl shadow-lg md:flex justify-between pb-5">
                        <div>
                            <div class="pl-10 pt-5 text-5xl font-semibold mb-2 text-cyan-400">Balance:</div>
                            <div class="pl-10 ml-10 mr-10 mt-6 text-6xl font-bold text-gray-400">
                                {{ $props.currentAccount.account.balance.toFixed(2) }}<span
                                class="ml-2 text-3xl">{{ $props.currentAccount.account.currency }}</span></div>

                        </div>
                        <div class="mt-10 w-4/12 mr-10 grid grid-cols-2">
                            <DynamicButton title="Send Money" @click="showModal('Send Money')" class="col-span-2"/>
                            <div class="col-span-1 flex gap-6">
                                <DynamicButton title="Deposit Money" @click="showModal('Deposit Money')"/>
                                <DynamicButton title="Withdraw Money"  @click="showModal('Withdraw Money')"/>
                            </div>
                            <Modal v-if="isModalOpen" @close="closeModal" :title="modalTitle">
                                <template v-if="modalTitle === 'Send Money'">
                                    <TransferFundsForm :closeModal="closeModal" :currency="$props.currentAccount.account.currency"/>
                                </template>
                                <template v-else-if="modalTitle === 'Withdraw Money'">
                                    <CreditCardForm :closeModal="closeModal" :currency="$props.currentAccount.account.currency" path="withdraw"/>
                                </template>
                                <template v-else-if="modalTitle === 'Deposit Money'">
                                    <CreditCardForm :closeModal="closeModal" :currency="$props.currentAccount.account.currency" path="deposit"/>
                                </template>
                            </Modal>
                        </div>
                    </div>
                </div>
                <TransactionsSection :currentAccount="$props.currentAccount" :transactions="$props.transactions.data"
                                     :links="$props.transactions.links"/>
            </div>
        </div>
    </AppLayout>
    <div class="fixed bottom-0 right-0 mr-5 mb-5 z-50">
        <!-- Success message -->
        <div v-if="success" class="bg-emerald-400 text-white font-semibold text-xl px-3 py-2 rounded-md shadow-md ring-4 ring-emerald-400 flex justify-between items-center">
            <v-icon name="md-checkcircleoutline-round" class="h-8 w-8"/>
            <span class="ml-3">{{ success }}</span>
        </div>

        <div v-if="error" class="bg-red-500 text-white font-semibold text-2xl px-3 py-2 rounded-md shadow-md ring-4 ring-red-500 flex justify-between items-center">
            <v-icon name="md-cancel-outlined" class="h-10 w-10"/>
            <span class="ml-3">{{ error }}</span>
        </div>
    </div>
</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import TransactionsSection from "@/Pages/DashboardPartials/TransactionsSection.vue";
import DynamicButton from "@/Components/DynamicButton.vue";
import Modal from "@/Pages/DashboardPartials/Modal.vue";
import CreditCardForm from "@/Components/CreditCardForm.vue";
import TransferFundsForm from "@/Pages/DashboardPartials/TransferFundsForm.vue";


</script>

<script>
export default {
    data() {
        return {
            isModalOpen: false,
            modalTitle: ""
        }
    },
    props: {
        currentAccount: Object,
        transactions: Object,
        success: String,
        error: String
    },
    methods: {
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


