<script setup>
import { defineProps, ref } from 'vue';
import { useForm, usePage, Head } from '@inertiajs/vue3';

import AppLayout from '@/Layouts/MyLayout.vue';

import Breadcrumb from '@/Components/MyBreadcrumb.vue';
import Pagination from '@/Components/MyPagination.vue';
import DeleteModal from '@/Components/MyDeleteModal.vue';

import { toast } from "vue3-toastify";
import "vue3-toastify/dist/index.css";

const page = usePage();
const props = defineProps(['tickets']);

const showModalDelete = ref(false);
const ticketId = ref(null);
const modelName = ref('');
const modelEmail = ref('');
const modelTicket = ref('');

const editModal = ref(null);

const showModal = (id) => {
    ticketId.value = id;
    showModalDelete.value = true;
};

const deleteForm = useForm({});
const editForm = useForm({
    name: '',
    email: '',
    ticket: ''
});

const editData = (ticket) => {
    ticketId.value = ticket.id;
    modelName.value = ticket.user.name
    modelEmail.value = ticket.user.email
    modelTicket.value = ticket.ticket
    editForm.hasErrors = false
}

const updateData = () => {
    editForm.ticket = modelTicket.value

    editForm.put(route('admin.tickets.update', { id: ticketId.value }), {
        onSuccess: () => {
            toast(page.props.flash.message || 'Berhasil memperbarui data', {
                theme: "auto",
                type: "success",
            });
            editModal.value.click()
        },
        onError: (errors) => {
            if (editForm.hasErrors) {
                toast(editForm.errors.message || 'Gagal memperbarui data', {
                    theme: "auto",
                    type: "error",
                })
            }
        },
    });
}
const deleteTicket = () => {
    deleteForm.delete(route('admin.tickets.destroy', ticketId.value), {
        onSuccess: (page) => {
            showModalDelete.value = false;
            toast(page.props.flash.message || 'Berhasil hapus data', {
                theme: "auto",
                type: "success",
            });
        },
        onError: (errors) => {
            if (deleteForm.hasErrors) {
                toast(deleteForm.errors.message || 'Gagal hapus data', {
                    theme: "auto",
                    type: "error",
                })
            }
        }
    });
};
</script>

