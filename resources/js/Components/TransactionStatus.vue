<template>
    <td class="bg-white flex-nowrap pr-2 transition-transform duration-700 hover:scale-x-105" @mouseover="isHovered = true" @mouseleave="isHovered = false">
        <template v-if="$props.transaction.status === 'completed'">
            <template v-if="isHovered && $props.received">
                <div class="flex justify-center transition-transform duration-1000 hover:scale-105 scale-75">
                    <a class="py-2.5 px-2 bg-red-600 hover:ring hover:ring-red-600 rounded-md font-semibold text-xs text-white  tracking-widest hover:bg-red-200 hover:text-red-600 active:bg-red-700 " :href="'/refund-transaction/' + $props.transaction.id">Refund</a>
                </div>
            </template>
            <template v-else>
                <div class="ring-2 ring-emerald-400 rounded-full bg-white text-lg font-bold text-center text-emerald-400" :class="{ 'fade-in': $props.received }">
                    <span class="capitalize">{{ $props.transaction.status }}</span>
                </div>
            </template>
        </template>
        <template v-else-if="$props.transaction.status === 'pending'">
            <template v-if="isHovered && $props.received">
                <div class="flex justify-evenly transition-transform duration-1000 hover:scale-105 scale-75">
                    <a class="py-2.5 px-2 bg-emerald-400 hover:ring hover:ring-emerald-400 rounded-md font-semibold text-xs text-white  tracking-widest hover:bg-white hover:text-emerald-400 active:bg-red-700 " :href="'/complete-transaction/' + $props.transaction.id">Accept</a>
                    <a class="py-2.5 px-2 bg-red-600 hover:ring hover:ring-red-600 rounded-md font-semibold text-xs text-white  tracking-widest hover:bg-red-200 hover:text-red-600 active:bg-red-700 " :href="'/refund-transaction/' + $props.transaction.id">Refund</a>
                </div>
            </template>
            <template v-else>
                <div class="ring-2 ring-amber-400 rounded-full bg-white text-lg font-bold text-center text-amber-400 fade-in">
                    <span class="capitalize">{{ $props.transaction.status }}</span>
                </div>
            </template>
        </template>
        <template v-else>
            <div class="ring-2 ring-red-400 rounded-full bg-white text-lg font-bold text-center text-red-400 ">
                <span class="capitalize">{{ $props.transaction.status }}</span>
            </div>
        </template>
    </td>
</template>

<script setup>
import { ref } from 'vue';

const isHovered = ref(false);
</script>

<script>
export default {
    props: {
        transaction: Object,
        received: true
    }
}
</script>

<style>
@keyframes fade-in {
    0% {
        opacity: 0;
    }
    100% {
        opacity: 1;
    }
}


.fade-in {
    transition: fade-in 1s ease-in-out;
}
</style>

