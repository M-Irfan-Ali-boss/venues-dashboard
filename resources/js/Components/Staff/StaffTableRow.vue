<script setup>
import { PencilIcon, TrashIcon } from "@heroicons/vue/24/outline";
import { Link } from "@inertiajs/vue3";

defineProps({
    staff: {
        type: Object,
    },
});
</script>

<template>
    <td
        class="whitespace-nowrap p-2 text-base font-medium text-gray-900 sm:pl-0"
    >
        {{ staff.id }}
    </td>
    <td class="whitespace-nowrap p-2 text-base text-gray-500">
        {{ staff.name }}
    </td>
    <td class="whitespace-nowrap p-2 text-base text-gray-500">
        {{ staff.email }}
    </td>
    <td class="whitespace-nowrap p-2 text-base text-gray-500">
        {{ staff.role }}
    </td>
    <td class="whitespace-nowrap p-2 text-base text-gray-500">
        <span
            v-if="staff.status === 'Active'"
            class="inline-flex items-center rounded-md bg-greenn-50 px-2 py-1 text-xs font-medium text-greenn-700 ring-1 ring-inset ring-greenn-600/10"
            >Active</span
        >
        <span
            v-else
            class="inline-flex items-center rounded-md bg-red-50 px-2 py-1 text-xs font-medium text-red-700 ring-1 ring-inset ring-red-600/10"
            >Deactive</span
        >
    </td>

    <td
        class="relative whitespace-nowrap p-2 text-right text-base font-medium flex justify-center"
    >
        <Link :href="route('editStaff', staff.id)">
            <PencilIcon class="w-4 h-4 text-gray-500" />
        </Link>
        <Link :href="route('deleteStaff', staff.id)"
            ><TrashIcon class="w-4 h-4 text-red-500 ml-2"
        /></Link>
    </td>
</template>
