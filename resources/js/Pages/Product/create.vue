<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";

const data = defineProps({ products: Object });

const form = useForm({
    name: "",
    price: "",
    description: "",
    image_path: "",
    category_id: "",
});

const submit = () => {
    form.post(route("product.store"));
};
</script>

<template>
    <Head title="product" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                product
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex flex-col gap-1">
                <Link :href="route('product.index')" class="bg-gray-700 rounded-md py-2 px-4 w-fit text-white font-bold">
                    Back
                </Link>
                <div class="bg-white dark:bg-gray-700 overflow-hidden shadow-sm sm:rounded-lg p-1 grid grid-cols-3 gap-1">

                    <form @submit.prevent="submit" class="flex flex-col gap-1">
                        <div class="bg-gray-800 rounded-md p-4">
                            <InputLabel for="name" value="Name"/>

                            <TextInput
                                id="name"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.name"
                                required
                                autofocus
                            />

                            <InputError
                                class="mt-2"
                                :message="form.errors.name"
                            />
                        </div>
                        <div class="bg-gray-800 rounded-md p-4">
                            <InputLabel for="price" value="Price" />

                            <TextInput
                                id="price"
                                type="number"
                                class="mt-1 block w-full"
                                v-model="form.price"
                                required
                                autofocus
                            />

                            <InputError
                                class="mt-2"
                                :message="form.errors.price"
                            />
                        </div>
                        <div class="bg-gray-800 rounded-md p-4">
                            <InputLabel for="description" value="Description" />

                            <textarea
                                cols="30"
                                rows="10"

                                id="description"
                                type="description"
                                class="mt-1 block w-full"
                                v-model="form.description"
                                required
                                autofocus
                            />

                            <InputError
                                class="mt-2"
                                :message="form.errors.description"
                            />
                        </div>
                        <div class="bg-gray-800 rounded-md p-4">
                            <InputLabel for="image_path" value="Image" />
                            <input
                                type="file"
                                accept="image/*"
                                @input="form.image_path = $event.target.files[0]"
                            />

                            <InputError
                                class="mt-2"
                                :message="form.errors.image_path"
                            />
                        </div>
                        <div class="bg-gray-800 rounded-md p-4">
                            <InputLabel for="category_id" value="Category id" />

                            <TextInput
                                id="category_id"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.category_id"
                                required
                                autofocus
                            ></TextInput>

                            <InputError
                                class="mt-2"
                                :message="form.errors.category_id"
                            />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <PrimaryButton
                                class="ml-4"
                                :class="{ 'opacity-25': form.processing }"
                                :disabled="form.processing"
                            >
                                Save
                            </PrimaryButton>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
