<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import AuthenticationCard from '@/Layouts/AuthenticationLayout.vue';
import AuthenticationCardLogo from '@/Components/MyAuthenticationCardLogo.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/MyInputLabel.vue';
import PrimaryButton from '@/Components/MyPrimaryButton.vue';
import TextInput from '@/Components/MyTextInput.vue';

defineProps({
    status: String,
});

const form = useForm({
    email: '',
});

const submit = () => {
    form.post(route('password.email'));
};
</script>

<template>
    <Head title="Forgot Password" />

    <AuthenticationCard>
        <template #logo>
            <AuthenticationCardLogo />
        </template>
        <h2 class="mb-3 text-2xl font-bold text-gray-900 dark:text-white">
                Forgot your password?
            </h2>
            
        <div class="text-base font-normal text-gray-500 dark:text-gray-400">
            Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.
        </div>
        
        <div v-if="status" class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
            {{ status }}
        </div>

        <form class="mt-8 space-y-6" @submit.prevent="submit">
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
                    placeholder="youremail@company.com"
                />
                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Email Password Reset Link
                </PrimaryButton>
            </div>
        </form>
    </AuthenticationCard>
</template>
