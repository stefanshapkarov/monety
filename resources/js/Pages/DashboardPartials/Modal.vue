<template>
    <div class="fixed top-0 left-0 w-full h-full bg-gray-900 bg-opacity-50" @click="closeModal">
        <div class="flex justify-center items-center h-full">
            <div class="bg-white rounded-lg p-8 max-w-lg" style="width: 80vw;" @click.stop>
                <h2 class="text-3xl font-bold mb-6">{{ title }}</h2>
                <slot></slot>
                <button class="mt-4 bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600" @click="closeModal">Close</button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        title: String
    },
    methods: {
        closeModal() {
            this.$emit('close');
        }
    }
};

</script>
