<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link } from "@inertiajs/vue3";
import VenueTableRow from "@/Components/Venue/VenueTableRow.vue";

defineProps({
    venues: {
        type: Array,
        required: true,
    },
    role: {
        type: String,
        required: true,
    },
});
</script>

<template>
    <Head title="Staff" />

    <AuthenticatedLayout>
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-2xl font-semibold leading-6 text-gray-900">
                    Venues
                </h1>
                <p class="mt-2 text-base text-gray-700">
                    A list of all Venue in your connected to you including their
                    relevant staff
                </p>
            </div>
            <div
                v-if="$page.props.auth.user.role === 'Manager'"
                class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none"
            >
                <Link
                    :href="route('createVenue')"
                    class="block rounded-md bg-gray-600 px-5 py-3 text-center text-base font-semibold text-white shadow-sm hover:bg-gray-700"
                    >Add New Venue</Link
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
                                    class="p-2 text-left text-base font-semibold text-gray-900 sm:pl-0"
                                >
                                    ID
                                </th>
                                <th
                                    scope="col"
                                    class="p-2 text-left text-base font-semibold text-gray-900"
                                >
                                    Venue Information
                                </th>
                                <th
                                    scope="col"
                                    class="p-2 text-left text-base font-semibold text-gray-900"
                                >
                                    Description
                                </th>
                                <th
                                    scope="col"
                                    class="p-2 text-left text-base font-semibold text-gray-900"
                                >
                                    Type
                                </th>
                                <th
                                    scope="col"
                                    class="p-2 text-left text-base font-semibold text-gray-900"
                                >
                                    Phone
                                </th>
                                <th
                                    scope="col"
                                    class="p-2 text-left text-base font-semibold text-gray-900"
                                >
                                    Email
                                </th>
                                <th
                                    scope="col"
                                    class="p-2 text-left text-base font-semibold text-gray-900"
                                >
                                    Website
                                </th>
                                <th
                                    scope="col"
                                    class="p-2 text-left text-base font-semibold text-gray-900"
                                >
                                    Latitude/Longitude
                                </th>
                                <th
                                    scope="col"
                                    class="p-2 text-left text-base font-semibold text-gray-900"
                                >
                                    Status
                                </th>
                                <th
                                    scope="col"
                                    class="p-2 text-left text-base font-semibold text-gray-900"
                                >
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <tr v-for="venue in venues" :key="venue.email">
                                <VenueTableRow :venue="venue" />
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
