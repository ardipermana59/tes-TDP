<script setup>
import { defineProps, computed } from 'vue';
import { router } from '@inertiajs/vue3';

const props = defineProps(['data']);

const changePage = (url, label, next, previous) => {
    if (url) {
        if (label.includes("&raquo;")) {
            router.get(next, {}, { preserveState: true, preserveScroll: true });
        } else if (label.includes("&laquo;")) {
            router.get(previous, {}, { preserveState: true, preserveScroll: true });
        } else {
            router.get(url, {}, { preserveState: true, preserveScroll: true });
        }
    }
};

const paginationRange = computed(() => {
    return props.data.links.map((link, index) => ({
        label: link.label,
        url: link.url,
        active: link.active
    }));
});

const from = computed(() => props.data.from);
const to = computed(() => props.data.to);
const total = computed(() => props.data.total);
</script>

<template>
    <nav class="flex flex-col items-start justify-between p-4 space-y-3 md:flex-row items-center md:space-y-0"
        aria-label="Table navigation">
        <span class="text-sm font-normal text-gray-500 dark:text-gray-400">
            Showing
            <span class="font-semibold text-gray-900 dark:text-white">{{ from }}-{{ to }}</span>
            of
            <span class="font-semibold text-gray-900 dark:text-white">{{ total }}</span>
        </span>
        <ul class="inline-flex items-stretch -space-x-px">
            <li v-for="(page, index) in paginationRange" :key="page.label">
                <button @click="changePage(page.url, page.label, data.next_page_url, data.prev_page_url)"
                    v-html="page.label" :disabled="page.active" :class="[
                        'flex items-center justify-center px-3 py-2 text-sm leading-tight',
                        page.active ? 'border text-primary-600 bg-primary-50 border-primary-300 dark:border-gray-700 dark:bg-gray-700 dark:text-white' : 'text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white',
                        index === 0 ? 'rounded-l-lg' : '',
                        index === paginationRange.length - 1 ? 'rounded-r-lg' : ''
                    ]">
                </button>
            </li>
        </ul>
    </nav>
</template>