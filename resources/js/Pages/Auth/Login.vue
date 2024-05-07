<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import AuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue';
import Checkbox from '@/Components/Checkbox.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.transform(data => ({
        ...data,
        remember: form.remember ? 'on' : '',
    })).post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <Head title="Log in" />

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

    <section class="bg-white dark:bg-gray-900 min-h-screen flex justify-center items-center fade-in">
        <div class="max-w-7xl container lg:pr-6 pl-6 py-24 mx-auto lg:py-24">
            <div class="lg:flex justify-center items-center">
                <div class="lg:w-1/2">
                    <AuthenticationCardLogo />

                    <h1 class="mt-4 text-gray-600 dark:text-gray-300 md:text-3xl font-sans italic">Welcome back to Monety, your trusted payment app for seamless transactions!</h1>


                </div>

                <div class="lg:w-1/2 lg:mt-0">
                    <h1 class="mb-10 text-2xl font-medium text-emerald-400 capitalize lg:text-5xl dark:text-white">
                        login to your account
                    </h1>
                    <form @submit.prevent="submit" class="w-full lg:max-w-xl">
                        <div>
                            <InputLabel for="email" value="Email" />
                            <TextInput
                                id="email"
                                v-model="form.email"
                                type="email"
                                class="mt-1 block w-full"
                                required
                                autofocus
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
                                autocomplete="current-password"
                            />
                            <InputError class="mt-2" :message="form.errors.password" />
                        </div>

                        <div class="block mt-4">
                            <label class="flex items-center">
                                <Checkbox v-model:checked="form.remember" name="remember" />
                                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">Remember me</span>
                            </label>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <Link  :href="route('password.request')" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md">
                                Forgot your password?
                            </Link>

                            <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                Log in
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
