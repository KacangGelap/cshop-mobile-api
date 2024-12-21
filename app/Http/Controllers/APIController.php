<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\product, App\Models\User, App\Models\cart ;
use Auth;
class APIController extends Controller
{
    //Products-management
    public function products_index() {
        $data = product::all();
        if ($data->count() > 0 ){
            return response()->json($data, 200, [], JSON_PRETTY_PRINT);
        }
        else{
            return abort(404);
        }
    }    
    
    public function products_show($id){
        $data = product::findOrFail($id);
        return response()->json($data, 200, [], JSON_PRETTY_PRINT);
    }

    public function products_categories($cat){
        $data = product::where('category_id',$cat)->get();
        return response()->json($data, 200, [], JSON_PRETTY_PRINT);
    }

    //User-based
    public function user_profile(Request $request) {
        return response()->json([
            'user' => $request->user(),
        ], 200);
    }
    public function user_cart(){        
        $userId = auth()->id();

        $cartItems = Cart::with('product')
                            ->where('user_id', $userId)
                            ->get();

        return response()->json($cartItems, 200, [], JSON_PRETTY_PRINT);
    }
    public function add_to_cart(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'product_id' => 'required|integer|exists:product,id',
            'quantity' => 'required|integer|min:1', // You can customize the validation based on your needs
        ]);

        // Get the authenticated user
        $user = Auth::user();
        
        if (!$user) {
            return response()->json(['error' => 'Unauthenticated'], 401);
        }

        // Check if the product already exists in the user's cart
        $existingCartItem = cart::where('user_id', $user->id)
            ->where('product_id', $validated['product_id'])
            ->first();

        if ($existingCartItem) {
            // If product is already in the cart, update the quantity
            $existingCartItem->update([
                'stock' => $existingCartItem->stock + $validated['quantity'],
            ]);
            return response()->json(['message' => 'Product quantity updated in cart'], 200);
        } else {
            // If product is not in the cart, create a new entry
            cart::create([
                'user_id' => $user->id,
                'product_id' => $validated['product_id'],
                'stock' => $validated['quantity'],
            ]); 
            return response()->json(['message' => 'Product added to cart'], 200);
        }
    }
    public function createOrder(Request $request)
    {
        $validated = $request->validate([
            'cart_items' => 'required|array',
            'cart_items.*.product_id' => 'required|exists:products,id',
            'cart_items.*.stock' => 'required|integer|min:1',
        ]);

        $orders = [];
        $totalOrderPrice = 0;

        foreach ($validated['cart_items'] as $item) {
            $product = Product::findOrFail($item['product_id']);

            if ($product->stock < $item['stock']) {
                return response()->json([
                    'error' => "Insufficient stock for product {$product->name}",
                ], 400);
            }

            // Deduct stock
            $product->stock -= $item['stock'];
            $product->save();

            // Create the order
            $order = Order::create([
                'user_id' => Auth::id(),
                'product_id' => $item['product_id'],
                'stock' => $item['stock'],
                'status' => 'diproses',
            ]);

            $orders[] = $order;
            $totalOrderPrice += $product->price * $item['stock'];
        }

        return response()->json([
            'message' => 'Orders created successfully',
            'orders' => $orders,
            'totalOrderPrice' => $totalOrderPrice,
        ], 201);
    }
    // Function to get all orders for the authenticated user
    public function getOrders()
    {
        $orders = Order::with('product')->where('user_id', Auth::id())->get();

        return response()->json($orders);
    }

}
