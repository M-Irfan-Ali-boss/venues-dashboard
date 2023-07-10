<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import DonutChart from "@/Components/Dasboard/DonutChart.vue";
import LineChart from "@/Components/Dasboard/LineChart.vue";
import VenueTable from "@/Components/Dasboard/VenueTable.vue";

defineProps({
    venueCounts: {
        type: Object,
        required: true,
    },
    staffCounts: {
        type: Object,
        required: true,
    },
    venues: {
        type: Array,
        required: true,
    },
});
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-10">
            <LineChart :staffCounts="staffCounts" />
            <DonutChart :venueCounts="venueCounts" />
            <VenueTable :venues="venues" />
        </div>
    </AuthenticatedLayout>
</template>
