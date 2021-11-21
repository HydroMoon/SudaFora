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

        <div class="p-6 bg-white rounded-md shadow-md dark:bg-dark-eval-1">
            <div class="grid grid-cols-2 items-start">
                <div class="flex flex-col space-y-4 items-start">
                    <div class="flex flex-col space-y-2 items-start w-full">
                        <label class="text-xs">User/Entity name:</label>
                        <span v-if="user_available">{{ user_info.name }}</span>
                        <input v-if="!user_available" v-model="info_form.name" type="text" placeholder="Name" class="w-full lg:w-1/2 rounded-md text-xs focus:ring-indigo-500">
                    </div>
                    <div class="flex flex-col space-y-2 items-start w-full">
                        <label class="text-xs">Address:</label>
                        <span v-if="user_available">{{ user_info.address }}</span>
                        <input v-if="!user_available" v-model="info_form.address" type="text" placeholder="Address" class="w-full lg:w-1/2 rounded-md text-xs focus:ring-indigo-500">
                    </div>
                </div>
                <div class="flex flex-col space-y-4 items-start">
                    <div class="flex flex-col space-y-2 items-start w-full">
                        <label class="text-xs">Email:</label>
                        <span>{{ $page.props.auth.user.email }}</span>
                    </div>
                    <div class="flex flex-col space-y-2 items-start w-full">
                        <label class="text-xs">Phone numbers:</label>
                        <span v-if="user_available">{{ user_info.phone }}</span>
                        <input v-if="!user_available" v-model="info_form.phone" type="text" placeholder="Phone" class="w-full lg:w-1/2 rounded-md text-xs focus:ring-indigo-500">
                    </div>
                </div>
            </div>
            <button v-show="!user_available" @click="saveInfo()" class="px-4 py-2 mt-2 rounded-md bg-green-400 hover:bg-green-500 shadow-md text-xs text-white">Save info</button>
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
        user_available: Boolean,
        user_info: Object
    },
    setup() {
        const info_form = useForm({
            name: null,
            phone: null,
            address: null
        })
        const saveInfo = () => {
            info_form.post(route('user.profile.store'), {
                onSuccess: () => {
                    console.log('Successfull!')
                }
            })
        }

        return {
            info_form,
            saveInfo
        }
    }
}
</script>