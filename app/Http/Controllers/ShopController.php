<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Frappe;
use App\Models\Donut;

class ShopController extends Controller
{
    /**
     * Display the shopping page with frappes and donuts
     */
    public function index()
    {
        // Fetch all frappes and donuts from database
        $frappes = Frappe::all();
        $donuts = Donut::all();
        
        return view('shop.index', compact('frappes', 'donuts'));
    }
    
    /**
     * Add item to cart (if you want to handle cart via sessions/database)
     */
    public function addToCart(Request $request)
    {
        $request->validate([
            'item_id' => 'required|integer',
            'item_type' => 'required|in:frappe,donut',
            'quantity' => 'required|integer|min:1'
        ]);
        
        // Get cart from session or initialize empty array
        $cart = session()->get('cart', []);
        
        $itemKey = $request->item_type . '_' . $request->item_id;
        
        // Get item details from database
        if ($request->item_type === 'frappe') {
            $item = Frappe::findOrFail($request->item_id);
        } else {
            $item = Donut::findOrFail($request->item_id);
        }
        
        // Add or update item in cart
        if (isset($cart[$itemKey])) {
            $cart[$itemKey]['quantity'] += $request->quantity;
        } else {
            $cart[$itemKey] = [
                'id' => $item->id,
                'name' => $item->name,
                'price' => $item->price,
                'type' => $request->item_type,
                'quantity' => $request->quantity
            ];
        }
        
        // Save cart back to session
        session()->put('cart', $cart);
        
        return response()->json([
            'success' => true,
            'message' => 'Item added to cart successfully!'
        ]);
    }
    
    /**
     * Get cart contents
     */
    public function getCart()
    {
        $cart = session()->get('cart', []);
        
        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }
        
        $tax = $subtotal * 0.12;
        $total = $subtotal + $tax;
        
        return response()->json([
            'cart' => $cart,
            'subtotal' => $subtotal,
            'tax' => $tax,
            'total' => $total
        ]);
    }
    
    /**
     * Clear cart
     */
    public function clearCart()
    {
        session()->forget('cart');
        
        return response()->json([
            'success' => true,
            'message' => 'Cart cleared successfully!'
        ]);
    }
    
    /**
     * Process checkout
     */
    public function checkout(Request $request)
    {
        $cart = session()->get('cart', []);
        
        if (empty($cart)) {
            return response()->json([
                'success' => false,
                'message' => 'Cart is empty!'
            ], 400);
        }
        
        // Calculate totals
        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }
        
        $tax = $subtotal * 0.12;
        $total = $subtotal + $tax;
        
        // Here you could:
        // 1. Save order to database
        // 2. Process payment
        // 3. Send confirmation email
        // 4. Update inventory
        
        // For now, just clear the cart and return success
        session()->forget('cart');
        
        return response()->json([
            'success' => true,
            'message' => 'Order processed successfully!',
            'total' => $total,
            'order_details' => [
                'items' => $cart,
                'subtotal' => $subtotal,
                'tax' => $tax,
                'total' => $total
            ]
        ]);
    }
}