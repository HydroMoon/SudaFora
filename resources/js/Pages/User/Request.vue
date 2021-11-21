<template>

    <Head title="Profile" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                <h2 class="text-xl font-semibold leading-tight">
                    Request Items from providers
                </h2>

                <div class="space-y-2 items-center">
                    <!-- <BreezeLabel for="user_type" value="User type" /> -->
                    <select v-model="selectedSpec" class="block w-full rounded-md border-gray-400  focus:border-gray-400 focus:ring focus:ring-purple-500 focus:ring-offset-2 focus:ring-offset-white dark:bg-dark-eval-1">
                        <option disabled value="">Please select an option</option>
                        <option v-for="item in specialities" :key="item.id" :value="item.id">{{ item.name }}</option>
                    </select>
            </div>
            </div>
        </template>

        <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1 w-full">
            <table
                class="items-center bg-transparent w-full text-gray-400 space-y-6 overflow-x-auto lg:overflow-visible">
                <thead class="text-gray-500">
                    <th
                        class="px-6 bg-gray-50 text-gray-500 align-middle border border-solid border-gray-100 py-3 text-xs uppercase border-l-1 border-r-0 whitespace-nowrap font-semibold text-left">
                        Item Name</th>
                    <th
                        class="px-6 bg-gray-50 text-gray-500 align-middle border border-solid border-gray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                        Item Description</th>
                    <th
                        class="px-6 bg-gray-50 text-gray-500 align-middle border border-solid border-gray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                        Quantity</th>
                    <th
                        class="px-6 bg-gray-50 text-gray-500 align-middle border border-solid border-gray-100 py-3 text-xs uppercase border-l-0 border-r-1 whitespace-nowrap font-semibold text-left flex items-center justify-center space-x-4">
                        <button class="px-2 py-1 bg-green-400 hover:bg-green-500 rounded-md shadow-md text-white" @click="addField">Add
                            Item</button>
                        <button class="px-2 py-1 bg-green-400 hover:bg-green-500 rounded-md shadow-md text-white" @click="saveAll">Save
                            All</button>
                    </th>
                </thead>
                <tbody>
                    <template v-for="(item, index) in items" :key="item+index">
                        <tr class="text-gray-500">
                            <td
                                class="px-6 text-gray-700 align-middle py-3 text-sm border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                <input type="text" placeholder="Item name" class="w-auto border-none text-xs" v-model="items[index].item_name">
                            </td>
                            <td
                                class="px-6 text-gray-700 align-middle py-3 text-sm border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                <input type="text" placeholder="Item description" class="w-auto border-none text-xs" v-model="items[index].item_desc">
                            </td>
                            <td
                                class="px-6 text-gray-700 align-middle py-3 text-sm border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                <input type="number" placeholder="Quantity" class="w-auto border-none text-xs" v-model="items[index].quantity">
                            </td>
                            <!-- <td
                                class="px-6 text-gray-700 align-middle py-3 text-sm uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold flex justify-center">
                                <CheckCircleIcon class="h-5 w-5 text-green-500 text-center" />
                            </td> -->
                        </tr>
                    </template>
                </tbody>
            </table>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script>
    import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
    import {
        Head, useForm
    } from '@inertiajs/inertia-vue3'
    import {
        CheckCircleIcon,
        ChevronUpIcon
    } from '@heroicons/vue/outline'
import { ref } from 'vue'
import Swal from 'sweetalert2'
    export default {
        components: {
            BreezeAuthenticatedLayout,
            Head,
            CheckCircleIcon,
            ChevronUpIcon
        },
        props: {
            specialities: Array,
        },
        setup(props) {
            const selectedSpec = ref(props.specialities[0].id)
            const items = ref([
                {
                    item_name: null,
                    item_desc: null,
                    quantity: null,
                    speciality_id: selectedSpec
                }
            ])

            
            // const itemForm = computed(() => {
            //     return useForm(items);
            // })

            //console.log(itemForm.value)

            function addField() {
                items.value.push({
                    item_name: null,
                    item_desc: null,
                    item_quantity: null,
                    speciality_id: selectedSpec
                });
            }

            function saveAll() {
                useForm(items.value).post(route('user.request.store'), {
                    onSuccess: () => {
                        console.log('Successful');
                        items.value = [{
                            item_name: null,
                            item_desc: null,
                            item_quantity: null,
                            speciality_id: selectedSpec
                        }];
                        Swal.fire({
                            toast: true,
                            position: 'bottom',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            icon: 'success',
                            title: 'Items saved successfully!'
                        });
                    }
                });
            }

            return {
                selectedSpec,
                items,
                addField,
                saveAll
            }
        }
    }
</script>