<template>
    <AppLayout>

        <Head title="Admin Pesanan" />
        <div class="grid grid-cols-1 px-4 pt-6 xl:grid-cols-3 xl:gap-4 dark:bg-gray-900">
            <Breadcrumb current-page="Pesanan" page-title="Pesanan" />

        </div>

        <div class="px-4">
            <div
                class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 sm:p-6 dark:bg-gray-800">
                <!-- Card header -->
                <div class="items-center justify-between">
                    <div class="sm:flex">
                        <div
                            class="items-center justify-between mb-3 flex sm:divide-x sm:divide-gray-100 sm:mb-0 dark:divide-gray-700">

                        </div>
                        <div class="flex items-center ml-auto space-x-2 sm:space-x-3">
                            <div id="export-dropdown"
                                class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                                <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                                    aria-labelledby="dropdown-action">
                                    <li
                                        class="hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white cursor-pointer">
                                        <div class="inline-flex items-center justify-center px-3 py-2">
                                            <svg class="w-6 h-6 text-gray-800 dark:text-white mr-2" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                                viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="M5 17v-5h1.5a1.5 1.5 0 1 1 0 3H5m12 2v-5h2m-2 3h2M5 10V7.914a1 1 0 0 1 .293-.707l3.914-3.914A1 1 0 0 1 9.914 3H18a1 1 0 0 1 1 1v6M5 19v1a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-1M10 3v4a1 1 0 0 1-1 1H5m6 4v5h1.375A1.627 1.627 0 0 0 14 15.375v-1.75A1.627 1.627 0 0 0 12.375 12H11Z" />
                                            </svg>
                                            PDF
                                        </div>
                                    </li>
                                    <li
                                        class="hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white cursor-pointer">
                                        <div class="inline-flex items-center justify-center px-3 py-2">
                                            <svg class="w-6 h-6 text-gray-800 dark:text-white mr-2" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                                viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="M5 10V7.914a1 1 0 0 1 .293-.707l3.914-3.914A1 1 0 0 1 9.914 3H18a1 1 0 0 1 1 1v6M5 19v1a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-1M10 3v4a1 1 0 0 1-1 1H5m14 9.006h-.335a1.647 1.647 0 0 1-1.647-1.647v-1.706a1.647 1.647 0 0 1 1.647-1.647L19 12M5 12v5h1.375A1.626 1.626 0 0 0 8 15.375v-1.75A1.626 1.626 0 0 0 6.375 12H5Zm9 1.5v2a1.5 1.5 0 0 1-1.5 1.5v0a1.5 1.5 0 0 1-1.5-1.5v-2a1.5 1.5 0 0 1 1.5-1.5v0a1.5 1.5 0 0 1 1.5 1.5Z" />
                                            </svg>
                                            Excel
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Table -->
                <div class="flex flex-col mt-6">
                    <div class="overflow-x-auto rounded-lg">
                        <div class="inline-block min-w-full align-middle">
                            <div class="overflow-hidden shadow sm:rounded-lg">
                                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-600">
                                    <thead class="bg-gray-50 dark:bg-gray-700">
                                        <tr>
                                            <th scope="col"
                                                class="p-4 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-white">
                                                Name
                                            </th>
                                            <th scope="col"
                                                class="p-4 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-white">
                                                Email
                                            </th>
                                            <th scope="col"
                                                class="p-4 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-white">
                                                Ticket
                                            </th>
                                            <th scope="col"
                                                class="p-4 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-white">
                                                Checkin At
                                            </th>
                                            <th scope="col"
                                                class="p-4 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-white">
                                                Actions
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white dark:bg-gray-800">

                                        <tr v-for="ticket in tickets.data" :key="ticket.id"
                                            class="border-b hover:bg-gray-100 dark:hover:bg-gray-700">
                                            <td
                                                class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                {{ ticket.user.name }}
                                            </td>
                                            <td
                                                class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                {{ ticket.user.email }}
                                            </td>
                                            <td
                                                class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                {{ ticket.ticket }}</td>
                                            <td
                                                class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                {{ ticket.checked_in === null ? 'BELUM CHECKIN' : ticket.checked_in }}
                                            </td>
                                            <td class="p-4 space-x-2 whitespace-nowrap">
                                                <button @click="editData(ticket)" type="button" title="Edit"
                                                    data-modal-target="crud-modal" data-modal-toggle="crud-modal"
                                                    class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z">
                                                        </path>
                                                        <path fill-rule="evenodd"
                                                            d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"
                                                            clip-rule="evenodd"></path>
                                                    </svg>
                                                </button>
                                                <button @click="showModal(ticket.id)" type="button" title="Delete"
                                                    class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-800 focus:ring-4 focus:ring-red-300 dark:focus:ring-red-900">
                                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd"
                                                            d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                            clip-rule="evenodd"></path>
                                                    </svg>
                                                </button>
                                            </td>
                                        </tr>



                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Card Footer -->
                <Pagination :data="tickets" />
            </div>
        </div>

        <div id="crud-modal" tabindex="-1" aria-hidden="true"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                            Edit Data
                        </h3>
                        <button type="button" ref="editModal"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-toggle="crud-modal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <form class="p-4 md:p-5">
                        <div v-if="editForm.hasErrors"
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
                                    <li v-for="(error, key) in editForm.errors" :key="key">{{ error }}</li>
                                </ul>
                            </div>
                        </div>
                        <div class="grid gap-4 mb-4 grid-cols-1">
                            <div class="col-span-1">
                                <label for="name"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                                <input v-model="modelName" type="text" name="name" id="name"
                                    class="bg-gray-100 border border-gray-300  text-sm rounded-lg focus:ring-gray-400 focus:border-gray-400 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-500 dark:text-gray-400 dark:focus:ring-gray-600 dark:focus:border-gray-600"
                                    placeholder="Enter Full name" disabled>

                            </div>

                            <div class="col-span-1">
                                <label for="email"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                                <input v-model="modelEmail" type="email" name="email" id="email"
                                    class="bg-gray-100 border border-gray-300  text-sm rounded-lg focus:ring-gray-400 focus:border-gray-400 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-500 dark:text-gray-400 dark:focus:ring-gray-600 dark:focus:border-gray-600"
                                    placeholder="Enter Email" disabled>
                            </div>

                            <div class="col-span-1">
                                <label for="ticket"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ticket</label>
                                <input v-model="modelTicket" type="text" name="ticket" id="ticket"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="Enter Ticket" required="">
                            </div>
                        </div>
                        <div class="flex justify-between">
                            <button :disabled="editForm.processing" @click="updateData" type="button"
                                class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                {{ (editForm.processing) ? 'Loading....' : 'Update' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <!-- Confirmation Delete Modal -->
        <DeleteModal :isVisible="showModalDelete" @update:isVisible="showModalDelete = $event"
            @confirm="deleteTicket" />

    </AppLayout>
</template>