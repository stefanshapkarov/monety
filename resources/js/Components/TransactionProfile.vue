<script setup>
</script>

<template>
    <td class="bg-white pl-8 flex items-center py-2">
        <div class="h-10 w-10 flex-shrink-0">
            <img class="h-full w-full rounded-full" :src="$props.account.profile_photo_url" alt="Alt text"/>
        </div>
        <div class="ml-5 text-lg text-gray-400 font-bold">
            <p class="whitespace-no-wrap">{{  $props.account.email }}</p>
        </div>
    </td>
</template>

<script>
export default {
    props: {
        account: Object
    }
}
</script>
