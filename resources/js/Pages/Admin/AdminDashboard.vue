<script setup>
import AppLayout from '@/Layouts/MyLayout.vue';
import Breadcrumb from '@/Components/MyBreadcrumb.vue';

</script>

<template>
    <AppLayout>

        <div class="grid grid-cols-1 px-4 pt-6 xl:grid-cols-3 xl:gap-4 dark:bg-gray-900">
            <Breadcrumb current-page="Dashboard" page-title="Dashboard" />

        </div>
        <div class="px-4">
            <div
                    class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
                    <h3 class="mb-4 text-xl font-semibold dark:text-white">Admin Dashboard</h3>
                   
                </div>
        </div>
    </AppLayout>
</template>