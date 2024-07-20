<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
defineProps({
    product: {
        type: Object,
        required: true
    }
})
</script>

<template>
    <Head title="Show Product" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Show Product</h2>
                <Link :href="route('products.index')" class="font-medium rounded-md text-sm px-5 py-2.5 text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200">Manage products</Link>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex items-center justify-center">
                    <div class="relative bg-white rounded-lg shadow w-full max-w-2xl max-h-full">
                        <div class="p-6 space-y-6">
                            <div class="grid grid-cols-6 gap-6">
                                <div class="col-span-6 sm:col-span-3">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 ">Product name</label>
                                    <p class="text-sm text-gray-900 w-full py-2.5">{{ product.name }}</p>                                       
                                </div>
                                <div class="col-span-6 sm:col-span-3">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 ">Brand</label>
                                    <p class="text-sm text-gray-900 w-full py-2.5">{{ product.brand }}</p>
                                </div>
                                <div class="col-span-6 sm:col-span-3">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 ">Category</label>
                                    <p class="text-sm text-gray-900 w-full py-2.5">{{ product.category.name }}</p>
                                </div>
                                <div class="col-span-6 sm:col-span-3">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 ">Price</label>
                                    <p class="text-sm text-gray-900 w-full py-2.5">{{ product.price_formatted }}</p>
                                </div>
                                <div class="col-span-6 sm:col-span-3">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 ">Weight (kg)</label>
                                    <p class="text-sm text-gray-900 w-full py-2.5">{{ product.weight }}</p>
                                </div>
                                <div class="col-span-6 sm:col-span-6">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 ">Description</label>
                                    <p class="text-sm text-gray-900 w-full py-2.5">{{ product.description }}</p>
                                </div>
                                <div class="col-span-6 sm:col-span-6 space-x-2">
                                    <Link :href="route('products.edit', product.id)" class="text-white bg-indigo-700 hover:bg-indigo-800 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Edit</Link>
                                    <Link :href="route('products.index')" class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5">Cancel</Link>
                                </div>
                            </div>
                        </div>
                        </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>