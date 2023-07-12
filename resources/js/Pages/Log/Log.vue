<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import moment from 'moment';

defineProps({
  logs: {
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
        <h1 class="text-2xl font-semibold leading-6 text-gray-900">
          Activity Logs
        </h1>
        <p class="mt-2 text-base text-gray-700">
          A list of all the event logs.
        </p>
      </div>
    </div>
    <div class="mt-8 flow-root">
      <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
          <table class="min-w-full divide-y divide-gray-300">
            <tbody class="divide-y divide-gray-200">
              <tr v-for="log in logs" :key="log.email">
                <td
                  class="whitespace-nowrap p-2 text-base font-medium text-gray-900 sm:pl-0"
                >
                  Log id <b>{{ log.id }}:</b>
                  {{
                    log?.manager
                      ? log?.manager?.name
                      : log?.staff
                      ? log?.staff?.name
                      : ''
                  }}
                  {{
                    log.type === 'event_create'
                      ? 'created an event'
                      : log.type === 'event_updated'
                      ? 'updated an event'
                      : log.type === 'event_deleted'
                      ? 'deleted an event'
                      : log.type === 'assign_staff'
                      ? 'assign to staff'
                      : ''
                  }}
                  {{ log?.venue?.name }}
                  at {{ moment(log.created_at).format('lll') }}.
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
