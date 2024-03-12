<template>
    <div class="md:col-span-2 flex justify-between">
        <div class="px-4 sm:px-0">
            <!-- Apply text-red-500 class if isDelete is true -->
            <h3 :class="{ 'text-red-500': isDelete }" class="text-lg font-medium text-emerald-400">
                <slot name="title" />
            </h3>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                <slot name="description" />
            </p>
        </div>

        <div class="px-4 sm:px-0">
            <slot name="aside" />
        </div>
    </div>
</template>

<script>
export default {
    props: {
        isDelete: {
            type: Boolean,
            default: false
        }
    }
}
</script>
