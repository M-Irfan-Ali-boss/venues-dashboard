<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, useForm } from "@inertiajs/vue3";

const form = useForm({
    name: "",
    email: "",
    password: "",
    password_confirmation: "",
});

const submit = () => {
    form.post(route("create-staff"), {
        onFinish: () => form.reset("password"),
    });
};
</script>

<template>
    <Head title="Add New Staff" />

    <AuthenticatedLayout>
        <div v-if="$page.props.error" class="error-message w-full block mb-5">
            <span
                class="flex items-center rounded-md bg-red-50 px-3 py-2 text-lg font-medium text-red-700 ring-1 ring-inset ring-red-600/10"
                >{{ $page.props.error }}</span
            >
        </div>
        <div
            className="grid grid-cols-1 gap-x-8 gap-y-10 border-b border-gray-900/10 pb-12 md:grid-cols-3"
        >
            <div>
                <h2 className="text-lg font-semibold leading-7 text-gray-900">
                    Staff Information
                </h2>
            </div>

            <form
                @submit.prevent="submit"
                className="grid grid-cols-1 gap-x-6 gap-y-8 col-span-2"
            >
                <div class="w-full block">
                    <InputLabel
                        for="name"
                        value="Name"
                        className="block text-lg font-medium leading-6 text-gray-900"
                    />

                    <TextInput
                        id="name"
                        type="text"
                        className="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400  sm:text-lg sm:leading-6"
                        v-model="form.name"
                        required
                        autofocus
                    />

                    <InputError class="mt-2" :message="form.errors.name" />
                </div>
                <div class="w-full block">
                    <InputLabel
                        for="email"
                        value="Email"
                        className="block text-lg font-medium leading-6 text-gray-900"
                    />

                    <TextInput
                        id="email"
                        type="email"
                        className="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400  sm:text-lg sm:leading-6"
                        v-model="form.email"
                        required
                    />

                    <InputError class="mt-2" :message="form.errors.email" />
                </div>
                <div class="w-full block">
                    <InputLabel
                        for="password"
                        value="Password"
                        className="block text-lg font-medium leading-6 text-gray-900"
                    />

                    <TextInput
                        id="password"
                        type="password"
                        className="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400  sm:text-lg sm:leading-6"
                        v-model="form.password"
                        required
                    />

                    <InputError class="mt-2" :message="form.errors.password" />
                </div>
                <div class="w-full block">
                    <InputLabel
                        for="password_confirmation"
                        value="Confirm Password"
                        className="block text-lg font-medium leading-6 text-gray-900"
                    />

                    <TextInput
                        id="password_confirmation"
                        type="password"
                        className="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400  sm:text-lg sm:leading-6"
                        v-model="form.password_confirmation"
                        required
                    />

                    <InputError
                        class="mt-2"
                        :message="form.errors.password_confirmation"
                    />
                </div>

                <div class="flex items-center">
                    <PrimaryButton
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                    >
                        Add New Staff
                    </PrimaryButton>
                </div>
            </form>
        </div>
    </AuthenticatedLayout>
</template>
