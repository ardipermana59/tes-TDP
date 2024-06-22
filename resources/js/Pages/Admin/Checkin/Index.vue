<script setup>
import { Head, useForm, usePage } from '@inertiajs/vue3';

import Breadcrumb from '@/Components/MyBreadcrumb.vue';
import AppLayout from '@/Layouts/MyLayout.vue';

import { toast } from "vue3-toastify";
import "vue3-toastify/dist/index.css";

const page = usePage();

const form = useForm({
    ticket: ''
});

const handleCheckin = () => {
    form.post('/admin/check/ticket', {
        onSuccess: () => {
            toast(page.props.flash.message || 'Berhasil checkin', {
                theme: "auto",
                type: "success",
            })
        },
        onError: (error) => {
            if (form.hasErrors) {
                toast(form.errors.message || 'Gagal Checkin', {
                    theme: "auto",
                    type: "error",
                })
            }
        }
    });
}

</script>

<template>
    <AppLayout>

        <Head title="Admin Checkin" />

        <div class="grid grid-cols-1 px-4 pt-6 xl:grid-cols-3 xl:gap-4 dark:bg-gray-900">
            <Breadcrumb current-page="Checkin" page-title="Checkin" />

        </div>
        <div class="px-4">
            <div v-if="form.wasSuccessful"
                class="flex items-center p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                role="alert">
                <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                </svg>
                <span class="sr-only">Info</span>
                <div>
                    <span class="font-medium">{{ page.props.flash.message }}</span>
                </div>
            </div>

            <div v-if="form.hasErrors"
                class="flex p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                role="alert">
                <svg class="flex-shrink-0 inline w-4 h-4 me-3 mt-[2px]" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                </svg>
                <span class="sr-only">Danger</span>
                <div>
                    <span class="font-medium">Ups ada masalah</span>
                    <ul class="mt-1.5 list-disc list-inside">
                        <li v-for="(error, key) in form.errors" :key="key">{{ error }}</li>
                    </ul>
                </div>
            </div>
            <div
                class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
                <h3 class="mb-4 text-xl font-semibold dark:text-white">Checkin Tiket</h3>
                <form @submit.prevent="handleCheckin">
                    <div class="grid gap-6">
                        <div class="col-span-6 ">
                            <label for="ticket"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nomor Tiket</label>
                            <input v-model="form.ticket" type="text" name="ticket" id="ticket"
                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Masukan tiket anda" required>
                        </div>
                        <div class="col-span-6 sm:col-full">
                            <button :disabled="form.processing"
                                class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800"
                                type="submit">Periksa</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </AppLayout>
</template>