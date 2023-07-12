<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { watch } from 'vue';
import { toast } from 'vue3-toastify';

const form = useForm({
  id: '',
  name: '',
  email: '',
  status: '',
});

const props = defineProps({
  staff: {
    type: Object,
    required: true,
  },
});

const submit = () => {
  form.post(route('update-staff'), {
    onFinish: () => {
      form.reset();
    },
    onSuccess: () => toast.success('Staff has been updated.'),
  });
};

watch(
  () => props.staff,
  (newVenue) => {
    form.id = newVenue?.id;
    form.name = newVenue?.name;
    form.email = newVenue?.email;
    form.status = newVenue?.status;
  },
  { immediate: true }
);
</script>

<template>
  <Head title="Add New Staff" />

  <AuthenticatedLayout>
    <div v-if="$page.props.error" class="error-message w-full block mb-5">
      <span
        class="flex items-center rounded-md bg-red-50 px-3 py-2 text-sm font-medium text-red-700 ring-1 ring-inset ring-red-600/10"
        >{{ $page.props.error }}</span
      >
    </div>
    <div
      className="grid grid-cols-1 gap-x-8 gap-y-10 border-b border-gray-900/10 pb-12 md:grid-cols-3"
    >
      <div>
        <h2 className="text-base font-semibold leading-7 text-gray-900">
          Staff Information
        </h2>
      </div>

      <form
        @submit.prevent="submit"
        className="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6 md:col-span-2"
      >
        <div class="sm:col-span-3">
          <InputLabel
            for="name"
            value="Name"
            className="block text-sm font-medium leading-6 text-gray-900"
          />

          <TextInput
            id="name"
            type="text"
            className="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400  sm:text-sm sm:leading-6"
            v-model="form.name"
            required
            autofocus
          />

          <InputError class="mt-2" :message="form.errors.name" />
        </div>
        <div class="sm:col-span-3">
          <InputLabel
            for="email"
            value="Email"
            className="block text-sm font-medium leading-6 text-gray-900"
          />

          <TextInput
            id="email"
            type="email"
            className="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400  sm:text-sm sm:leading-6"
            v-model="form.email"
            required
          />

          <InputError class="mt-2" :message="form.errors.email" />
        </div>
        <div class="sm:col-span-3">
          <InputLabel
            for="status"
            value="Status"
            className="block text-sm font-medium leading-6 text-gray-900"
          />

          <select
            v-model="form.status"
            id="status"
            name="status"
            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6"
          >
            <option value="Active">Active</option>
            <option value="Deactive">Deactive</option>
          </select>

          <InputError class="mt-2" :message="form.errors.status" />
        </div>

        <div class="flex items-center sm:col-span-6">
          <PrimaryButton
            :class="{ 'opacity-25': form.processing }"
            :disabled="form.processing"
          >
            Update Staff
          </PrimaryButton>
        </div>
      </form>
    </div>
  </AuthenticatedLayout>
</template>
