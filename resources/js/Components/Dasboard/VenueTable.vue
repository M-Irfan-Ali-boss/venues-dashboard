<script setup>
defineProps({
    venues: {
        type: Array,
        required: true,
    },
});
</script>

<template>
    <div
        class="col-span-2 bg-white border border-gray-200 shadow-md rounded-md p-5"
    >
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-2xl font-semibold leading-6 text-gray-900">
                    Venues
                </h1>
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
                                    Status
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <tr v-for="venue in venues" :key="venue.email">
                                <td
                                    class="whitespace-nowrap p-2 text-base font-medium text-gray-900 sm:pl-0"
                                >
                                    {{ venue.id }}
                                </td>
                                <td
                                    class="whitespace-nowrap p-2 text-base text-gray-500"
                                >
                                    <b class="font-semibold block">{{
                                        venue.name
                                    }}</b>
                                    {{
                                        venue.address <= 30
                                            ? venue.address
                                            : venue.address.substring(0, 30) +
                                              "..."
                                    }}
                                </td>
                                <td
                                    class="whitespace-nowrap p-2 text-base text-gray-500"
                                >
                                    {{ venue.phone }}
                                </td>
                                <td
                                    class="whitespace-nowrap p-2 text-base text-gray-500"
                                >
                                    {{ venue.email }}
                                </td>
                                <td
                                    class="whitespace-nowrap p-2 text-base text-gray-500"
                                >
                                    <span
                                        v-if="venue.status === 'Activated'"
                                        class="inline-flex items-center rounded-md bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/10"
                                        >Activated</span
                                    >
                                    <span
                                        v-else="venue.status === 'Activated'"
                                        class="inline-flex items-center rounded-md bg-red-50 px-2 py-1 text-xs font-medium text-red-700 ring-1 ring-inset ring-red-600/10"
                                        >Deactive</span
                                    >
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>
