<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import AuthenticationCard from '@/Components/AuthenticationCard.vue';
import AuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue';
import Checkbox from '@/Components/Checkbox.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    currency: 'MKD',
    terms: false,
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <Head title="Register" />

    <header class="bg-white dark:bg-gray-900 shadow-md">
        <div class="max-w-7xl mx-auto flex justify-between items-center pt-8">
            <!-- Logo or site name -->
            <h1 class="lg:text-7xl text-5xl font-bold ml-5 text-emerald-400 font-serif">
                <span class="typing-animation">M</span>
                <span class="typing-animation" style="animation-delay: 0.1s;">O</span>
                <span class="typing-animation" style="animation-delay: 0.2s;">N</span>
                <span class="typing-animation" style="animation-delay: 0.3s;">E</span>
                <span class="typing-animation" style="animation-delay: 0.4s;">T</span>
                <span class="typing-animation" style="animation-delay: 0.5s;">Y</span>
            </h1>

            <!-- Links to login and register -->
            <nav class="flex lg:space-x-16 md:ml-0 ml-5 w-72 space-x-4">
                <!-- Replace '#' with your actual routes -->
                <Link :href="route('login')" class="font-semibold dark:text-white text-emerald-400 bg-white hover:border-b-4 hover:border-r-4 hover:border-emerald-400 dark:hover:bg-gray-800 px-3 py-2  lg:text-xl text-md relative">
                    Login
                </Link>
                <Link :href="route('register')" class="font-semibold dark:text-white text-emerald-400 bg-white hover:border-b-4 hover:border-r-4 hover:border-emerald-400 dark:hover:bg-gray-800 px-3 py-2  lg:text-xl text-md relative">
                    Register
                </Link>
            </nav>
        </div>
    </header>

    <div v-if="status" class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
        {{ status }}
    </div>

    <section class="bg-white dark:bg-gray-900 h-screen flex justify-center items-center fade-in">
        <div class="max-w-7xl container lg:pr-6 pl-6 py-24 mx-auto lg:py-24">
            <div class="lg:flex justify-center items-center">
                <div class="lg:w-1/2">
                    <AuthenticationCardLogo />

                    <h1 class="mt-4 text-gray-600 dark:text-gray-300 md:text-3xl font-sans italic">Welcome to Monety, we are your trusted payment app for seamless transactions!</h1>


                </div>

                <div class="lg:w-1/2 lg:mt-0">
                    <h1 class="mb-10 text-2xl font-medium text-emerald-400 capitalize lg:text-5xl dark:text-white">
                        register your account
                    </h1>
                    <form @submit.prevent="submit">
                        <div>
                            <InputLabel for="name" value="Name" />
                            <TextInput
                                id="name"
                                v-model="form.name"
                                type="text"
                                class="mt-1 block w-full"
                                required
                                autofocus
                                autocomplete="name"
                            />
                            <InputError class="mt-2" :message="form.errors.name" />
                        </div>

                        <div class="mt-4">
                            <InputLabel for="email" value="Email" />
                            <TextInput
                                id="email"
                                v-model="form.email"
                                type="email"
                                class="mt-1 block w-full"
                                required
                                autocomplete="username"
                            />
                            <InputError class="mt-2" :message="form.errors.email" />
                        </div>

                        <div class="mt-4">
                            <InputLabel for="password" value="Password" />
                            <TextInput
                                id="password"
                                v-model="form.password"
                                type="password"
                                class="mt-1 block w-full"
                                required
                                autocomplete="new-password"
                            />
                            <InputError class="mt-2" :message="form.errors.password" />
                        </div>

                        <div class="mt-4">
                            <InputLabel for="password_confirmation" value="Confirm Password" />
                            <TextInput
                                id="password_confirmation"
                                v-model="form.password_confirmation"
                                type="password"
                                class="mt-1 block w-full"
                                required
                                autocomplete="new-password"
                            />
                            <InputError class="mt-2" :message="form.errors.password_confirmation" />
                        </div>

                        <div class="mt-4">
                            <InputLabel for="currency" value="Currency" />
                            <select id="currency" v-model="form.currency" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-emerald-400 dark:focus:border-indigo-600 focus:ring-emerald-400 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                <option value="MKD">MKD</option>
                                <option value="EUR">EUR</option>
                                <option value="USD">USD</option>
                            </select>
                            <InputError class="mt-2" :message="form.errors.currency_selection" />
                        </div>

                        <div v-if="$page.props.jetstream.hasTermsAndPrivacyPolicyFeature" class="mt-4">
                            <InputLabel for="terms">
                                <div class="flex items-center">
                                    <Checkbox id="terms" v-model:checked="form.terms" name="terms" required />

                                    <div class="ms-2">
                                        I agree to the <a target="_blank" :href="route('terms.show')" class="underline text-sm text-gray-400 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">Terms of Service</a> and <a target="_blank" :href="route('policy.show')" class="underline text-sm text-gray-400 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">Privacy Policy</a>
                                    </div>
                                </div>
                                <InputError class="mt-2" :message="form.errors.terms" />
                            </InputLabel>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <Link :href="route('login')" class="underline text-sm text-gray-400 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                                Already registered?
                            </Link>

                            <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                Register
                            </PrimaryButton>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </section>


</template>

<style>
@keyframes typing {
    0% {
        opacity: 0;
    }
    100% {
        opacity: 1;
    }
}

.typing-animation {
    animation: typing 1s linear infinite;
}

@keyframes fade-in {
    0% {
        opacity: 0;
    }
    100% {
        opacity: 1;
    }
}

.fade-in {
    animation: fade-in 1s ease-in-out;
}
</style>
