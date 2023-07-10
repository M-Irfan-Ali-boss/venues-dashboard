<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link } from "@inertiajs/vue3";
import StaffTableRow from "@/Components/Staff/StaffTableRow.vue";

defineProps({
    staffMembers: {
        type: Array,
        required: true,
    },
});
</script>

<template>
    <Head title="Staff" />

    <AuthenticatedLayout>
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-3xl font-semibold leading-6 text-gray-900">
                    Staffs
                </h1>
                <p class="mt-2 text-base text-gray-700">
                    A list of all Staff in your connected to you including their
                    relevant information
                </p>
            </div>
            <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                <Link
                    :href="route('createStaff')"
                    class="block rounded-md bg-gray-600 px-8 py-3 text-center text-base font-semibold text-white shadow-sm hover:bg-gray-700"
                    >Add Staff</Link
                >
            </div>
        </div>
        <div class="mt-8 flow-root">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div
                    class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8"
                >
                    <table class="min-w-full divide-y divide-gray-300">
                        <thead>
                            <tr>
                                <th
                                    scope="col"
                                    class="py-3.5 pl-2 pr-3 text-left text-base font-semibold text-gray-900 sm:pl-0"
                                >
                                    ID
                                </th>
                                <th
                                    scope="col"
                                    class="px-3 py-3.5 text-left text-base font-semibold text-gray-900"
                                >
                                    User information
                                </th>
                                <th
                                    scope="col"
                                    class="px-3 py-3.5 text-left text-base font-semibold text-gray-900"
                                >
                                    Email
                                </th>
                                <th
                                    scope="col"
                                    class="px-3 py-3.5 text-left text-base font-semibold text-gray-900"
                                >
                                    Role
                                </th>
                                <th
                                    scope="col"
                                    class="px-3 py-3.5 text-left text-base font-semibold text-gray-900"
                                >
                                    Status
                                </th>
                                <th
                                    scope="col"
                                    class="px-3 py-3.5 text-center text-base font-semibold text-gray-900"
                                >
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <tr
                                v-for="staff in staffMembers"
                                :key="staff.email"
                            >
                                <StaffTableRow :staff="staff" />
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
