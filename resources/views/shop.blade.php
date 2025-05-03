<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">


    <title>Shop</title>

    @vite(['resources/css/app.css'])

    <!-- Font Awesome for icons -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>



    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.6.8/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.6.8/dist/sweetalert2.min.js"></script>

</head>

<body class="min-h-screen flex flex-col">
    <!-- Header with Cart Icon and Count -->
    <header
        class="bg-white shadow-[0px_2px_3px_-1px_rgba(0,0,0,0.1),0px_1px_0px_0px_rgba(25,28,33,0.02),0px_0px_0px_1px_rgba(25,28,33,0.08)] py-4 glow-effect sticky top-0 z-50"
        id="header">
        <div class="container mx-auto flex justify-between items-center px-6 md:px-16">
            <!-- Shop Title -->
            <div class="relative">
                <a href="{{ $user->facebook_link }}" target="_blank" id="contact-us-btn" class="inline-block z-50">
                    <button
                        class="flex items-center justify-center bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded-md shadow space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-5 h-5" viewBox="0 0 24 24">
                            <path
                                d="M12 2C6.486 2 2 6.262 2 11.5c0 2.511 1.084 4.789 2.938 6.469V22l2.703-1.484c1.056.29 2.184.449 3.359.449 5.514 0 10-4.262 10-9.5S17.514 2 12 2zm.244 13.469-2.547-2.578-4.422 2.578 5.875-6.047 2.547 2.578 4.422-2.578-5.875 6.047z" />
                        </svg>
                        <span>Reach Out Us Here</span>
                    </button>
                </a>
            </div>

            <!-- Cart Icon Button -->
            <button id="cart-icon"
                class="relative bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded-md shadow flex items-center space-x-2">

                <!-- Text before the icon -->
                <span>Cart</span>

                <!-- Updated SVG Cart Icon with Violet Color and Proper Size -->
                <svg class="h-5 w-5 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                </svg>

                <!-- Cart Count Notification -->
                <span id="cart-count"
                    class="absolute top-[-8px] right-[-8px] bg-red-500 text-white text-xs rounded-full px-2 py-1">0</span>
            </button>
        </div>
    </header>

   

    <!-- Products Section -->
    <div class="container mx-auto p-6 md:px-16 mt-[30px] flex-grow">

        <!-- <h1 class="text-2xl md:text-3xl font-bold text-left">Salveo Barley Grass</h1> -->

         @foreach($brands as $brand)
        <h1 class="text-2xl md:text-3xl font-bold text-left text-blue-400">{{ $brand->brand_name }}</h1>
        @endforeach
        <p class="text-gray-600 text-left mb-4">The ultimate superfood designed to nourish your body and fuel your life.
        </p>

       

        <div class="container mx-auto p-1">
            <div class="flex flex-col gap-[50px]">
                @foreach($products as $product)
                <div
                    class="container flex flex-col md:flex-row items-start md:items-start w-full gap-4 rounded-md border border-gray-200 sm:py-6 px-0 sm:pr-6">

                    <!-- Product Image -->
                    <div
                        class="w-full md:w-1/3 flex justify-center items-center border-b border-gray-200 md:border-b-0 md:border-r ">


                        <img src="{{ asset('storage/' . $product->image_path) }}"
                            class=" w-full h-auto md:h-auto md:w-[350px] object-contain " alt="{{ $product->name }}">
                    </div>

                    <!-- Product Details -->


                    <div class="p-4 md:w-2/3">



                        <h2 class="text-xl font-semibold">{{ $product->name }}</h2>
                        <p class="text-gray-700 mt-2">
                            {{ substr($product->description, 0, 70) }}{{ strlen($product->description) > 200 ? '...' : '' }}
                        </p>

                         @if ($product->original_price && $product->original_price > 0)
                        <div class="mt-6 text-sm text-gray-600 flex items-center justify-start">
                            <svg class="h-5 w-5 text-green-600 mr-2" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
                                <polyline points="22 4 12 14.01 9 11.01" />
                            </svg>
                            Claim Big Discount Today
                        </div>

                        <p class="text-lg font-bold">
                            Product Price:
                            <span class="text-red-600 line-through">
                                &#8369;{{ number_format($product->original_price) }}
                            </span>
                            &#8369;{{ number_format($product->price) }}
                        </p>
                    @else
                        <p class="text-lg font-bold mt-6 md:mt-10">
                            Product Price:
                            &#8369;{{ number_format($product->price) }}
                        </p>
                    @endif





                        <!-- Quantity Controls and Add to Cart Button -->
                        <div class="flex items-center gap-2 mt-2">
                            <!-- Inline controls group (Quantity + Add to Cart) -->
                            <div class="flex items-center ">
                                <!-- Quantity Buttons -->
                                <button
                                    class="quantity-btn decrease bg-white text-black p-2 rounded-l-lg border border-gray-300 hover:bg-gray-100 transition-colors"
                                    data-product-id="{{ $product->id }}">&minus;</button>

                                <input type="number" min="1" value="1" class="quantity-input p-2 border-t border-b border-gray-300 w-16 text-center 
                            focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
                                    data-product-id="{{ $product->id }}"
                                    data-shipping-rules='{{ json_encode($product->shipping_rules) }}'>


                                <button
                                    class="quantity-btn increase bg-white text-black p-2 rounded-r-lg border border-gray-300 hover:bg-gray-100 transition-colors"
                                    data-product-id="{{ $product->id }}">+</button>
                            </div>

                            <!-- Add to Cart Button -->
                            <button class="add-to-cart w-full max-w-[200px] bg-green-700 hover:bg-green-800
                            text-white px-4 py-2 rounded-lg flex items-center justify-center space-x-2" data-product-id="{{ $product->id }}"
                                data-name="{{ $product->name }}" data-price="{{ $product->price }}"
                                data-weight="{{ $product->weight }}">
                                <!-- Add data-weight attribute here -->
                                <svg class="h-5 w-5 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="9" cy="21" r="1" />
                                    <circle cx="20" cy="21" r="1" />
                                    <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6" />
                                </svg>
                                <span>Add to Cart</span>
                            </button>


                        </div>

                        <div class="flex items-center pl-0 mt-6 border-t border-gray-100 w-full md:max-w-[36%] pt-4  ">
                            <span class="text-left text-gray-600 mr-0">Rating:</span>
                            <div class="flex items-center ml-0">
                                <!-- Replace this with your rating component -->
                                <span class="text-yellow-400">&#9733;</span>
                                <span class="text-yellow-400">&#9733;</span>
                                <span class="text-yellow-400">&#9733;</span>
                                <span class="text-yellow-400">&#9733;</span>
                                <span class="text-gray-300">&#9733;</span>
                            </div>
                        </div>
                        <h3 class="text-lg font-medium ">
                            <i class="fas fa-shopping-cart mr-2"></i> Product Purchased:
                            {{ number_format($product->product_purchased) }}
                        </h3>



                    </div>

                </div>
                @endforeach
            </div>
        </div>



        <!-- Success Alert -->
        <div id="success-message"
            class="hidden fixed top-[9%] right-[10%] sm:top-[8%] sm:right-[12%] w-[80%] sm:max-w-[400px] shadow-lg rounded-lg flex">
            <!-- Left Colored Icon Box -->
            <div class="bg-green-500 py-3 px-4 sm:py-4 sm:px-6 rounded-l-lg flex items-center">
                <svg class="h-6 w-6 sm:h-8 sm:w-8 text-slate-100" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
                    <polyline points="22 4 12 14.01 9 11.01" />
                </svg>
            </div>

            <!-- Alert Message -->
            <div
                class="px-3 py-2 sm:px-4 sm:py-3 bg-white rounded-r-lg flex justify-between items-center w-full border border-l-transparent border-gray-200">
                <span id="success-text"></span>
            </div>
        </div>



        <!-- Cart Sidebar -->
        <div id="cart-overlay" class="fixed top-0 left-0 w-full h-full bg-black bg-opacity-50 hidden"
            style="z-index: 999;"></div>

        <div id="cart-sidebar"
            class="fixed right-0 top-0 w-full h-full sm:w-[500px] bg-white shadow-lg transform translate-x-full transition-transform"
            style="z-index: 999;">
            <div class="p-4 relative">
                <h2 class="text-2xl font-bold text-gray-700">Shopping Cart</h2>
                <!-- Cart Sidebar Close Button with Custom SVG Icon -->

               <p id="congratulations-message" class="hidden text-[14px] bg-yellow-200 text-black border-l-4 border-gray-500 p-4 rounded-lg text-left mt-4">
    <strong>Congratulations!</strong> Your items are ready. <span class="font-semibold">Please check out now to proceed with the payment.</span>
