<template>
    <tr class="border-b-2 border-gray-200">
        <TransactionProfile />
        <TransactionDate :date="$props.transaction.created_at"/>
        <TransactionAmount :amount="$props.transaction.fromAmount" :currency="$props.transaction.account_from.currency"/>
        <TransactionStatus />
    </tr>
</template>

<script setup>
import TransactionProfile from "@/Components/TransactionProfile.vue";
import TransactionDate from "@/Components/TransactionDate.vue";
import TransactionAmount from "@/Components/TransactionAmount.vue";
import TransactionStatus from "@/Components/TransactionStatus.vue";

</script>

<script>
export default {
    props: {
        transaction: Object,
    }
}
</script>
