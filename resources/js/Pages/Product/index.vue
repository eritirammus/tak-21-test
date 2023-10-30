<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link } from "@inertiajs/vue3";

const data = defineProps({ products: Object });
const url = window.location.origin;
</script>

<template>
    <Head title="product" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
            >
                Product
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex flex-col gap-1">
                <Link :href="route('product.create')" class="bg-gray-700 rounded-md py-2 px-4 w-fit text-white font-bold">Add new</Link>
                <div
                    class="bg-white dark:bg-gray-700 overflow-hidden shadow-sm sm:rounded-lg p-1 grid grid-cols-3 gap-1"
                >
                    <div
                        v-for="product in products"
                        :key="product.id"
                        class="p-6 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 w-full h-fit rounded-md flex flex-col"
                    >
                        <p>{{ product.name }}</p>
                        <p>{{ product.price }}</p>
                        <p>{{ product.description }}</p>
                        <p>{{ product.image_path }}</p>
                        <p>{{ product.category_id }}</p>
                        <img :src="url + '/storage/' + product.image_path" :alt="product.name">

                        <div class="flex gap-4 pt-2">
                            <Link class="" :href="route('product.edit', product)">Edit</Link>
                            <Link class="text-red-500" method="delete" :href="route('product.destroy', product)">Delete</Link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
