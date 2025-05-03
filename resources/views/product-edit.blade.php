@extends('layouts.app')

@section('title', 'Manage Products')

@section('content')

@include('includes.nav')


<div class="container m-auto p-4 sm:p-8 max-w-full">

    <h1 class="text-2xl md:text-3xl font-bold text-left text-blue-400">Mange Products</h1>
    <p class="text-gray-600 text-left mb-4">Effortlessly edit, update your products to keep your shop up to date</p>


    <!-- Show Success/Error Message -->
    @if(session('success'))
    <div id="success-message"
        class="fixed top-[80px] right-4 left-4 z-50 flex w-auto md:right-4 md:left-auto md:w-[500px] overflow-hidden bg-emerald-50 rounded-lg shadow-[0px_2px_3px_-1px_rgba(0,0,0,0.1),0px_1px_0px_0px_rgba(25,28,33,0.02),0px_0px_0px_1px_rgba(25,28,33,0.08)] dark:bg-gray-800">
        <div class="flex items-center justify-center w-12 bg-emerald-500">
            <svg class="w-6 h-6 text-white fill-current" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M20 3.33331C10.8 3.33331 3.33337 10.8 3.33337 20C3.33337 29.2 10.8 36.6666 20 36.6666C29.2 36.6666 36.6667 29.2 36.6667 20C36.6667 10.8 29.2 3.33331 20 3.33331ZM16.6667 28.3333L8.33337 20L10.6834 17.65L16.6667 23.6166L29.3167 10.9666L31.6667 13.3333L16.6667 28.3333Z" />
            </svg>
        </div>

        <div class="px-4 py-2 -mx-3">
            <div class="mx-3">
                <span class="font-semibold text-emerald-500 dark:text-emerald-400">Success</span>
                <p class="text-sm text-gray-600 dark:text-gray-200">{{ session('success') }}</p>
            </div>
        </div>
    </div>
    @endif



    <!-- List of Products with toggle functionality -->
    <div class="mb-4">

        <ul>
            @foreach($products as $product)
            <!-- Product Item -->
            <li class="bg-white p-4 rounded-lg shadow-md mb-4 cursor-pointer" x-data="{ open: false }">
                <!-- Clickable Header -->
                <div class="flex justify-between items-center" @click="open = !open">
                    <p class="text-lg font-semibold">{{ $product->name }}</p>
                    <div x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center space-x-2">

                            <svg x-show="!open" class="w-7 h-7 text-gray-500" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-width="2" d="M5 8l5 5 5-5"></path>
                            </svg>
                            <svg x-show="open" class="w-7 h-7 text-gray-500" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-width="2" d="M5 12l5-5 5 5"></path>
                            </svg>
                        </button>
                    </div>
                    <!-- Toggle indicator -->
                </div>


                <!-- Edit Form -->
                <div x-show="open" x-transition class="mt-4">
                    <form action="{{ route('product.update', $product->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Product Purchased -->
                        <div class="mb-4">
                            <label for="product_purchased" class="block text-sm font-medium text-gray-700">Product
                                Purchased</label>
                            <input type="number" step="1" id="product_purchased" name="product_purchased"
                                value="{{ old('product_purchased', $product->product_purchased) }}" min="0" required
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg">
                        </div>

                        <div class="mb-4">
                            <label for="category" class="block text-sm font-medium text-gray-700">Category
                                (optional)</label>
                            <input type="text" id="category" name="category"
                                value="{{ old('category', $product->category) }}"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg">
                        </div>

                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">Product Name</label>
                            <input type="text" id="name" name="name" value="{{ old('name', $product->name) }}" required
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg">
                        </div>

                        <div class="mb-4">
                            <label for="description" class="block text-sm font-medium text-gray-700">Product
                                Description</label>
                            <textarea id="description" name="description" rows="4" required
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg">{{ old('description', $product->description) }}</textarea>
                        </div>

                        <div class="mb-4">
                            <label for="original_price" class="block text-sm font-medium text-gray-700">Original
                                Price</label>
                            <input type="number" id="original_price" name="original_price"
                                value="{{ old('original_price', $product->original_price) }}"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg" step="0.01">
                        </div>


                        <div class="mb-4">
                            <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                            <input type="number" id="price" name="price" value="{{ old('price', $product->price) }}"
                                required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg"
                                step="0.01">
                        </div>



                        <div class="mb-4">
                            <label for="weight" class="block text-sm font-medium text-gray-700">Weight
                                (grams)</label>
                            <input type="number" id="weight" name="weight" value="{{ old('weight', $product->weight) }}"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg">
                        </div>

                        <div class="mb-4">
                            <label for="shipping_rules" class="block text-sm font-medium text-gray-700">Shipping
                                Rules (JSON)</label>
                            <textarea id="shipping_rules" name="shipping_rules" rows="8" required
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg">{{ old('shipping_rules', json_encode($product->shipping_rules, JSON_PRETTY_PRINT)) }}</textarea>

                            <p class="text-sm text-gray-500 mt-1">Example:
                                [{"min_weight":0,"max_weight":500,"shipping_fee":120}]</p>
                        </div>

                        <div class="mb-4">
                            <label for="image" class="block text-sm font-medium text-gray-700">Product Image</label>
                            <input type="file" id="image" name="image" accept="image/*"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg">
                            <img src="{{ asset('storage/'.$product->image_path) }}" alt="Product Image"
                                class="mt-2 w-32 h-32 object-cover">
                        </div>

                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update
                            Product</button>

                    </form>
                </div>
            </li>
            @endforeach
        </ul>
    </div>
</div>
@endsection