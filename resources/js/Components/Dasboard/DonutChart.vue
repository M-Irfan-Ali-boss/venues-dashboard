<script setup>
import { ref } from "vue";
import VueApexCharts from "vue3-apexcharts";

const chartOptions = ref({
    chart: {
        type: "donut",
    },
    title: {
        text: "Venues",
        align: "left",
    },
    subtitle: {
        text: "Total Venues (Pubic,Private)",
        align: "left",
    },
    plotOptions: {
        pie: {
            startAngle: -90,
            endAngle: 90,
            offsetY: 10,
        },
    },
    colors: ["#15803D", "#E54646"],
    responsive: [
        {
            breakpoint: 480,
            options: {
                chart: {
                    width: 200,
                },
                legend: {
                    position: "bottom",
                },
            },
        },
    ],
});

defineProps({
    venueCounts: {
        type: Array,
        required: true,
    },
});
</script>

<template>
    <div class="bg-white rounded-lg shadow-md p-5 border border-gray-200">
        <div id="chart">
            <VueApexCharts
                :options="chartOptions"
                :series="[
                    venueCounts[1]?.count || 0,
                    venueCounts[0]?.count || 0,
                ]"
                height="250"
            />
        </div>
    </div>
</template>
