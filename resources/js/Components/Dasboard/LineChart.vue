<script setup>
import { ref } from "vue";
import VueApexCharts from "vue3-apexcharts";

const chartOptions = ref({
    chart: {
        height: 350,
        type: "line",
    },
    colors: ["#4F46E5", "#E54646"],
    stroke: {
        curve: "smooth",
    },
    title: {
        text: "Staffs",
        align: "left",
    },
    markers: {
        size: 1,
    },
    xaxis: {
        categories: ["2021", "2022", "2023"],
    },
    yaxis: {
        min: 0,
        max: 20,
    },
    legend: {
        position: "top",
        horizontalAlign: "right",
        floating: true,
        offsetY: -25,
        offsetX: -5,
    },
});

defineProps({
    staffCounts: {
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
                    {
                        name: 'Active',
                        data: [0, 0, staffCounts[0]?.count || 0],
                    },
                    {
                        name: 'Deactive',
                        data: [0, 0, staffCounts[1]?.count || 0],
                    },
                ]"
                height="250"
            />
        </div>
    </div>
</template>
