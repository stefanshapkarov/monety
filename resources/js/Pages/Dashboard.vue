<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Components/Welcome.vue';
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Dashboard
            </h2><br>

            <h2>=== Backend Testing playground ===</h2><br><br>

            <section>
                <h3 style="color: white">Your balance: </h3>
                <h3 style="color: grey">${{ $props.currentAccount.balance }}</h3>
            </section>
            <br><br>

            <section>
                <form @submit="submit">
                    <label for="amount" style="padding-right: 5px; color: grey;">Enter amount to transfer:</label><br>
                    <input type="number" id="amount" name="amount" v-model="form.amount"> <br>
                    <label for="email" style="padding-right: 5px; color: grey;">Enter receiver email:</label><br>
                    <input type="email" id="email" name="email" v-model="form.email"><br>
                    <button type="submit" style="color: white; border: 1px solid grey; margin-top: 5px">Send</button>
                </form>
            </section>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                    <Welcome/>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script>
import { useForm } from '@inertiajs/vue3';

const form = useForm({
    amount: '',
    email: '',
});

function submit(e) {
    e.preventDefault(); // Prevent the default form submission
    form.post('/transfer-funds');
}

export default {
    props: {
        currentAccount: Object,
    }
}
</script>
