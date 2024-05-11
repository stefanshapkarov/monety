<template>
    <tr class="border-b-2 border-gray-200">
        <TransactionProfile :account="$props.account.id === $props.transaction.from_account_id ? $props.transaction.account_to.user : $props.transaction.account_from.user "/>
        <TransactionDate :date="$props.transaction.updated_at"/>
        <TransactionAmount :received="$props.account.id!==$props.transaction.from_account_id" :amount="$props.account.id === $props.transaction.from_account_id ? $props.transaction.fromAmount : $props.transaction.toAmount" :currency="$props.account.id === $props.transaction.from_account_id ? $props.transaction.account_from.currency : $props.transaction.account_to.currency"/>
        <TransactionStatus :received="$props.account.id!==$props.transaction.from_account_id" :transaction="$props.transaction"/>
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
        account: Object,
        transaction: Object
    }
}
</script>
