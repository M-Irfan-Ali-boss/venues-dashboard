<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { toast } from 'vue3-toastify';

const form = useForm({
  name: '',
  email: '',
  password: '',
  password_confirmation: '',
  role: 'manager',
});

const submit = () => {
  form.post(route('register'), {
    onFinish: () => {
      form.reset('password', 'password_confirmation');
    },
    onSuccess: () => {
      form.name = '';
      form.email = '';
      form.password = '';
      form.password_confirmation = '';
      toast.success(
        'Verification email has been sent please verify your email.'
      );
    },
  });
};
</script>

<template>
  <GuestLayout>
    <Head title="Register" />

    <form @submit.prevent="submit" class="py-10">
      <div>
        <InputLabel for="name" value="Name" class="text-lg" />

        <TextInput
          id="name"
          type="text"
          class="mt-1 block w-full text-lg"
          v-model="form.name"
          required
          autofocus
          autocomplete="name"
        />

        <InputError class="mt-2" :message="form.errors.name" />
      </div>

      <div class="mt-8">
        <InputLabel for="email" value="Email" class="text-lg" />

        <TextInput
          id="email"
          type="email"
          class="mt-1 block w-full text-lg"
          v-model="form.email"
          required
          autocomplete="username"
        />

        <InputError class="mt-2" :message="form.errors.email" />
      </div>

      <div class="mt-8">
        <InputLabel for="password" value="Password" class="text-lg" />

        <TextInput
          id="password"
          type="password"
          class="mt-1 block w-full text-lg"
          v-model="form.password"
          required
          autocomplete="new-password"
        />

        <InputError class="mt-2" :message="form.errors.password" />
      </div>

      <div class="mt-8">
        <InputLabel
          for="password_confirmation"
          value="Confirm Password"
          class="text-lg"
        />

        <TextInput
          id="password_confirmation"
          type="password"
          class="mt-1 block w-full text-lg"
          v-model="form.password_confirmation"
          required
          autocomplete="new-password"
        />

        <InputError class="mt-2" :message="form.errors.password_confirmation" />
      </div>

      <div class="flex items-center justify-end mt-8">
        <Link
          :href="route('login')"
          class="underline text-base text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
        >
          Already registered?
        </Link>

        <PrimaryButton
          class="ml-4 text-base"
          :class="{ 'opacity-25': form.processing }"
          :disabled="form.processing"
        >
          Register
        </PrimaryButton>
      </div>
    </form>
  </GuestLayout>
</template>