</p>



                <button id="close-cart"
                    class="rounded-[2px] absolute top-4 right-7 text-red-500 text-xl shadow-[0px_2px_3px_-1px_rgba(0,0,0,0.1),0px_1px_0px_0px_rgba(25,28,33,0.02),0px_0px_0px_1px_rgba(25,28,33,0.08)]">
                    <svg class="h-6 w-6 text-red-500" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="3" width="18" height="18" rx="2" ry="2" />
                        <line x1="9" y1="9" x2="15" y2="15" />
                        <line x1="15" y1="9" x2="9" y2="15" />
                    </svg>
                </button>

                <ul id="cart-items" class="mt-4"></ul>
                <p class="mt-6 font-bold text-lg text-gray-500 text-center">Grand Total: <span id="cart-total"
                        class="text-red-500">&#8369;0</span></p>

                <!-- HTML Changes -->

                <div id="empty-cart-message" class="mt-6 hidden text-center text-lg text-gray-500"
                    style="border: 2px dashed #ccc; padding: 20px;">
                    Your cart is empty, please add items to the cart!
                </div>


                <!-- Checkout Button -->
                <button id="checkout-button"
                    class="w-full bg-green-700 hover:bg-green-800 text-white py-2 rounded-lg mt-4 flex items-center justify-center space-x-2"
                    onclick="fetchCartAndRedirect()" disabled>
                    <!-- Icon -->
                    <svg class="h-5 w-5 text-slate-50" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                    <!-- Text -->
                    <span>Checkout Now</span>
                </button>

                <!-- Note Below the Button -->
                <p class="text-sm text-gray-500 mt-2 text-center">
                    After clicking, you'll be redirected to the Order Summary.
                </p>

            </div>


            <script>
            const subdomain = "{{ $subdomain }}"; // passed from the controller
            </script>


            <script>
            // Load cart from sessionStorage if available
            let cart = JSON.parse(sessionStorage.getItem('cart')) || [];

            document.addEventListener("DOMContentLoaded", function() {
                updateCart(); // Update cart UI on page load
            });

            document.querySelectorAll('.add-to-cart').forEach(button => {
                button.addEventListener('click', function() {
                    let productId = this.dataset.productId;
                    let name = this.dataset.name;
                    let price = parseFloat(this.dataset.price);
                    let quantityInput = document.querySelector(
                        `.quantity-input[data-product-id='${productId}']`);
                    let quantity = parseInt(quantityInput.value);
                    let shippingRules = JSON.parse(quantityInput.dataset.shippingRules);
                    let image = this.closest('.container').querySelector('img').src;
                    let weight = parseFloat(this.dataset
                        .weight); // Get product weight dynamically from data attribute

                    let shippingFee = calculateShipping(quantity, weight,
                        shippingRules); // Use dynamic weight here
                    let totalPrice = price * quantity;

                    let existingProduct = cart.find(item => item.id === productId);
                    if (existingProduct) {
                        existingProduct.quantity += quantity;
                        existingProduct.shippingFee = calculateShipping(existingProduct.quantity,
                            weight, shippingRules);
                        existingProduct.totalPrice = existingProduct.price * existingProduct.quantity;
                    } else {
                        cart.push({
                            id: productId,
                            name,
                            price,
                            quantity,
                            shippingFee,
                            totalPrice,
                            image,
                            weight
                        });
                    }

                    updateCart();
                    showSuccessAlert(name); // Show alert after adding to cart
                });
            });

            function calculateShipping(quantity, weight, rules) {
                let totalWeight = quantity * weight; // Use the product's weight here
                for (let rule of rules) {
                    if (totalWeight >= rule.min_weight && totalWeight <= rule.max_weight) {
                        return rule.shipping_fee;
                    }
                }
                return rules.length > 0 ? rules[rules.length - 1].shipping_fee :
                    0; // Default to highest rule if none match
            }

    function updateCart() {
    let cartItems = document.getElementById('cart-items');
    let cartTotal = document.getElementById('cart-total');
    let cartCount = document.getElementById('cart-count');
    let checkoutButton = document.getElementById('checkout-button');
    let emptyCartMessage = document.getElementById('empty-cart-message');
    let congratulationsMessage = document.getElementById('congratulations-message'); // New message element

    cartItems.innerHTML = '';
    let total = 0;
    let count = 0;

    if (cart.length === 0) {
        // If the cart is empty, display message and disable checkout button
        emptyCartMessage.classList.remove('hidden');
        checkoutButton.disabled = true;
        congratulationsMessage.classList.add('hidden'); // Hide congratulations message if cart is empty
    } else {
        // If there are items in the cart, hide the empty message and enable the checkout button
        emptyCartMessage.classList.add('hidden');
        checkoutButton.disabled = false;

        // Display congratulations message
        congratulationsMessage.classList.remove('hidden'); // Show the message when the cart is not empty

        cart.forEach((item, index) => {
            total += item.totalPrice + item.shippingFee;
            count += item.quantity;
            cartItems.innerHTML += `
                <li class='border-b p-4 flex'>
                    <img src="${item.image}" class="border border-gray-300 w-[80px] h-[auto] sm:w-[20%] sm:h-[20%] object-fill aspect-[1/1] rounded mr-4" alt="${item.name}">
                    <div class="flex-grow">
                        <p class="font-semibold mb-2">${item.name}</p>
                        <p class="text-sm text-gray-700">Total Price: <span class="font-bold">&#8369;${item.totalPrice.toLocaleString('en-US', { maximumFractionDigits: 2 })}</span></p>
                        <p class="text-sm text-gray-700">Shipping Fee: <span class="font-bold">&#8369;${item.shippingFee.toLocaleString('en-US', { maximumFractionDigits: 2 })}</span></p>
                        <p class="text-sm text-gray-700">Quantity: 
                            <button class="quantity-btn decrease px-2 py-1 rounded" data-product-id="${item.id}">&minus;</button>
                            <span class="font-bold">${item.quantity}</span>
                            <button class="quantity-btn increase px-2 py-1 rounded" data-product-id="${item.id}">+</button>
                        </p>
                    </div>
                    <button class="delete-item text-red-500 text-lg ml-2" data-index="${index}">
                        <i class="fas fa-trash"></i>
                    </button>
                </li>`;
        });
    }

    // Display only the symbol if the cart is empty
    if (total === 0) {
        cartTotal.textContent = `₱0.00`; // Ensure 0 is formatted as ₱0.00
    } else {
        cartTotal.textContent = `₱${total.toLocaleString('en-US', { maximumFractionDigits: 2 })}`;
    }
    cartCount.textContent = count; // Display the cart item count

    // Save cart to sessionStorage
    sessionStorage.setItem('cart', JSON.stringify(cart));

    // Add event listeners to delete buttons
    document.querySelectorAll('.delete-item').forEach(button => {
        button.addEventListener('click', function() {
            let index = this.dataset.index;
            cart.splice(index, 1); // Remove the item from the cart
            updateCart(); // Re-render the cart after deletion
        });
    });

    // Add event listeners to quantity buttons
    document.querySelectorAll('.quantity-btn').forEach(button => {
        button.addEventListener('click', function() {
            let productId = this.dataset.productId;
            let product = cart.find(item => item.id === productId);
            let currentQuantity = product ? product.quantity : 0;

            if (this.classList.contains('decrease') && currentQuantity > 1) {
                updateCartQuantity(productId, currentQuantity - 1);
            } else if (this.classList.contains('increase')) {
                updateCartQuantity(productId, currentQuantity + 1);
            }
        });
    });
}



            function fetchCartAndRedirect() {
                // Get cart data from sessionStorage before redirecting
                const cartData = JSON.parse(sessionStorage.getItem('cart')) || [];

                // Optionally, log the cart data for debugging
                console.log(cartData);

                // Now, redirect to the checkout page
                window.location.href = `/${subdomain}/checkout`;
            }

            document.getElementById('cart-icon').addEventListener('click', function() {
                document.getElementById('cart-sidebar').classList.remove('translate-x-full');
                document.getElementById('cart-overlay').classList.remove('hidden');
            });

            document.getElementById('close-cart').addEventListener('click', function() {
                document.getElementById('cart-sidebar').classList.add('translate-x-full');
                document.getElementById('cart-overlay').classList.add('hidden');
            });

            document.getElementById('cart-overlay').addEventListener('click', function() {
                document.getElementById('cart-sidebar').classList.add('translate-x-full');
                document.getElementById('cart-overlay').classList.add('hidden');
            });

            // Handling quantity change (increase and decrease buttons)
            document.querySelectorAll('.quantity-btn').forEach(button => {
                button.addEventListener('click', function() {
                    let productId = this.dataset.productId;
                    let quantityInput = document.querySelector(
                        `.quantity-input[data-product-id='${productId}']`);
                    let currentQuantity = parseInt(quantityInput.value);

                    if (this.classList.contains('decrease')) {
                        if (currentQuantity > 1) {
                            quantityInput.value = currentQuantity - 1;
                            updateCartQuantity(productId, currentQuantity - 1);
                        }
                    } else if (this.classList.contains('increase')) {
                        quantityInput.value = currentQuantity + 1;
                        updateCartQuantity(productId, currentQuantity + 1);
                    }
                });
            });

           // Function to update the cart quantity
