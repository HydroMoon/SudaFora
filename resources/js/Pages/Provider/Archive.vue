<template>

    <Head title="Profile" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <div class="flex flex-col gap-4 md:flex-row md:items-center">
                <h2 class="text-xl font-semibold leading-tight">
                    Reports
                </h2>
            </div>
        </template>

        <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1 w-full">
            <table
                class="items-center bg-transparent w-full text-gray-400 space-y-6 overflow-x-auto lg:overflow-visible">
                <thead class="text-gray-500">
                    <th
                        class="px-6 bg-gray-50 text-gray-500 align-middle border border-solid border-gray-100 py-3 text-xs uppercase border-l-1 border-r-0 whitespace-nowrap font-semibold text-left">
                        #</th>
                    <th
                        class="px-6 bg-gray-50 text-gray-500 align-middle border border-solid border-gray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                        User / Entity Name</th>
                    <th
                        class="px-6 bg-gray-50 text-gray-500 align-middle border border-solid border-gray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                        No. of Requests</th>
                    <th
                        class="px-6 bg-gray-50 text-gray-500 align-middle border border-solid border-gray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                        Request Date</th>
                    <th
                        class="px-6 bg-gray-50 text-gray-500 align-middle border border-solid border-gray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-center">
                        Status</th>
                    <th
                        class="px-6 bg-gray-50 text-gray-500 align-middle border border-solid border-gray-100 py-3 text-xs uppercase border-l-0 border-r-1 whitespace-nowrap font-semibold text-left">
                        </th>
                </thead>
                <tbody>
                    <template v-for="item, index in items" :key="item.id">
                        <tr class="text-gray-500">
                            <td
                                class="px-6 text-gray-700 align-middle py-3 text-sm border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                {{ index + 1 }}
                            </td>
                            <td
                                class="px-6 text-gray-700 align-middle py-3 text-sm border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                {{ item.name }}
                            </td>
                            <td
                                class="px-6 text-gray-700 align-middle py-3 text-sm border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                {{ item.items.filter(a => a.item_found != 0).length }}
                            </td>
                            <td
                                class="px-6 text-gray-700 align-middle py-3 text-sm border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                {{ dayjs(item.created_at).format('D, MMM YYYY - h:M A') }}
                            </td>
                            <td
                                class="px-6 text-gray-700 align-middle py-3 text-sm border-l-0 border-r-0 whitespace-nowrap font-semibold text-center">
                                <Link :href="route('report', item.id)" class="rounded-md shadow-md bg-green-400 hover:bg-green-500 px-4 py-2 text-white text-xs">View Report</Link>
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
import { Head, Link } from '@inertiajs/inertia-vue3'
import dayjs from 'dayjs'
export default {
        components: {
        BreezeAuthenticatedLayout,
        Head,
        Link
    },
    props: {
        items: Array
    },
    setup() {

        return {
            dayjs
        }
    }
}
</script>
