<script setup>
import { Link } from "@inertiajs/vue3";
import { PencilIcon, TrashIcon } from "@heroicons/vue/24/outline";

defineProps({
    venue: {
        type: Object,
    },
});
</script>

<template>
    <td
        class="whitespace-nowrap p-2 text-base font-medium text-gray-900 sm:pl-0"
    >
        {{ venue.id }}
    </td>
    <td class="whitespace-nowrap p-2 text-base text-gray-500">
        <b class="font-semibold block">{{ venue.name }}</b>
        {{
            venue.address <= 30
                ? venue.address
                : venue.address.substring(0, 30) + "..."
        }}
    </td>
    <td class="whitespace-nowrap p-2 text-base text-gray-500">
        {{
            venue.description <= 30
                ? venue.description
                : venue.description.substring(0, 30) + "..."
        }}
    </td>
    <td class="whitespace-nowrap p-2 text-base text-gray-500">
        {{ venue.type }}
    </td>
    <td class="whitespace-nowrap p-2 text-base text-gray-500">
        {{ venue.phone }}
    </td>
    <td class="whitespace-nowrap p-2 text-base text-gray-500">
        {{ venue.email }}
    </td>
    <td class="whitespace-nowrap p-2 text-base text-gray-500">
        {{
            venue.website <= 30
                ? venue.website
                : venue.website.substring(0, 30) + "..."
        }}
    </td>
    <td class="whitespace-nowrap p-2 text-base text-gray-500">
        {{ venue.latitude + "N , " + venue.longitude + "E" }}
    </td>
    <td class="whitespace-nowrap p-2 text-base text-gray-500">
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
    <td
        class="relative whitespace-nowrap p-2 text-right text-base font-medium flex justify-center"
    >
        <Link :href="route('editVenue', venue.id)"
            ><PencilIcon class="w-4 h-4 text-gray-500"
        /></Link>
        <Link
            v-if="$page.props.auth.user.role === 'Manager'"
            :href="route('deleteVenue', venue.id)"
            ><TrashIcon class="w-4 h-4 text-red-500 ml-2"
        /></Link>
    </td>
</template>
