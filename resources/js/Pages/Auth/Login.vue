<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import AuthenticationCard from '@/Layouts/AuthenticationLayout.vue';
import AuthenticationCardLogo from '@/Components/MyAuthenticationCardLogo.vue';
import Checkbox from '@/Components/MyCheckbox.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/MyInputLabel.vue';
import PrimaryButton from '@/Components/MyPrimaryButton.vue';
import TextInput from '@/Components/MyTextInput.vue';

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

    <AuthenticationCard>
        <template #logo>
            <AuthenticationCardLogo />
        </template>
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
            Login untuk melihat tiket anda
        </h2>
        <div v-if="status" class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
            {{ status }}
        </div>

        <form class="mt-8 space-y-6" @submit.prevent="submit">
            <div>
                <InputLabel for="email" value="Email" />
                <TextInput id="email" v-model="form.email" type="email" required autofocus autocomplete="username"
                    placeholder="youremail@company.com" />
                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4">
                <InputLabel for="password" value="Password" />
                <TextInput id="password" v-model="form.password" type="password" required
                    autocomplete="current-password" placeholder="••••••••" />
                <InputError class="mt-2" :message="form.errors.password" />
            </div>
            <div class="flex items-start">
                <div class="flex items-center h-5">
                    <Checkbox id="remember" aria-describedby="remember" v-model:checked="form.remember"
                        name="remember" />
                </div>
                <div class="ml-3 text-sm">
                    <label for="remember" class="font-medium text-gray-900 dark:text-white">Remember me</label>
                </div>
                <Link v-if="canResetPassword" :href="route('password.request')"
                    class="ml-auto text-sm text-primary-700 hover:underline dark:text-primary-500">
                Lost Password?
                </Link>
            </div>


            <button
                class="w-full px-5 py-3 text-base font-medium text-center text-white bg-primary-700 rounded-lg hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 sm:w-auto dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                Login to your account
            </button>
            <div class="text-sm font-medium text-gray-500 dark:text-gray-400">
                Not registered?
                <Link :href="route('register')" class="text-primary-700 hover:underline dark:text-primary-500">Create
                account
                </Link>
            </div>
        </form>
    </AuthenticationCard>
</template>