function updateCartQuantity(productId, newQuantity) {
    let product = cart.find(item => item.id === productId);
    if (product) {
        product.quantity = newQuantity;
        let shippingRules = JSON.parse(document.querySelector(
                `.quantity-input[data-product-id='${productId}']`)
            .dataset.shippingRules);
        product.shippingFee = calculateShipping(newQuantity, product.weight, shippingRules);  // Update shipping fee
        product.totalPrice = product.price * newQuantity;  // Recalculate total price
        updateCart();
    }
}

            function showSuccessAlert(itemName) {
                // SweetAlert message
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    html: `${itemName} added to cart! <br><span id="instructions" style="color: red; margin-top: 20px;">Click the buttons below</span>`,
                    showConfirmButton: true,
                    confirmButtonText: 'Go to Cart',
                    showCancelButton: true,
                    cancelButtonText: 'Continue shopping',
                    confirmButtonColor: '#3085d6', // Customize Go to Cart button color
                    cancelButtonColor: '#d33', // Customize Close button color
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Trigger the cart icon click to open the sidebar
                        document.getElementById('cart-icon').click();
                    } else if (result.dismiss === Swal.DismissReason.cancel) {
                        // Close the alert
                        Swal.close();
                    }
                });
            }
            </script>
        </div>
    </div> <!-- End of main content container -->



    <footer class=" text-gray-800 py-2 border border-gray-100 mt-16">
        <div class="w-full py-2">
            <div class="container mx-auto flex flex-col md:flex-row justify-between items-center px-4">
                <!-- Copyright -->
                <p class="text-sm">© 2025 Salveo Barley Grass. All Rights Reserved.</p>

                <!-- Social Media Icons -->
                <div class="flex space-x-4">
                    <a href="#" class="text-gray-800 hover:text-gray-600"><i class="fab fa-facebook"></i></a>
                    <a href="#" class="text-gray-800 hover:text-gray-600"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="text-gray-800 hover:text-gray-600"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="text-gray-800 hover:text-gray-600"><i class="fab fa-linkedin"></i></a>
                </div>
            </div>
        </div>
    </footer>



</body>

</html>