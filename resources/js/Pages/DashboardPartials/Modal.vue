<template>
    <div class="fixed top-0 left-0 w-full h-full bg-gray-900 bg-opacity-50 fade-in" @click="closeModal">
        <div class="flex justify-center items-center h-full">
            <div class="bg-white rounded-lg p-8" :class="title === 'Send Money' ? 'max-w-xl' : 'max-w-4xl'" style="width: 80vw;" @click.stop>
                <h2 class="text-4xl font-bold mb-10" :class="title === 'Send Money' ? 'text-emerald-400' : 'text-purple-600'">{{ title }}</h2>
                <slot></slot>
                <button class=" bg-gray-600 text-white px-4 py-2 rounded-lg font-semibold hover:bg-gray-800" @click="closeModal">Close</button>
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

<style>
@keyframes fade-in {
    0% {
        opacity: 0;
    }
    100% {
        opacity: 1;
    }
}


.fade-in {
    animation: fade-in 500ms ease-in-out;
}
</style>
