@extends('layouts.app')

@section('content')
{{-- Load Tailwind via Play CDN so the utility classes in this view work immediately.
     Remove this when your app has proper compiled assets (npm run dev / prod). --}}
<script src="https://cdn.tailwindcss.com"></script>

<style>
/* Minimal fallback base styles in case CDN is blocked */
html,body{height:100%;margin:0;padding:0;font-family:Inter,ui-sans-serif,system-ui,-apple-system,"Segoe UI",Roboto,"Helvetica Neue",Arial;}
*{box-sizing:border-box;}
/* Basic container + utilities used in this file (lightweight) */
.container{width:100%;max-width:80rem;margin-left:auto;margin-right:auto;padding-left:1rem;padding-right:1rem;}
.min-h-screen{min-height:100vh;}
.bg-gradient-to-br{background-image:linear-gradient(135deg,var(--tw-gradient-stops));}
.from-amber-400{--tw-gradient-from:#f6ad55;--tw-gradient-stops:var(--tw-gradient-from),var(--tw-gradient-to,rgba(246,173,85,0));}
.via-orange-400{--tw-gradient-to:#fb923c;}
.to-red-500{--tw-gradient-to:#ef4444;}
.rounded-3xl{border-radius:1.5rem;}
.shadow-2xl{box-shadow:0 25px 50px -12px rgba(0,0,0,.25);}
.rounded-xl{border-radius:.75rem;}
.rounded-lg{border-radius:.5rem;}
.rounded-2xl{border-radius:1rem;}
.text-white{color:#fff;}
.text-gray-800{color:#1f2937;}
.bg-white{background:#fff;}
.border{border:1px solid #e5e7eb;}
.w-16{width:4rem;height:4rem;}
.object-cover{object-fit:cover;}
.flex{display:flex;}
.items-center{align-items:center;}
.justify-center{justify-content:center;}
.space-x-2>*+*{margin-left:.5rem;}
.space-y-3>*+*{margin-top:.75rem;}
.bg-orange-500{background:#f97316;color:#fff;}
.bg-red-500{background:#ef4444;color:#fff;}
.cursor-not-allowed{cursor:not-allowed;}
.text-center{text-align:center;}
.p-8{padding:2rem;}
.p-5{padding:1.25rem;}
.p-3{padding:.75rem;}
.p-12{padding:3rem;}
.mb-8{margin-bottom:2rem;}
.mb-6{margin-bottom:1.5rem;}
.mt-6{margin-top:1.5rem;}
.font-bold{font-weight:700;}
.font-semibold{font-weight:600;}
.select-none{user-select:none;}
.whitespace-nowrap{white-space:nowrap;}
.sticky{position:sticky;}
.top-8{top:2rem;}
.max-h-\[400px\]{max-height:400px;overflow:auto;}
.min-h-\[220px\]{min-height:220px;}
/* small responsive grid fallback */
.grid{display:grid;gap:2rem;}
.grid-cols-1{grid-template-columns:1fr;}
@media(min-width:1024px){ .lg\\:grid-cols-3{grid-template-columns:repeat(3,1fr);} .lg\\:col-span-2{grid-column:span 2 / span 2;} .lg\\:col-span-1{grid-column:span 1 / span 1;} }
</style>

<div class="min-h-screen bg-gradient-to-br from-amber-400 via-orange-400 to-red-500 py-8 px-6">
    {{-- Top-right user / profile / logout (fixed so it stays visible) --}}
    <div class="fixed right-6 z-50" style="top:72px;">
        @auth
        <div class="flex items-center space-x-3 bg-white/90 backdrop-blur rounded-full px-3 py-1 shadow-md">
            <span class="font-semibold text-gray-800">{{ auth()->user()->name ?? 'Kristine' }}</span>
            <a href="{{ route('profile') }}" class="text-sm text-gray-700 hover:underline">Profile</a>
            <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf
                <button type="submit" class="text-sm text-red-600 hover:underline">Logout</button>
            </form>
        </div>
        @else
        <div class="flex items-center space-x-3 bg-white/90 backdrop-blur rounded-full px-3 py-1 shadow-md">
            <span class="font-semibold text-gray-800">Kristine</span>
            <a href="{{ route('login') }}" class="text-sm text-gray-700 hover:underline">Login</a>
        </div>
        @endauth
    </div>

    <div class="container mx-auto max-w-5xl">

        <!-- Header -->
        <header class="text-center mb-8">
            <h1 class="text-4xl font-extrabold text-white drop-shadow-lg mb-2">☕ Coffee & Donuts Shop</h1>
            <p class="text-white/90 text-lg tracking-wide">Add your favorite items to cart and checkout!</p>
        </header>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <!-- Products Section -->
            <section class="lg:col-span-2 space-y-8">

                <!-- Frappes -->
                @if($frappes->count() > 0)
                <div class="bg-white rounded-3xl shadow-2xl p-8">
                    <h2 class="text-3xl font-semibold text-gray-800 mb-6 flex items-center gap-3">
                        <span aria-hidden="true" class="text-2xl">☕</span> Frappes
                    </h2>
                    <div class="grid grid-cols-1 gap-5">
                        @foreach($frappes as $frappe)
                        <article class="border border-gray-200 rounded-xl p-5 hover:shadow-lg transition-shadow duration-300 flex items-center space-x-5">
                            <div class="flex-shrink-0">
                                @if($frappe->image)
                                    <img src="{{ asset('storage/' . $frappe->image) }}" 
                                         alt="{{ $frappe->name }}" 
                                         class="w-16 h-16 object-cover rounded-lg border border-gray-300 shadow-sm">
                                @else
                                    <div class="w-16 h-16 bg-gradient-to-br from-amber-100 to-orange-200 rounded-lg border border-gray-300 flex items-center justify-center text-2xl">
                                        ☕
                                    </div>
                                @endif
                            </div>

                            <div class="flex-1 flex flex-col justify-center">
                                <h3 class="text-lg font-semibold text-gray-900">{{ $frappe->name }}</h3>
                                <span class="text-orange-600 font-bold mt-1 text-base">₱{{ number_format($frappe->price, 2) }}</span>
                                @if($frappe->description)
                                    <p class="text-gray-600 text-sm mt-1 leading-tight">{{ $frappe->description }}</p>
                                @endif
                            </div>

                            <div class="flex flex-col items-center space-y-3">
                                <div class="flex items-center space-x-2">
                                    <button onclick="updateQuantity('frappe-{{ $frappe->id }}', -1)" 
                                        class="w-8 h-8 bg-gray-200 hover:bg-gray-300 rounded-full flex items-center justify-center text-gray-700 font-bold transition-colors duration-200 text-lg focus:outline-none focus:ring-2 focus:ring-offset-1 focus:ring-orange-400">
                                        –
                                    </button>
                                    <span id="frappe-{{ $frappe->id }}-qty" class="w-8 text-center font-semibold text-lg select-none">0</span>
                                    <button onclick="updateQuantity('frappe-{{ $frappe->id }}', 1)" 
                                        class="w-8 h-8 bg-orange-500 hover:bg-orange-600 rounded-full flex items-center justify-center text-white font-bold transition-colors duration-200 text-lg focus:outline-none focus:ring-2 focus:ring-offset-1 focus:ring-orange-400">
                                        +
                                    </button>
                                </div>
                                <button onclick="addToCart('frappe-{{ $frappe->id }}', '{{ addslashes($frappe->name) }}', {{ $frappe->price }}, 'frappe')" 
                                    class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-lg text-sm font-semibold transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-offset-1 focus:ring-orange-400 whitespace-nowrap">
                                    Add to Cart
                                </button>
                            </div>
                        </article>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Donuts -->
                @if($donuts->count() > 0)
                <div class="bg-white rounded-3xl shadow-2xl p-8">
                    <h2 class="text-3xl font-semibold text-gray-800 mb-6 flex items-center gap-3">
                        <span aria-hidden="true" class="text-2xl">🍩</span> Donuts
                    </h2>
                    <div class="grid grid-cols-1 gap-5">
                        @foreach($donuts as $donut)
                        <article class="border border-gray-200 rounded-xl p-5 hover:shadow-lg transition-shadow duration-300 flex items-center space-x-5">
                            <div class="flex-shrink-0">
                                @if($donut->image)
                                    <img src="{{ asset('storage/' . $donut->image) }}" 
                                         alt="{{ $donut->name }}" 
                                         class="w-16 h-16 object-cover rounded-lg border border-gray-300 shadow-sm">
                                @else
                                    <div class="w-16 h-16 bg-gradient-to-br from-pink-100 to-rose-200 rounded-lg border border-gray-300 flex items-center justify-center text-2xl">
                                        🍩
                                    </div>
                                @endif
                            </div>

                            <div class="flex-1 flex flex-col justify-center">
                                <h3 class="text-lg font-semibold text-gray-900">{{ $donut->name }}</h3>
                                <span class="text-orange-600 font-bold mt-1 text-base">₱{{ number_format($donut->price, 2) }}</span>
                                @if($donut->description)
                                    <p class="text-gray-600 text-sm mt-1 leading-tight">{{ $donut->description }}</p>
                                @endif
                            </div>

                            <div class="flex flex-col items-center space-y-3">
                                <div class="flex items-center space-x-2">
                                    <button onclick="updateQuantity('donut-{{ $donut->id }}', -1)" 
                                        class="w-8 h-8 bg-gray-200 hover:bg-gray-300 rounded-full flex items-center justify-center text-gray-700 font-bold transition-colors duration-200 text-lg focus:outline-none focus:ring-2 focus:ring-offset-1 focus:ring-orange-400">
                                        –
                                    </button>
                                    <span id="donut-{{ $donut->id }}-qty" class="w-8 text-center font-semibold text-lg select-none">0</span>
                                    <button onclick="updateQuantity('donut-{{ $donut->id }}', 1)" 
                                        class="w-8 h-8 bg-orange-500 hover:bg-orange-600 rounded-full flex items-center justify-center text-white font-bold transition-colors duration-200 text-lg focus:outline-none focus:ring-2 focus:ring-offset-1 focus:ring-orange-400">
                                        +
                                    </button>
                                </div>
                                <button onclick="addToCart('donut-{{ $donut->id }}', '{{ addslashes($donut->name) }}', {{ $donut->price }}, 'donut')" 
                                    class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-lg text-sm font-semibold transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-offset-1 focus:ring-orange-400 whitespace-nowrap">
                                    Add to Cart
                                </button>
                            </div>
                        </article>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- No products message -->
                @if($frappes->count() == 0 && $donuts->count() == 0)
                <div class="bg-white rounded-3xl shadow-2xl p-12 text-center">
                    <div class="text-gray-500">
                        <span class="text-7xl mb-6 block">🏪</span>
                        <h3 class="text-2xl font-semibold mb-3">No products available</h3>
                        <p class="text-base">Please check back later or contact the administrator.</p>
                    </div>
                </div>
                @endif
            </section>

            <!-- Shopping Cart -->
            <aside class="lg:col-span-1">
                <div class="bg-white rounded-3xl shadow-2xl p-8 sticky top-8">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center gap-3">
                        <span aria-hidden="true" class="text-xl">🛒</span> Shopping Cart
                    </h2>

                    <!-- Cart Items -->
                    <div id="cart-items" class="space-y-4 mb-8 min-h-[220px] rounded-lg overflow-y-auto max-h-[400px]">
                        <div class="text-center text-gray-400 py-16 select-none">
                            <span class="text-5xl mb-3 block">🛒</span>
                            Your cart is empty
                        </div>
                    </div>

                    <!-- Cart Summary -->
                    <div class="border-t border-gray-200 pt-6 space-y-4 text-gray-700">
                        <div class="flex justify-between items-center text-base">
                            <span>Subtotal:</span>
                            <span id="subtotal" class="font-semibold">₱0.00</span>
                        </div>
                        <div class="flex justify-between items-center text-base">
                            <span>Tax (12%):</span>
                            <span id="tax" class="font-semibold">₱0.00</span>
                        </div>
                        <div class="border-t border-gray-200 pt-4">
                            <div class="flex justify-between items-center text-xl font-bold text-orange-600">
                                <span>Total:</span>
                                <span id="total">₱0.00</span>
                            </div>
                        </div>
                    </div>

                    <!-- Checkout & Clear Buttons -->
                    <div class="mt-6 space-y-3">
                        <button id="checkout-btn" onclick="checkout()" disabled 
                            class="w-full bg-gray-400 text-white font-bold py-3 rounded-2xl transition-colors duration-300 cursor-not-allowed focus:outline-none focus:ring-4 focus:ring-gray-400/60">
                            Checkout
                        </button>
                        <button id="clear-btn" onclick="clearCart()" class="w-full bg-red-500 hover:bg-red-600 text-white font-semibold py-2 rounded-2xl transition-colors duration-300 focus:outline-none focus:ring-4 focus:ring-red-400/60" style="display:none;">
                            Clear Cart
                        </button>
                    </div>
                </div>
            </aside>

        </div>
    </div>
</div>

<script>
/* Your JavaScript remains unchanged */
let cart = {};
let quantities = {};

function updateQuantity(itemId, change) {
    if (!quantities[itemId]) quantities[itemId] = 0;
    quantities[itemId] = Math.max(0, quantities[itemId] + change);
    document.getElementById(itemId + '-qty').textContent = quantities[itemId];
}

function addToCart(itemId, itemName, price, type) {
    const qty = quantities[itemId] || 0;
    if (qty === 0) {
        alert('Please select quantity first!');
        return;
    }
    
    if (!cart[itemId]) {
        cart[itemId] = { 
            name: itemName, 
            price: parseFloat(price), 
            quantity: 0,
            type: type
        };
    }
    
    cart[itemId].quantity += qty;
    quantities[itemId] = 0;
    document.getElementById(itemId + '-qty').textContent = 0;
    
    updateCartDisplay();
}

function removeFromCart(itemId) {
    delete cart[itemId];
    updateCartDisplay();
}

function updateCartQuantity(itemId, change) {
    if (cart[itemId]) {
        cart[itemId].quantity = Math.max(0, cart[itemId].quantity + change);
        if (cart[itemId].quantity === 0) {
            delete cart[itemId];
        }
    }
    updateCartDisplay();
}

function updateCartDisplay() {
    const cartItems = document.getElementById('cart-items');
    const subtotalEl = document.getElementById('subtotal');
    const taxEl = document.getElementById('tax');
    const totalEl = document.getElementById('total');
    const checkoutBtn = document.getElementById('checkout-btn');
    const clearBtn = document.getElementById('clear-btn');
    
    if (Object.keys(cart).length === 0) {
        cartItems.innerHTML = `
            <div class="text-center text-gray-400 py-16 select-none">
                <span class="text-5xl mb-3 block">🛒</span>
                Your cart is empty
            </div>
        `;
        checkoutBtn.disabled = true;
        checkoutBtn.className = "w-full bg-gray-400 text-white font-bold py-3 rounded-2xl transition-colors duration-300 cursor-not-allowed focus:outline-none focus:ring-4 focus:ring-gray-400/60";
        clearBtn.style.display = 'none';
        subtotalEl.textContent = '₱0.00';
        taxEl.textContent = '₱0.00';
        totalEl.textContent = '₱0.00';
        return;
    }
    
    let subtotal = 0;
    let cartHTML = '';
    
    Object.keys(cart).forEach(itemId => {
        const item = cart[itemId];
        const itemTotal = item.price * item.quantity;
        subtotal += itemTotal;
        
        const typeIcon = item.type === 'frappe' ? '☕' : '🍩';
        
        cartHTML += `
            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg shadow-sm">
                <div class="flex-1">
                    <h4 class="font-medium text-gray-800 text-sm flex items-center gap-1">
                        <span aria-hidden="true">${typeIcon}</span>${item.name}
                    </h4>
                    <p class="text-xs text-gray-600">₱${item.price.toFixed(2)} each</p>
                </div>
                <div class="flex items-center space-x-2">
                    <button onclick="updateCartQuantity('${itemId}', -1)" class="w-6 h-6 bg-red-500 hover:bg-red-600 rounded-full flex items-center justify-center text-white text-xs font-bold focus:outline-none focus:ring-2 focus:ring-offset-1 focus:ring-red-400">-</button>
                    <span class="w-8 text-center font-semibold text-sm select-none">${item.quantity}</span>
                    <button onclick="updateCartQuantity('${itemId}', 1)" class="w-6 h-6 bg-green-500 hover:bg-green-600 rounded-full flex items-center justify-center text-white text-xs font-bold focus:outline-none focus:ring-2 focus:ring-offset-1 focus:ring-green-400">+</button>
                </div>
                <div class="text-right ml-3">
                    <p class="font-bold text-sm">₱${itemTotal.toFixed(2)}</p>
                </div>
            </div>
        `;
    });
    
    const tax = subtotal * 0.12;
    const total = subtotal + tax;
    
    cartItems.innerHTML = cartHTML;
    subtotalEl.textContent = `₱${subtotal.toFixed(2)}`;
    taxEl.textContent = `₱${tax.toFixed(2)}`;
    totalEl.textContent = `₱${total.toFixed(2)}`;
    
    checkoutBtn.disabled = false;
    checkoutBtn.className = "w-full bg-green-500 hover:bg-green-600 text-white font-bold py-3 rounded-2xl transition-colors duration-300 focus:outline-none focus:ring-4 focus:ring-green-400";
    clearBtn.style.display = 'block';
}

function clearCart() {
    if (confirm('Are you sure you want to clear your cart?')) {
        cart = {};
        quantities = {};
        document.querySelectorAll('[id$="-qty"]').forEach(el => {
            el.textContent = '0';
        });
        updateCartDisplay();
    }
}

function checkout() {
    if (Object.keys(cart).length === 0) {
        alert('Your cart is empty!');
        return;
    }
    
    let message = 'Thank you for your purchase!\n\nOrder Summary:\n';
    Object.values(cart).forEach(item => {
        message += `${item.name} x ${item.quantity} = ₱${(item.price * item.quantity).toFixed(2)}\n`;
    });
    
    const subtotal = Object.values(cart).reduce((acc, item) => acc + item.price * item.quantity, 0);
    const tax = subtotal * 0.12;
    const total = subtotal + tax;
    
    message += `\nSubtotal: ₱${subtotal.toFixed(2)}`;
    message += `\nTax (12%): ₱${tax.toFixed(2)}`;
    message += `\nTotal: ₱${total.toFixed(2)}`;
    
    alert(message);
    clearCart();
}

updateCartDisplay();
</script>
@endsection