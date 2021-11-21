<template>

    <Head title="Profile" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <div class="flex flex-col gap-4 md:flex-row md:items-center">
                <h2 class="text-xl font-semibold leading-tight">
                    Report
                </h2>
            </div>
        </template>

        <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1 w-full">
            <!-- Header -->
            <div class="text-gray-800 flex flex-col space-y-2">
                <span class="text-xl tracking-wide mx-auto">Report No. #{{ items.id }}</span>
                <div class="flex justify-between items-center text-gray-700">
                    <span>User / Entity <span class="font-semibold">{{ items.user.name }}</span></span>
                    <span>Date <span class="font-semibold">{{ dayjs(items.created_at).format('D, MMM YYYY - h:M A') }}</span></span>
                </div>
                <div class="bg-gray-50 rounded-md border py-2 px-4 space-y-2 border-b-0 rounded-b-none">
                    <span class="text-xl text-gray-800 tracking-wide">Provider Info</span>
                    <div class="grid grid-cols-2 items-start">
                        <div class="flex flex-col space-y-4 items-start">
                            <div class="flex flex-col space-y-2 items-start w-full pr-8">
                                <label class="text-xs">Brand name</label>
                                <span>{{ items.provider.brand_name }}</span>
                            </div>
                            <div class="flex flex-col space-y-2 items-start w-full pr-8">
                                <label class="text-xs">Speciality</label>
                                <span>{{ items.provider.speciality.name }}</span>
                            </div>
                            <div class="flex flex-col space-y-2 items-start w-full pr-8">
                                <label class="text-xs">Address</label>
                                <span>{{ items.provider.address1 }}</span>

                            </div>
                        </div>
                        <div class="flex flex-col space-y-4 items-start">
                            <div class="flex flex-col space-y-2 items-start w-full pr-8">
                                <label class="text-xs">Work email</label>
                                <span>{{ items.provider.work_email }}</span>
                            </div>
                            <div class="flex flex-col space-y-2 items-start w-full pr-8">
                                <label class="text-xs">Phone numbers</label>
                                <span>{{ items.provider.phone1 }}</span>

                            </div>
                        </div>
                    </div>
                </div> 
            </div>
            <!-- Body -->

            <!-- Body Items -->
            <div class="bg-gray-50 rounded-md border border-t-0 rounded-t-none py-2 px-4 space-y-2">
                <hr class="mb-3">
                <span class="text-xl text-gray-800 tracking-wide">Requested items</span>
                <div v-for="(item, index) in filteredItems" :key="item.id"  class="flex justify-between items-center px-2 text-gray-700 text-xs">
                    <span>
                        #{{ index + 1 }} - {{ item.item_found === 1 ? item.item_name : item.item_alt }}
                    </span>
                    <span>
                        ${{ item.price }} x{{ item.quantity_found }}
                    </span>
                </div>
                <hr class="">
                <div class="flex justify-end items-center text-gray-700">
                    <span>
                        <span>Total</span> <span class="font-semibold">${{ total }}</span>
                    </span>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
import { Head } from '@inertiajs/inertia-vue3'
import { computed } from '@vue/reactivity'
import dayjs from 'dayjs'

export default {
    components: {
        BreezeAuthenticatedLayout,
        Head
    },
    props: {
        items: Object
    },
    setup(props) {

        const filteredItems = computed(() => {
            return props.items.items.filter(a => a.item_found != 0)
        })

        const total = computed(() => {
            let tot = 0;
            filteredItems.value.forEach(element => {
                tot += element.price * element.quantity_found;
            });
            return tot;
        })


        return {
            total,
            filteredItems,
            dayjs
        }
    }
}
</script>
