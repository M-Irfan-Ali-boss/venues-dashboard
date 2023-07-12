<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { toast } from 'vue3-toastify';

defineProps({
  canResetPassword: {
    type: Boolean,
  },
  status: {
    type: String,
  },
});

const form = useForm({
  email: '',
  password: '',
  remember: false,
});

const submit = () => {
  form.post(route('login'), {
    onFinish: () => form.reset('password'),
    onSuccess: () => toast.success('Welcome back to THEBRAG MEDIA.'),
  });
};
</script>

<template>
  <GuestLayout>
    <Head title="Log in" />

    <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
      {{ status }}
    </div>

    <form @submit.prevent="submit" class="py-10 px-5 w-full">
      <div>
        <InputLabel for="email" value="Email" class="text-lg" />

        <TextInput
          id="email"
          type="email"
          class="mt-1 block w-full text-lg px-2 py-3"
          v-model="form.email"
          required
          autofocus
          autocomplete="username"
        />

        <InputError class="mt-2" :message="form.errors.email" />
      </div>

      <div class="mt-8">
        <InputLabel for="password" value="Password" class="text-lg" />

        <TextInput
          id="password"
          type="password"
          class="mt-1 block w-full px-2 py-3 text-lg"
          v-model="form.password"
          required
          autocomplete="current-password"
        />

        <InputError class="mt-2" :message="form.errors.password" />
      </div>

      <div class="block mt-5">
        <label class="flex items-center text-lg">
          <Checkbox
            name="remember"
            class="w-5 h-5"
            v-model:checked="form.remember"
          />
          <span class="ml-2 text-lg text-gray-600">Remember me</span>
        </label>
      </div>

      <div class="flex items-center justify-end mt-10">
        <Link
          v-if="canResetPassword"
          :href="route('password.request')"
          class="underline text-lg text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
        >
          Forgot your password?
        </Link>

        <PrimaryButton
          class="ml-4 text-base"
          :class="{ 'opacity-25': form.processing }"
          :disabled="form.processing"
        >
          Log in
        </PrimaryButton>
      </div>
    </form>
  </GuestLayout>
</template>
