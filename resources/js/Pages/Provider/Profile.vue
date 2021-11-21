<template>
  <Head title="Profile"/>

  <BreezeAuthenticatedLayout>
        <template #header>
            <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                <h2 class="text-xl font-semibold leading-tight">
                    Profile
                </h2>
                <span v-if="$page.props.flash.message" class="bg-red-400 rounded-md shadow-md border-1 border-red-500 px-4 py-2 text-white">message: {{ $page.props.flash.message }}</span>
            </div>
        </template>

        <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
            <form @submit.prevent="submitForm">

            <div class="grid grid-cols-2 items-start">
                <div class="flex flex-col space-y-4 items-start">
                    <div class="flex flex-col space-y-2 items-start w-full pr-8">
                        <label class="text-xs">Brand name:</label>
                        <span v-if="prov_available">{{ provider_info.brand_name }}</span>
                        <input v-show="!prov_available" type="text" v-model="prov_form.brand_name" placeholder="Brand name" class="w-full lg:w-1/2 rounded-md text-xs focus:ring-indigo-500">
                    </div>
                    <div class="flex flex-col space-y-2 items-start w-full pr-8">
                        <label class="text-xs">Speciality:</label>
                        <span v-if="prov_available">{{ provider_info.speciality.name }}</span>
                        <select v-show="!prov_available" v-model="prov_form.speciality_id" class="w-full lg:w-1/2 rounded-md text-xs focus:ring-indigo-500">
                            <option disabled value="">Please select an option</option>
                            <option v-for="item in $page.props.speciality" :key="item.id" :value="item.id" :selected="item.id === '1' ? true : false">{{ item.name }}</option>
                        </select>
                    </div>
                    <div class="flex flex-col space-y-2 items-start w-full pr-8">
                        <label class="text-xs">Address:</label>
                        <span v-if="prov_available">{{ provider_info.address1 }}</span>
                        <span v-if="prov_available">{{ provider_info.address2 }}</span>
                        <input v-show="!prov_available" type="text" id="address" v-model="prov_form.address1" placeholder="Address 1" class="w-full lg:w-1/2 rounded-md text-xs focus:ring-indigo-500">
                        <input v-show="!prov_available" type="text" id="address" v-model="prov_form.address2" placeholder="Address 2" class="w-full lg:w-1/2 rounded-md text-xs focus:ring-indigo-500">
                    </div>
                </div>
                <div class="flex flex-col space-y-4 items-start">
                    <div class="flex flex-col space-y-2 items-start w-full pr-8">
                        <label class="text-xs">Owner name:</label>
                        <span v-if="prov_available">{{ provider_info.owner_name }}</span>
                        <input v-show="!prov_available" type="text" v-model="prov_form.owner_name" placeholder="Owner name" class="w-full lg:w-1/2 rounded-md text-xs focus:ring-indigo-500">
                    </div>
                    <div class="flex flex-col space-y-2 items-start w-full pr-8">
                        <label class="text-xs">Work email:</label>
                        <span v-if="prov_available">{{ provider_info.work_email }}</span>
                        <input v-show="!prov_available" type="email" v-model="prov_form.work_email" placeholder="Email" class="w-full lg:w-1/2 rounded-md text-xs focus:ring-indigo-500">
                    </div>
                    <div class="flex flex-col space-y-2 items-start w-full pr-8">
                        <label class="text-xs">Phone numbers:</label>
                        <span v-if="prov_available">{{ provider_info.phone1 }}</span>
                        <span v-if="prov_available">{{ provider_info.phone2 }}</span>
                        <span v-if="prov_available">{{ provider_info.phone3 }}</span>
                        <input v-show="!prov_available" type="text" id="phone" v-model="prov_form.phone1" placeholder="Phone 1" class="w-full lg:w-1/2 rounded-md text-xs focus:ring-indigo-500">
                        <input v-show="!prov_available" type="text" id="phone" v-model="prov_form.phone2" placeholder="Phone 2" class="w-full lg:w-1/2 rounded-md text-xs focus:ring-indigo-500">
                        <input v-show="!prov_available" type="text" id="phone" v-model="prov_form.phone3" placeholder="Phone 3" class="w-full lg:w-1/2 rounded-md text-xs focus:ring-indigo-500">
                    </div>
                </div>
            </div>
            <button v-show="!prov_available" class="px-4 py-2 rounded-md bg-green-400 hover:bg-green-500 shadow-md text-white" type="submit">Save info</button>
            </form>
        </div>
  </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
import { Head, useForm } from '@inertiajs/inertia-vue3'

export default {
    components: {
        BreezeAuthenticatedLayout,
        Head,
    },
    props: {
        prov_available: Boolean,
        provider_info: Object
    },
    setup() {
        const prov_form = useForm({
            brand_name: null,
            owner_name: null,
            work_email: null,
            phone1: null,
            phone2: null,
            phone3: null,
            address1: null,
            address2: null,
            speciality_id: 1
        })

        function submitForm() {
            prov_form.post(route('profile.store'), {
                onSuccess: () => {
                    console.log('Successfull!')
                }
            })
        }

        return {
            prov_form,
            submitForm
        }
    }
}
</script>