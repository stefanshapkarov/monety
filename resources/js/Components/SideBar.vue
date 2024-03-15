<template>
    <div class="w-80">
        <!-- Send Money button -->
        <button @click.prevent="toggle('sendMoney')" class="w-full bg-cyan-500 hover:bg-cyan-600 text-white text-xl font-bold py-3 px-6 rounded-2xl flex items-center shadow-2xl">
            <span class="bg-white h-11 w-11 flex items-center justify-center rounded-full mr-4 text-cyan-500">
                <v-icon name="fa-arrow-up" class="h-7 w-7" />
            </span>
            Send Money
        </button>

        <!-- Withdraw Money button -->
        <button @click.prevent="toggle('withdrawMoney')" class="mt-5 w-full bg-yellow-500 hover:bg-yellow-600 text-white text-xl font-bold py-3 px-6 rounded-2xl flex items-center shadow-2xl">
            <span class="bg-white h-11 w-11 flex items-center justify-center rounded-full mr-4 text-yellow-500">
                <v-icon name="fa-arrow-left" class="h-7 w-7" />
            </span>
            Withdraw Money
        </button>

        <!-- Sidebar content -->
        <!-- Sidebar for sending money -->
        <div
            v-if="sidebars.sendMoney"
            class="transition-all duration-700 bg-yellow-200 overflow-hidden flex items-center justify-center"
            :class="[sidebars.sendMoney ? 'max-w-lg' : 'max-w-0']"
        >
            <div class="w-48 text-center font-bold text-xl">Send Money Sidebar</div>
            <slot></slot>
        </div>

        <!-- Sidebar for withdrawing money -->
        <div
            v-if="sidebars.withdrawMoney"
            class="transition-all duration-700 bg-yellow-200 overflow-hidden flex items-center justify-center"
            :class="[sidebars.withdrawMoney ? 'max-w-lg' : 'max-w-0']"
        >
            <div class="w-48 text-center font-bold text-xl">Withdraw Money Sidebar</div>
            <slot></slot>
        </div>

        <!-- Dimmer -->
        <transition name="fade">
            <div v-if="(sidebars.sendMoney || sidebars.withdrawMoney)" class="w-screen h-screen bg-neutral-400 opacity-75 fixed inset-0"></div>
        </transition>
    </div>
</template>

<script setup>
import { defineProps } from 'vue';

// Define props to accept toggle method and sidebars object
const props = defineProps(['toggle', 'sidebars']);
</script>

<style scoped>
.fade-enter-active,
.fade-leave-active {
    transition: opacity 1s ease-out;
}

.fade-enter,
.fade-leave-to {
    opacity: 0;
}
</style>
