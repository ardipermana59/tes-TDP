<script setup>
import { defineProps } from 'vue';
import AppLayout from '@/Layouts/MyLayout.vue';
import Breadcrumb from '@/Components/MyBreadcrumb.vue';

</script>

<template>
    <AppLayout>

        <div class="grid grid-cols-1 px-4 pt-6 xl:grid-cols-3 xl:gap-4 dark:bg-gray-900">
            <Breadcrumb current-page="Checkin" page-title="Checkin" />

        </div>
        <div class="px-4">
            <div
                    class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
                    <h3 class="mb-4 text-xl font-semibold dark:text-white">Checkin Tiket</h3>
                    <form action="#">
                        <div class="grid gap-6">
                            <div class="col-span-6 ">
                                <label for="ticket"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nomor Tiket</label>
                                <input type="text" name="ticket" id="ticket"
                                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="1234567" required="">
                            </div>
                            <div class="col-span-6 sm:col-full">
                                <button
                                    class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800"
                                    type="submit">Periksa</button>
                            </div>
                        </div>
                    </form>
                </div>
        </div>
    </AppLayout>
</template>