<script setup>

</script>

<template>
    <td class="bg-white font-bold text-gray-600 ">
        <p class="whitespace-no-wrap flex font-semibold text-3xl ml-8">
            <!-- Use BiArrowDownCircle as a regular component -->
            <span class="text-red-500"><v-icon name="bi-arrow-down-circle" class="w-8 h-8" /></span>
<!--            <span class="text-emerald-400"><v-icon name="bi-arrow-up-circle" /></span>-->
<!--            <span class="text-yellow-500"><v-icon name="la-minus-circle-solid" /></span>-->
            <span class="ml-2">{{ $props.amount }}{{ $props.currency }}</span>
        </p>
    </td>
</template>

<script>
export default {
    props: {
        amount: Number,
        currency: String,
    }
}
</script>
