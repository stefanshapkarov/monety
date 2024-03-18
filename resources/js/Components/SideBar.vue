<template>
    <div class="h-full">
        <!-- Sidebar -->
        <div class="fixed top-16 right-0 h-full w-1/3 bg-white z-50 p-16"
             :class="{ 'translate-x-0': isActive, 'translate-x-full': !isActive }">
            <!-- Content for send money -->
            <div v-if="sendMoneyActive">
                <h2>Send Money Content</h2>
                <form >
                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700">Recipient Email</label>
                        <input type="email" id="email"  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
                    <div class="mb-4">
                        <label for="amount" class="block text-sm font-medium text-gray-700">Amount</label>
                        <input type="number" id="amount"  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
                    <div class="flex justify-end">
                        <button type="submit" class="px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-white hover:bg-indigo-700 focus:outline-none focus:border-indigo-900 focus:ring focus:ring-indigo-200 disabled:opacity-25 transition">Send Money</button>
                    </div>
                </form>
            </div>

            <!-- Content for withdraw -->
            <div v-if="withdrawActive">
                <h2>Withdraw Content</h2>
                    <CreditCardForm />
            </div>
        </div>

        <!-- Dimmer -->
        <transition name="fade">
            <div @click="closeSidebar" v-if="(sendMoneyActive || withdrawActive)"
                 class="fixed top-16 bottom-0 left-0 right-0 bg-neutral-200 opacity-75"></div>
        </transition>
    </div>
</template>

<script>
import CreditCardForm from "@/Components/CreditCardForm.vue";

export default {
    components: {CreditCardForm},
    props: {
        sendMoneyActive: Boolean,
        withdrawActive: Boolean
    },
    computed: {
        isActive() {
            return this.sendMoneyActive || this.withdrawActive;
        }
    },
    methods: {
        closeSidebar() {
            // Emit an event to notify the parent component to close the sidebar
            this.$emit('close');
            this.enableScroll(); // Re-enable scrolling when the sidebar is closed
        },
        disableScroll() {
            // Disable scrolling by setting overflow-y to hidden on the body element
            document.body.style.overflowY = 'hidden';
        },
        enableScroll() {
            // Re-enable scrolling by removing the overflow-y style from the body element
            document.body.style.overflowY = '';
        }
    },
    mounted() {
        // Ensure scrolling is re-enabled if the sidebar is closed while it's active
        if (this.isActive) {
            this.disableScroll();
        }
    }
};
</script>
