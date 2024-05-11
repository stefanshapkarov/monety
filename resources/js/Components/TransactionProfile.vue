<script setup>
</script>

<template>
    <td class="w-full bg-white pl-10 flex items-center py-5">
        <div class="h-12 w-12 flex-shrink-0">
            <img class="h-full w-full rounded-full" :src="$props.account.profile_photo_url" alt="Alt text"/>
        </div>
        <div class="ml-5 text-xl text-gray-400 font-bold">
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
