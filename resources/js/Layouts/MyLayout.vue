<script setup>
import Navbar from '@/Components/MyNavbar.vue';
import Sidebar from '@/Components/MySidebar.vue';
import Footer from '@/Components/MyFooter.vue';
import { onMounted } from 'vue'
import { initFlowbite } from 'flowbite'
onMounted(() => {
    initFlowbite();
})

</script>

<template>
    <Navbar></Navbar>

    <div class="flex pt-16 overflow-hidden bg-gray-50 dark:bg-gray-900">
        <Sidebar></Sidebar>

    </div>
    <div id="main-content" class="relative h-full overflow-y-auto bg-gray-50 lg:ml-64 dark:bg-gray-900 ">
        <main>
            <slot></slot>

        </main>
        <Footer></Footer>
    </div>

</template>