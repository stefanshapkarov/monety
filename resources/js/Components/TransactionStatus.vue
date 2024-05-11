<template>
    <td class="bg-white px-3" @mouseover="isHovered = true" @mouseleave="isHovered = false">
        <template v-if="$props.transaction.status === 'completed'">
            <div class="h-11 w-full border-2 border-emerald-400 rounded-full bg-white py-2 text-xl font-bold text-center text-emerald-400 flex items-center justify-center">
                <span class="capitalize">{{ $props.transaction.status }}</span>
            </div>
        </template>
        <template v-else-if="$props.transaction.status === 'pending'">
            <template v-if="isHovered && $props.received">
                <div class="h-11 flex">
                    <button class="py-2 bg-emerald-400 dark:bg-emerald-400/10 uppercase border-2 border-white hover:border-emerald-400 dark:border-emerald-400 rounded-md font-semibold text-xs text-white dark:text-emerald-400 tracking-widest hover:bg-emerald-50 hover:text-emerald-400 dark:hover:bg-emerald-400 dark:hover:text-emerald-800 w-full"><a :href="'/complete-transaction/' + $props.transaction.id">Accept</a></button>
                    <button class="py-2 bg-red-600 border-2 border-red-600 rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-50 hover:text-red-600 active:bg-red-700 w-full"><a :href="'/refund-transaction/' + $props.transaction.id">Refund</a></button>
                </div>
            </template>
            <template v-else>
                <div class="h-11 border-2 border-amber-400 rounded-full bg-white py-2 text-xl font-bold text-center text-amber-400 flex items-center justify-center">
                    <span class="capitalize">{{ $props.transaction.status }}</span>
                </div>
            </template>
        </template>
        <template v-else>
            <div class="h-11 border-2 border-red-400 rounded-full bg-white py-2 text-xl font-bold text-center text-red-400 flex items-center justify-center">
                <span class="capitalize">{{ $props.transaction.status }}</span>
            </div>
        </template>
    </td>
</template>

<script setup>
import { ref } from 'vue';
import axios from 'axios';
import SecondaryButton from "@/Components/SecondaryButton.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import DangerButton from "@/Components/DangerButton.vue";

const isHovered = ref(false);

const handleAccept = async () => {
    try {
        const response = await axios.get(`/complete-transaction/${$props.transaction.id}`);
        console.log(response.data); // Handle success response
    } catch (error) {
        console.error(error); // Handle error
    }
};

const handleCancel = async () => {
    try {
        const response = await axios.get(`/refund-transaction/${$props.transaction.id}`);
        console.log(response.data); // Handle success response
    } catch (error) {
        console.error(error); // Handle error
    }
};
</script>

<script>
export default {
    props: {
        transaction: Object,
        received: true
    }
}
</script>

<style scoped>
/* Add your component-specific styles here */
</style>
