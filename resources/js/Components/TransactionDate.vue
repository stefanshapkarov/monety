<script setup>

</script>

<template>
    <td class="bg-white font-normal text-lg text-gray-400 px-4 pl-8">
        <p class="whitespace-no-wrap">{{ new Date($props.date).toLocaleDateString('en-GB', {
            year: 'numeric',
            month: 'short',
            day: 'numeric',
            hour: '2-digit',
            minute: '2-digit',
        }) }}</p>
    </td>
</template>

<script>
export default {
    props: {
        date: Date,
    }
}
</script>
