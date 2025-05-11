<?php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marhaban Parfume - Checkout</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        }
        .parfume-card {
            transition: all 0.3s ease;
        }
        .parfume-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        .checkout-btn {
            background: linear-gradient(to right, #667eea, #764ba2);
        }
        .checkout-btn:hover {
            background: linear-gradient(to right, #764ba2, #667eea);
        }
        .shipping-option {
            border-left: 4px solid #667eea;
        }
        .payment-method {
            transition: all 0.2s ease;
        }
        .payment-method:hover {
            transform: scale(1.02);
        }
        .payment-method.selected {
            border: 2px solid #667eea;
            background-color: #f0f4ff;
        }
        .loading-spinner {
            border-top-color: #667eea;
            animation: spin 1s linear infinite;
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body class="gradient-bg min-h-screen">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0 flex items-center">
                        <i class="fas fa-spray-can text-purple-600 text-2xl mr-2"></i>
                        <span class="text-xl font-bold text-gray-800">Marhaban Parfume</span>
                    </div>
                </div>
                <div class="flex items-center">
                    <a href="#" class="px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:text-purple-600">Home</a>
                    <a href="#" class="px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:text-purple-600">Products</a>
                    <a href="#" class="px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:text-purple-600">About</a>
                    <div class="ml-4 relative">
                        <button class="text-gray-700 hover:text-purple-600">
                            <i class="fas fa-shopping-cart text-xl"></i>
                            <span id="cart-count" class="absolute -top-2 -right-2 bg-purple-600 text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center">3</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Progress Steps -->
        <div class="mb-8">
            <div class="flex justify-between items-center">
                <div class="flex flex-col items-center">
                    <div class="w-10 h-10 rounded-full bg-purple-600 text-white flex items-center justify-center">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <span class="mt-2 text-sm font-medium text-purple-600">Cart</span>
                </div>
                <div class="flex-1 h-1 mx-2 bg-purple-600"></div>
                <div class="flex flex-col items-center">
                    <div class="w-10 h-10 rounded-full bg-purple-600 text-white flex items-center justify-center">
                        <i class="fas fa-truck"></i>
                    </div>
                    <span class="mt-2 text-sm font-medium text-purple-600">Shipping</span>
                </div>
                <div class="flex-1 h-1 mx-2 bg-purple-600"></div>
                <div class="flex flex-col items-center">
                    <div class="w-10 h-10 rounded-full bg-gray-300 text-gray-600 flex items-center justify-center">
                        <i class="fas fa-credit-card"></i>
                    </div>
                    <span class="mt-2 text-sm font-medium text-gray-500">Payment</span>
                </div>
            </div>
        </div>

        <!-- Cart and Checkout Container -->
        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Cart Items -->
            <div class="lg:w-2/3">
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-xl font-semibold text-gray-800 mb-6">Your Cart (3 items)</h2>
                    
                    <!-- Cart Items List -->
                    <div class="space-y-4">
                        <!-- Item 1 -->
                        <div class="flex items-center justify-between border-b pb-4">
                            <div class="flex items-center">
                                <img src="https://via.placeholder.com/80" alt="Parfume" class="w-16 h-16 rounded-md object-cover">
                                <div class="ml-4">
                                    <h3 class="text-sm font-medium text-gray-800">Marhaban Musk Gold</h3>
                                    <p class="text-xs text-gray-500">50ml Eau de Parfum</p>
                                </div>
                            </div>
                            <div class="flex items-center">
                                <button class="text-gray-500 hover:text-purple-600 px-2" onclick="updateQuantity('musk-gold', -1)">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <span id="musk-gold-qty" class="mx-2 text-gray-700">1</span>
                                <button class="text-gray-500 hover:text-purple-600 px-2" onclick="updateQuantity('musk-gold', 1)">
                                    <i class="fas fa-plus"></i>
                                </button>
                                <span id="musk-gold-price" class="ml-6 font-medium text-gray-800">Rp 250.000</span>
                                <button class="ml-4 text-red-500 hover:text-red-700" onclick="removeItem('musk-gold')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                        
                        <!-- Item 2 -->
                        <div class="flex items-center justify-between border-b pb-4">
                            <div class="flex items-center">
                                <img src="https://via.placeholder.com/80" alt="Parfume" class="w-16 h-16 rounded-md object-cover">
                                <div class="ml-4">
                                    <h3 class="text-sm font-medium text-gray-800">Marhaban Oud Royal</h3>
                                    <p class="text-xs text-gray-500">100ml Eau de Parfum</p>
                                </div>
                            </div>
                            <div class="flex items-center">
                                <button class="text-gray-500 hover:text-purple-600 px-2" onclick="updateQuantity('oud-royal', -1)">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <span id="oud-royal-qty" class="mx-2 text-gray-700">2</span>
                                <button class="text-gray-500 hover:text-purple-600 px-2" onclick="updateQuantity('oud-royal', 1)">
                                    <i class="fas fa-plus"></i>
                                </button>
                                <span id="oud-royal-price" class="ml-6 font-medium text-gray-800">Rp 550.000</span>
                                <button class="ml-4 text-red-500 hover:text-red-700" onclick="removeItem('oud-royal')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Coupon Code -->
                    <div class="mt-6">
                        <label for="coupon" class="block text-sm font-medium text-gray-700 mb-1">Coupon Code</label>
                        <div class="flex">
                            <input type="text" id="coupon" class="flex-1 border border-gray-300 rounded-l-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" placeholder="Enter coupon code">
                            <button class="bg-purple-600 text-white px-4 py-2 rounded-r-md hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:ring-offset-2" onclick="applyCoupon()">Apply</button>
                        </div>
                        <p id="coupon-message" class="mt-1 text-xs"></p>
                    </div>
                    
                    <!-- Order Summary -->
                    <div class="mt-6 border-t pt-4">
                        <h3 class="text-lg font-medium text-gray-800 mb-2">Order Summary</h3>
                        <div class="flex justify-between py-1">
                            <span class="text-gray-600">Subtotal</span>
                            <span id="subtotal" class="font-medium">Rp 800.000</span>
                        </div>
                        <div class="flex justify-between py-1">
                            <span class="text-gray-600">Discount</span>
                            <span id="discount" class="font-medium text-green-600">- Rp 0</span>
                        </div>
                        <div class="flex justify-between py-1">
                            <span class="text-gray-600">Shipping</span>
                            <span id="shipping-cost" class="font-medium">Rp 0</span>
                        </div>
                        <div class="flex justify-between py-1 border-t mt-2 pt-2">
                            <span class="text-lg font-bold text-gray-800">Total</span>
                            <span id="total" class="text-lg font-bold text-purple-600">Rp 800.000</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Shipping and Payment -->
            <div class="lg:w-1/3">
                <!-- Shipping Address -->
                <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Shipping Address</h2>
                    
                    <div class="space-y-4">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                            <input type="text" id="name" class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" value="Ahmad Fauzi">
                        </div>
                        
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                            <input type="tel" id="phone" class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" value="081234567890">
                        </div>
                        
                        <div>
                            <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Address</label>
                            <textarea id="address" rows="3" class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent">Jl. Merdeka No. 123, Jakarta Pusat</textarea>
                        </div>
                        
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="province" class="block text-sm font-medium text-gray-700 mb-1">Province</label>
                                <select id="province" class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" onchange="getCities()">
                                    <option value="DKI Jakarta">DKI Jakarta</option>
                                    <option value="Jawa Barat">Jawa Barat</option>
                                    <option value="Jawa Tengah">Jawa Tengah</option>
                                    <option value="Jawa Timur">Jawa Timur</option>
                                </select>
                            </div>
                            <div>
                                <label for="city" class="block text-sm font-medium text-gray-700 mb-1">City</label>
                                <select id="city" class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" onchange="getDistricts()">
                                    <option value="Jakarta Pusat">Jakarta Pusat</option>
                                    <option value="Jakarta Selatan">Jakarta Selatan</option>
                                    <option value="Jakarta Barat">Jakarta Barat</option>
                                    <option value="Jakarta Utara">Jakarta Utara</option>
                                    <option value="Jakarta Timur">Jakarta Timur</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="district" class="block text-sm font-medium text-gray-700 mb-1">District</label>
                                <select id="district" class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" onchange="calculateShipping()">
                                    <option value="Gambir">Gambir</option>
                                    <option value="Sawah Besar">Sawah Besar</option>
                                    <option value="Kemayoran">Kemayoran</option>
                                    <option value="Senen">Senen</option>
                                </select>
                            </div>
                            <div>
                                <label for="postal" class="block text-sm font-medium text-gray-700 mb-1">Postal Code</label>
                                <input type="text" id="postal" class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" value="10110">
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Shipping Method -->
                <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Shipping Method</h2>
                    
                    <div class="space-y-3">
                        <!-- Lion Parcel Options -->
                        <div class="p-3 bg-gray-50 rounded-md shipping-option">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <input type="radio" name="shipping" id="lion-regular" checked class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300" onchange="updateShippingCost('lion-regular', 15000)">
                                    <label for="lion-regular" class="ml-3 block text-sm font-medium text-gray-700">
                                        Lion Parcel - Regular
                                    </label>
                                </div>
                                <span id="lion-regular-price" class="text-sm font-medium">Rp 15.000</span>
                            </div>
                            <div class="ml-7 mt-1 text-xs text-gray-500">Estimated delivery: 2-3 days</div>
                        </div>
                        
                        <div class="p-3 bg-gray-50 rounded-md shipping-option">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <input type="radio" name="shipping" id="lion-express" class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300" onchange="updateShippingCost('lion-express', 25000)">
                                    <label for="lion-express" class="ml-3 block text-sm font-medium text-gray-700">
                                        Lion Parcel - Express
                                    </label>
                                </div>
                                <span id="lion-express-price" class="text-sm font-medium">Rp 25.000</span>
                            </div>
                            <div class="ml-7 mt-1 text-xs text-gray-500">Estimated delivery: 1-2 days</div>
                        </div>
                        
                        <!-- J&T Cargo Options -->
                        <div class="p-3 bg-gray-50 rounded-md shipping-option">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <input type="radio" name="shipping" id="jnt-regular" class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300" onchange="updateShippingCost('jnt-regular', 18000)">
                                    <label for="jnt-regular" class="ml-3 block text-sm font-medium text-gray-700">
                                        J&T Cargo - Regular
                                    </label>
                                </div>
                                <span id="jnt-regular-price" class="text-sm font-medium">Rp 18.000</span>
                            </div>
                            <div class="ml-7 mt-1 text-xs text-gray-500">Estimated delivery: 3-4 days</div>
                        </div>
                        
                        <div class="p-3 bg-gray-50 rounded-md shipping-option">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <input type="radio" name="shipping" id="jnt-express" class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300" onchange="updateShippingCost('jnt-express', 30000)">
                                    <label for="jnt-express" class="ml-3 block text-sm font-medium text-gray-700">
                                        J&T Cargo - Express
                                    </label>
                                </div>
                                <span id="jnt-express-price" class="text-sm font-medium">Rp 30.000</span>
                            </div>
                            <div class="ml-7 mt-1 text-xs text-gray-500">Estimated delivery: 1-2 days</div>
                        </div>
                    </div>
                </div>
                
                <!-- Payment Method -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Payment Method</h2>
                    
                    <div class="space-y-3">
                        <div class="p-3 border rounded-md payment-method selected" onclick="selectPayment('bank')">
                            <div class="flex items-center">
                                <input type="radio" name="payment" id="bank" checked class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300">
                                <label for="bank" class="ml-3 block text-sm font-medium text-gray-700">
                                    Bank Transfer
                                </label>
                            </div>
                            <div class="ml-7 mt-2 grid grid-cols-3 gap-2">
                                <img src="https://via.placeholder.com/60x30?text=BCA" alt="BCA" class="h-8 object-contain">
                                <img src="https://via.placeholder.com/60x30?text=Mandiri" alt="Mandiri" class="h-8 object-contain">
                                <img src="https://via.placeholder.com/60x30?text=BNI" alt="BNI" class="h-8 object-contain">
                            </div>
                        </div>
                        
                        <div class="p-3 border rounded-md payment-method" onclick="selectPayment('ewallet')">
                            <div class="flex items-center">
                                <input type="radio" name="payment" id="ewallet" class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300">
                                <label for="ewallet" class="ml-3 block text-sm font-medium text-gray-700">
                                    E-Wallet
                                </label>
                            </div>
                            <div class="ml-7 mt-2 grid grid-cols-3 gap-2">
                                <img src="https://via.placeholder.com/60x30?text=OVO" alt="OVO" class="h-8 object-contain">
                                <img src="https://via.placeholder.com/60x30?text=DANA" alt="DANA" class="h-8 object-contain">
                                <img src="https://via.placeholder.com/60x30?text=LinkAja" alt="LinkAja" class="h-8 object-contain">
                            </div>
                        </div>
                        
                        <div class="p-3 border rounded-md payment-method" onclick="selectPayment('cod')">
                            <div class="flex items-center">
                                <input type="radio" name="payment" id="cod" class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300">
                                <label for="cod" class="ml-3 block text-sm font-medium text-gray-700">
                                    Cash on Delivery (COD)
                                </label>
                            </div>
                            <div class="ml-7 mt-1 text-xs text-gray-500">Pay when your order arrives</div>
                        </div>
                    </div>
                    
                    <!-- Checkout Button -->
                    <button id="checkout-btn" class="w-full mt-6 bg-purple-600 text-white py-3 px-4 rounded-md font-medium hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:ring-offset-2 checkout-btn flex items-center justify-center" onclick="processCheckout()">
                        <span id="checkout-text">Complete Order (Rp 815.000)</span>
                        <span id="checkout-loading" class="hidden ml-2">
                            <svg class="animate-spin -ml-1 mr-1 h-5 w-5 text-white loading-spinner" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                        </span>
                    </button>
                    
                    <div class="mt-4 text-xs text-gray-500 flex items-center">
                        <i class="fas fa-lock mr-2"></i>
                        <span>Your payment is secure and encrypted</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-8 mt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-lg font-semibold mb-4">Marhaban Parfume</h3>
                    <p class="text-sm text-gray-400">Premium fragrance for the discerning individual. Experience luxury in every drop.</p>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Quick Links</h3>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li><a href="#" class="hover:text-white">Home</a></li>
                        <li><a href="#" class="hover:text-white">Shop</a></li>
                        <li><a href="#" class="hover:text-white">About Us</a></li>
                        <li><a href="#" class="hover:text-white">Contact</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Customer Service</h3>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li><a href="#" class="hover:text-white">FAQs</a></li>
                        <li><a href="#" class="hover:text-white">Shipping Policy</a></li>
                        <li><a href="#" class="hover:text-white">Returns & Refunds</a></li>
                        <li><a href="#" class="hover:text-white">Privacy Policy</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Contact Us</h3>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li class="flex items-center"><i class="fas fa-map-marker-alt mr-2"></i> Jakarta, Indonesia</li>
                        <li class="flex items-center"><i class="fas fa-phone-alt mr-2"></i> +62 812 3456 7890</li>
                        <li class="flex items-center"><i class="fas fa-envelope mr-2"></i> info@marhabanparfume.com</li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-8 pt-8 text-sm text-gray-400 text-center">
                <p>&copy; 2023 Marhaban Parfume. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        // Cart data
        const cartItems = {
            'musk-gold': { price: 250000, quantity: 1 },
            'oud-royal': { price: 550000, quantity: 2 }
        };
        
        const coupons = {
            'WELCOME10': 0.1,
            'MARHABAN20': 0.2,
            'FREESHIP': 'freeship'
        };
        
        let appliedCoupon = null;
        let shippingCost = 15000; // Default to Lion Parcel Regular
        
        // Initialize the page
        document.addEventListener('DOMContentLoaded', function() {
            updateCartSummary();
            updateCheckoutButton();
        });
        
        // Update item quantity
        function updateQuantity(itemId, change) {
            const newQuantity = cartItems[itemId].quantity + change;
            if (newQuantity > 0) {
                cartItems[itemId].quantity = newQuantity;
                document.getElementById(`${itemId}-qty`).textContent = newQuantity;
                document.getElementById(`${itemId}-price`).textContent = formatPrice(cartItems[itemId].price * newQuantity);
                updateCartSummary();
            }
        }
        
        // Remove item from cart
        function removeItem(itemId) {
            delete cartItems[itemId];
            document.querySelector(`#${itemId}-qty`).parentElement.parentElement.remove();
            updateCartCount();
            updateCartSummary();
        }
        
        // Apply coupon code
        function applyCoupon() {
            const couponCode = document.getElementById('coupon').value.trim();
            const couponMessage = document.getElementById('coupon-message');
            
            if (coupons[couponCode]) {
                appliedCoupon = couponCode;
                couponMessage.textContent = `Coupon "${couponCode}" applied successfully!`;
                couponMessage.className = 'mt-1 text-xs text-green-600';
            } else {
                appliedCoupon = null;
                couponMessage.textContent = 'Invalid coupon code';
                couponMessage.className = 'mt-1 text-xs text-red-600';
            }
            
            updateCartSummary();
        }
        
        // Update cart summary
        function updateCartSummary() {
            let subtotal = 0;
            let discount = 0;
            
            // Calculate subtotal
            for (const item in cartItems) {
                subtotal += cartItems[item].price * cartItems[item].quantity;
            }
            
            // Calculate discount
            if (appliedCoupon) {
                const couponValue = coupons[appliedCoupon];
                if (couponValue === 'freeship') {
                    // Free shipping handled in shipping cost calculation
                } else {
                    discount = subtotal * couponValue;
                }
            }
            
            // Calculate total
            const total = subtotal - discount + (appliedCoupon === 'FREESHIP' ? 0 : shippingCost);
            
            // Update UI
            document.getElementById('subtotal').textContent = formatPrice(subtotal);
            document.getElementById('discount').textContent = `- ${formatPrice(discount)}`;
            document.getElementById('shipping-cost').textContent = formatPrice(appliedCoupon === 'FREESHIP' ? 0 : shippingCost);
            document.getElementById('total').textContent = formatPrice(total);
            
            updateCheckoutButton();
            updateCartCount();
        }
        
        // Update cart count in navbar
        function updateCartCount() {
            let count = 0;
            for (const item in cartItems) {
                count += cartItems[item].quantity;
            }
            document.getElementById('cart-count').textContent = count;
        }
        
        // Update checkout button with current total
        function updateCheckoutButton() {
            const total = document.getElementById('total').textContent;
            document.getElementById('checkout-text').textContent = `Complete Order (${total})`;
        }
        
        // Format price as Indonesian Rupiah
        function formatPrice(amount) {
            return 'Rp ' + amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }
        
        // Payment method selection
        function selectPayment(method) {
            document.querySelectorAll('.payment-method').forEach(el => {
                el.classList.remove('selected');
            });
            document.querySelector(`input#${method}`).checked = true;
            document.querySelector(`input#${method}`).parentElement.parentElement.classList.add('selected');
        }
        
        // Update shipping cost when option changes
        function updateShippingCost(methodId, cost) {
            shippingCost = cost;
            updateCartSummary();
        }
        
        // Simulate getting cities based on province (would call API in real implementation)
        function getCities() {
            const province = document.getElementById('province').value;
            console.log(`Fetching cities for ${province}...`);
            // In a real implementation, this would call Lion Parcel/J&T API to get available cities
        }
        
        // Simulate getting districts based on city (would call API in real implementation)
        function getDistricts() {
            const city = document.getElementById('city').value;
            console.log(`Fetching districts for ${city}...`);
            // In a real implementation, this would call Lion Parcel/J&T API to get available districts
        }
        
        // Calculate shipping costs based on address (would call API in real implementation)
        function calculateShipping() {
            const province = document.getElementById('province').value;
            const city = document.getElementById('city').value;
            const district = document.getElementById('district').value;
            
            console.log(`Calculating shipping to ${district}, ${city}, ${province}...`);
            
            // Show loading state
            const btn = document.getElementById('checkout-btn');
            const btnText = document.getElementById('checkout-text');
            const loading = document.getElementById('checkout-loading');
            
            btn.disabled = true;
            btnText.textContent = "Calculating shipping...";
            loading.classList.remove('hidden');
            
            // Simulate API call to Lion Parcel and J&T Cargo
            setTimeout(() => {
                // In a real implementation, these prices would come from the API response
                const lionRegularPrice = 15000 + (province === 'DKI Jakarta' ? 0 : 5000);
                const lionExpressPrice = 25000 + (province === 'DKI Jakarta' ? 0 : 8000);
                const jntRegularPrice = 18000 + (province === 'DKI Jakarta' ? 0 : 6000);
                const jntExpressPrice = 30000 + (province === 'DKI Jakarta' ? 0 : 10000);
                
                // Update UI with new prices
                document.getElementById('lion-regular-price').textContent = formatPrice(lionRegularPrice);
                document.getElementById('lion-express-price').textContent = formatPrice(lionExpressPrice);
                document.getElementById('jnt-regular-price').textContent = formatPrice(jntRegularPrice);
                document.getElementById('jnt-express-price').textContent = formatPrice(jntExpressPrice);
                
                // Update shipping cost if the current option is selected
                const selectedShipping = document.querySelector('input[name="shipping"]:checked');
                if (selectedShipping) {
                    switch(selectedShipping.id) {
                        case 'lion-regular':
                            shippingCost = lionRegularPrice;
                            break;
                        case 'lion-express':
                            shippingCost = lionExpressPrice;
                            break;
                        case 'jnt-regular':
                            shippingCost = jntRegularPrice;
                            break;
                        case 'jnt-express':
                            shippingCost = jntExpressPrice;
                            break;
                    }
                    updateCartSummary();
                }
                
                // Restore button state
                btnText.textContent = `Complete Order (${document.getElementById('total').textContent})`;
                loading.classList.add('hidden');
                btn.disabled = false;
            }, 1500);
        }
        
        // Process checkout
        function processCheckout() {
            // Show loading state
            const btn = document.getElementById('checkout-btn');
            const btnText = document.getElementById('checkout-text');
            const loading = document.getElementById('checkout-loading');
            
            btn.disabled = true;
            btnText.textContent = "Processing payment...";
            loading.classList.remove('hidden');
            
            // Get form data
            const orderData = {
                customer: {
                    name: document.getElementById('name').value,
                    phone: document.getElementById('phone').value,
                    address: document.getElementById('address').value,
                    province: document.getElementById('province').value,
                    city: document.getElementById('city').value,
                    district: document.getElementById('district').value,
                    postal: document.getElementById('postal').value
                },
                shipping: {
                    method: document.querySelector('input[name="shipping"]:checked').id,
                    cost: shippingCost
                },
                payment: document.querySelector('input[name="payment"]:checked').id,
                items: cartItems,
                subtotal: parseInt(document.getElementById('subtotal').textContent.replace(/\D/g, '')),
                discount: parseInt(document.getElementById('discount').textContent.replace(/-|\D/g, '') || '0'),
                total: parseInt(document.getElementById('total').textContent.replace(/\D/g, ''))
            };
            
            console.log('Order data:', orderData);
            
            // Simulate API call to process payment
            setTimeout(() => {
                // In a real implementation, this would:
                // 1. Call your backend to create the order
                // 2. Process payment with the selected method
                // 3. Create shipping label with Lion Parcel/J&T API
                
                alert("Payment successful! Thank you for your purchase.");
                
                // Redirect to thank you page in a real implementation
                // window.location.href = "/thank-you";
                
                // Restore button state
                btnText.textContent = `Complete Order (${document.getElementById('total').textContent})`;
                loading.classList.add('hidden');
                btn.disabled = false;
            }, 2000);
        }
    </script>
</body>
</html>