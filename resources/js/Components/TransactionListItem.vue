<script setup>

import TransactionStatus from "@/Components/TransactionStatus.vue";
import TransactionDate from "@/Components/TransactionDate.vue";
import TransactionAmount from "@/Components/TransactionAmount.vue";
import TransactionProfile from "@/Components/TransactionProfile.vue";
</script>

<template>
    <tr class="w-full">
        <TransactionProfile />
        <TransactionDate />
        <TransactionAmount />
        <TransactionStatus />
    </tr>
</template>

<style scoped>

</style>
