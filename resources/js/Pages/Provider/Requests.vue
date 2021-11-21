<template>
  <Head title="Profile"/>

  <BreezeAuthenticatedLayout>
        <template #header>
            <div class="flex flex-col gap-4 md:flex-row md:items-center">
                <h2 class="text-xl font-semibold leading-tight">
                    Requests
                </h2>
            </div>
        </template>

        <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1 w-full overflow-x-scroll">
            <table class="items-center bg-transparent w-full text-gray-400 space-y-6 overflow-x-auto lg:overflow-visible">
                        <thead class="text-gray-500">
                            <th
                                class="px-6 bg-gray-50 text-gray-500 align-middle border border-solid border-gray-100 py-3 text-xs uppercase border-l-1 border-r-0 whitespace-nowrap font-semibold text-left">
                                #</th>
                            <th
                                class="px-6 bg-gray-50 text-gray-500 align-middle border border-solid border-gray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                User/Entity Name</th>
                            <th
                                class="px-6 bg-gray-50 text-gray-500 align-middle border border-solid border-gray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                Item Name</th>
                            <th
                                class="px-6 bg-gray-50 text-gray-500 align-middle border border-solid border-gray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                Item Description</th>
                            <th
                                class="px-6 bg-gray-50 text-gray-500 align-middle border border-solid border-gray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                Quantity</th>
                            <th
                                class="px-6 bg-gray-50 text-gray-500 align-middle border border-solid border-gray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                Quantity Found</th>
                            <th
                                class="px-6 bg-gray-50 text-gray-500 align-middle border border-solid border-gray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                Price</th>
                            <th
                                class="px-6 bg-gray-50 text-gray-500 align-middle border border-solid border-gray-100 py-3 text-xs uppercase border-l-0 border-r-1 whitespace-nowrap font-semibold text-left flex items-center justify-center">
                                Save</th>
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
                                    {{ item.user.name }}
                                </td>
                                <td
                                    class="px-6 text-gray-700 align-middle py-3 text-sm border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                    {{ item.item_name }}
                                </td>
                                <td
                                    class="px-6 text-gray-700 align-middle py-3 text-sm border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                    {{ item.item_desc }}   
                                </td>
                                <td
                                    class="px-6 text-gray-700 align-middle py-3 text-sm border-l-0 border-r-0 whitespace-nowrap font-semibold text-left flex space-x-2">
                                    {{ item.quantity }}
                                </td>
                                <td
                                    class="px-6 text-gray-700 align-middle py-3 text-sm border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                    <input type="text" v-model="item.quantity_found" placeholder="Quantity" class="w-auto border-none text-xs">
                                </td>
                                <td
                                    class="px-6 text-gray-700 align-middle py-3 text-sm uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                    <input type="text" v-model="item.price" placeholder="Price $" class="w-20 border-none text-xs">
                                </td>
                                <td
                                    class="px-6 text-gray-700 align-middle py-3 text-sm uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold flex items-center justify-center">
                                    <button @click="saveItem(index, item.id)">
                                        <CheckCircleIcon class="h-6 w-6 text-green-500 hover:text-green-400" />
                                    </button>    
                                </td>
                            </tr>
                            <tr>
                                <td colspan="8">
                                    <div class="w-full mx-auto bg-white rounded-md">
                                    <Disclosure v-slot="{ open }">
                                        <DisclosureButton
                                        class="flex justify-between w-full px-4 py-2 text-sm font-medium text-left text-gray-900 bg-gray-100 rounded-md hover:bg-gray-200 focus:outline-none focus-visible:ring focus-visible:ring-purple-500 focus-visible:ring-opacity-75"
                                        >
                                        <span>Alternative options</span>
                                        <ChevronUpIcon
                                            :class="open ? 'transform rotate-180' : ''"
                                            class="w-5 h-5 text-purple-500"
                                        />
                                        </DisclosureButton>
                                        <DisclosurePanel class="px-4 pt-4 pb-2 text-sm text-gray-500 flex items-center justify-center space-x-2">
                                            <span class="font-semibold">Item Name:</span>
                                            <input type="text" v-model="item.alt_name" placeholder="Item name" class="border-none text-xs">
                                            <span class="font-semibold">Item Description:</span>
                                            <input type="text" v-model="item.alt_desc" placeholder="Item description" class="border-none text-xs">
                                            <span class="font-semibold">Quantity:</span>
                                            <input type="text" v-model="item.quantity_alt" placeholder="Quantity" class="border-none text-xs">
                                            <span class="font-semibold">Price:</span>
                                            <input type="text" v-model="item.price_alt" placeholder="Price $" class="border-none text-xs">
                                            <button @click="saveItemAlt(index, item.id)">
                                                <CheckCircleIcon class="h-6 w-6 text-green-500 hover:text-green-400" />
                                            </button> 
                                        </DisclosurePanel>
                                    </Disclosure>
                                    </div>
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
import { Head, useForm } from '@inertiajs/inertia-vue3'
import { CheckCircleIcon, ChevronUpIcon } from '@heroicons/vue/outline'
import {
    Disclosure,
    DisclosureButton,
    DisclosurePanel,
  } from '@headlessui/vue'
import { Toast } from '../../Composables/SweetAlert'
export default {
    components: {
        BreezeAuthenticatedLayout,
        Head,
        CheckCircleIcon,
        ChevronUpIcon,
        Disclosure,
        DisclosureButton,
        DisclosurePanel
    },
    props: {
        items: Array,
        flash: Object
    },
    setup(props) {

        const saveItem = (index, id) => {
            useForm({
                id: id,
                quantity_found: props.items[index].quantity_found,
                price: props.items[index].price
            }).post(route('request.store'), {
                onSuccess: () => {
                    console.log('Successfull!')
                    Toast.fire({
                        icon: 'success',
                        title: props.flash['toast']
                    })
                }
            });
            console.log(id);
        }

        const saveItemAlt = (index, id) => {
            useForm({
                id: id,
                alt_name: props.items[index].alt_name,
                alt_desc: props.items[index].alt_desc,
                quantity_found: props.items[index].quantity_alt,
                price: props.items[index].price_alt
            }).post(route('request.store.alt'), {
                onSuccess: () => {
                    console.log('Successfull!')
                    Toast.fire({
                        icon: 'success',
                        title: props.flash['toast']
                    })
                }
            });
            console.log(id);
        }

        return {
            saveItem,
            saveItemAlt
        }
    }
}
</script>