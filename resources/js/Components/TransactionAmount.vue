<script setup>

</script>

<template>
    <td class="bg-white font-bold text-gray-600 ">
        <p class="whitespace-no-wrap flex items-center font-semibold text-2xl ml-10">
            <!-- Use BiArrowDownCircle as a regular component -->
            <span v-if="!received" class="text-red-500"><v-icon name="bi-arrow-down-circle" class="w-10 h-10 mr-2" /></span>
            <span v-if="received" class="text-emerald-400"><v-icon name="bi-arrow-up-circle" class="w-10 h-10 mr-2"/></span>
            <div>
                {{ $props.amount.toFixed(2) }}
                <span class="text-gray-400 text-lg">{{ $props.currency }}</span>
            </div>
        </p>
    </td>
</template>

<script>
export default {
    props: {
        amount: Number,
        currency: String,
        received: Boolean
    }
}
</script>
