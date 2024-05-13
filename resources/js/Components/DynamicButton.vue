<template>
    <button
        class="min-w-48 text-white border-4 hover:bg-white text-2xl font-bold py-2 px-2 rounded-2xl flex items-center shadow-2xl"
        :class="{
      'bg-amber-400 border-amber-400 hover:text-amber-400': title === 'Withdraw Money',
      'bg-cyan-400 border-cyan-400 hover:text-cyan-400': title === 'Deposit Money',
      'bg-emerald-400 border-emerald-400 hover:text-emerald-400 mb-3': title === 'Send Money'
    }"
    >
    <span v-if="title === 'Deposit Money'" class=" ml-2 bg-white h-10 w-14 flex items-center justify-center rounded-full text-cyan-400">
      <v-icon name="fa-arrow-left" class="h-7 w-7"/>
    </span>
        <span v-if="title === 'Send Money'" class=" ml-2 mr-3 bg-white h-10 w-10 flex items-center justify-center rounded-full text-emerald-400">
      <v-icon name="fa-arrow-up" class="h-7 w-7"/>
    </span>
        {{ title }}
        <span v-if="title === 'Withdraw Money'" class=" bg-white h-10 w-14 flex items-center justify-center rounded-full text-amber-400">
      <v-icon name="fa-arrow-right" class="h-7 w-7"/>
    </span>
    </button>
</template>

<script setup>
import { defineProps } from 'vue';

const props = defineProps({
    title: String
});
</script>
