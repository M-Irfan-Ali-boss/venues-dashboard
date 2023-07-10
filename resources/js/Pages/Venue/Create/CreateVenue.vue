<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, useForm } from "@inertiajs/vue3";
import Textarea from "@/Components/Textarea.vue";

const form = useForm({
    name: "",
    email: "",
    phone: "",
    address: "",
    website: "",
    description: "",
    status: "Activated",
    type: "Public",
    latitude: "",
    longitude: "",
    staff_id: "",
});

const submit = () => {
    form.post(route("create-venue"), {
        onFinish: () => form.reset(),
    });
};

defineProps({
    staffs: {
        type: Array,
        required: true,
    },
    role: {
        type: String,
        required: true,
    },
});
</script>

<template>
    <Head title="Add New Venue" />

    <AuthenticatedLayout>
        <div
            className="grid grid-cols-1 gap-x-8 gap-y-10 border-b border-gray-900/10 pb-12 md:grid-cols-3"
        >
            <div>
                <h2 className="text-base font-semibold leading-7 text-gray-900">
                    Venue Information
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
                        for="phone"
                        value="Phone Number"
                        className="block text-sm font-medium leading-6 text-gray-900"
                    />

                    <TextInput
                        id="phone"
                        type="text"
                        className="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400  sm:text-sm sm:leading-6"
                        v-model="form.phone"
                        required
                    />

                    <InputError class="mt-2" :message="form.errors.phone" />
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
                        for="website"
                        value="Website"
                        className="block text-sm font-medium leading-6 text-gray-900"
                    />

                    <TextInput
                        id="website"
                        type="text"
                        className="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400  sm:text-sm sm:leading-6"
                        v-model="form.website"
                        required
                    />

                    <InputError class="mt-2" :message="form.errors.website" />
                </div>
                <div class="sm:col-span-3">
                    <InputLabel
                        for="latitude"
                        value="Latitude"
                        className="block text-sm font-medium leading-6 text-gray-900"
                    />

                    <TextInput
                        id="latitude"
                        type="text"
                        className="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400  sm:text-sm sm:leading-6"
                        v-model="form.latitude"
                        required
                        autofocus
                    />

                    <InputError class="mt-2" :message="form.errors.latitude" />
                </div>
                <div class="sm:col-span-3">
                    <InputLabel
                        for="longitude"
                        value="Longitude"
                        className="block text-sm font-medium leading-6 text-gray-900"
                    />

                    <TextInput
                        id="longitude"
                        type="text"
                        className="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400  sm:text-sm sm:leading-6"
                        v-model="form.longitude"
                        required
                        autofocus
                    />

                    <InputError class="mt-2" :message="form.errors.longitude" />
                </div>
                <div class="sm:col-span-3">
                    <InputLabel
                        for="type"
                        value="Type of Venue"
                        className="block text-sm font-medium leading-6 text-gray-900"
                    />

                    <select
                        v-model="form.type"
                        id="type"
                        name="type"
                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6"
                    >
                        <option value="Public">Public</option>
                        <option value="Private">Private</option>
                    </select>

                    <InputError class="mt-2" :message="form.errors.type" />
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
                        <option value="Activated">Activated</option>
                        <option value="Deactivated">Deactivated</option>
                    </select>

                    <InputError class="mt-2" :message="form.errors.status" />
                </div>
                <div class="sm:col-span-3">
                    <InputLabel
                        for="staff_id"
                        value="Assign to Staff"
                        className="block text-sm font-medium leading-6 text-gray-900"
                    />

                    <select
                        v-model="form.staff_id"
                        id="staff_id"
                        name="staff_id"
                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6"
                    >
                        <option
                            v-for="staff in staffs"
                            :key="staff.id"
                            :value="staff.id"
                        >
                            {{ staff.name }}
                        </option>
                    </select>

                    <InputError class="mt-2" :message="form.errors.staff" />
                </div>
                <div class="sm:col-span-6">
                    <InputLabel
                        for="description"
                        value="Description"
                        className="block text-sm font-medium leading-6 text-gray-900"
                    />

                    <Textarea
                        id="description"
                        type="text"
                        className="block w-full resize-none rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400  sm:text-sm sm:leading-6"
                        v-model="form.description"
                        required
                        autofocus
                    />

                    <InputError
                        class="mt-2"
                        :message="form.errors.description"
                    />
                </div>
                <div class="sm:col-span-6">
                    <InputLabel
                        for="address"
                        value="Full Address"
                        className="block text-sm font-medium leading-6 text-gray-900"
                    />

                    <Textarea
                        id="address"
                        type="text"
                        className="block w-full resize-none rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400  sm:text-sm sm:leading-6"
                        v-model="form.address"
                        required
                        autofocus
                    />

                    <InputError class="mt-2" :message="form.errors.address" />
                </div>

                <div class="flex items-center mt-4 w-full sm:col-span-6">
                    <PrimaryButton
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                    >
                        Add New Venue
                    </PrimaryButton>
                </div>
            </form>
        </div>
    </AuthenticatedLayout>
</template>
