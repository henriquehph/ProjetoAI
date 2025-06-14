<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\Product;
use App\Models\User;
use App\Models\Settings_shipping_costs;
use App\Http\Requests\CartConfirmationFormRequest;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function show()
    {
        $cart = session('cart', collect());

        $cartItems = $cart->map(function ($item) {
            $product = Product::find($item['product_id']);

            if (!$product) {
            return null;
            }

            return [
                'product' => $product,
                'quantity' => $item['quantity'],
                'subtotal' => $product->price * $item['quantity'],
            ];
        });

        $subtotalCart = $cartItems->sum('subtotal');

        $shipping_cost = Settings_shipping_costs::where('min_value_threshold', '<=', $subtotalCart)
            ->where('max_value_threshold', '>', $subtotalCart)
            ->value('shipping_cost');

        if ($shipping_cost === null) {
            $shipping_cost = 0;
        }

        $total = $subtotalCart + $shipping_cost;

        return view('cart.show', ['cart' => $cartItems,'total' => $total, 'shipping'=>$shipping_cost]);
    }

    public function addToCart(Request $request, Product $product): RedirectResponse
    {
        $quantity = max((int) $request->input('quantity', 1), 1);

        // Recuperar carrinho da sessão, ou criar um novo
        $cart = session('cart', collect());

        // Verifica se o produto já está no carrinho
        $existingItem = $cart->firstWhere('product_id', $product->id);

        if ($existingItem) {
            // Atualizar quantidade se já existir
            $cart = $cart->map(function ($item) use ($product, $quantity) {
                if ($item['product_id'] === $product->id) {
                    $item['quantity'] += $quantity;
                }
                return $item;
            });
        } else {
            // Adiciona novo item ao carrinho
            $cart->push([
                'product_id' => $product->id,
                'quantity' => $quantity
            ]);
        }

        // Atualiza sessão
        $request->session()->put('cart', $cart);

        $alertType = 'success';
        $url = route('products.show', ['product' => $product]);
        $htmlMessage = "Product <a href='$url'>#{$product->id}
            <strong>\"{$product->name}\"</strong></a> was added to the cart with quantity {$quantity}.";

        return back()
            ->with('alert-msg', $htmlMessage)
            ->with('alert-type', $alertType);
    }

    public function removeFromCart(Request $request, Product $product): RedirectResponse
    {
        $url = route('products.show', ['product' => $product]);
        $cart = session('cart', null);
        if (!$cart) {
            $alertType = 'warning';
            $htmlMessage = "Product <a href='$url'>#{$product->id}</a>
                <strong>\"{$product->name}\"</strong> was not removed from the cart
                because cart is empty!";
            return back()
                ->with('alert-msg', $htmlMessage)
                ->with('alert-type', $alertType);
        } else {
            $element = $cart->firstWhere('product_id', $product->id);
            if ($element) {
                $cart->forget($cart->search($element));
                if ($cart->count() == 0) {
                    $request->session()->forget('cart');
                }
                $alertType = 'success';
                $htmlMessage = "Product <a href='$url'>#{$product->id}</a>
                <strong>\"{$product->name}\"</strong> was removed from the cart.";
                return back()
                    ->with('alert-msg', $htmlMessage)
                    ->with('alert-type', $alertType);
            } else {
                $alertType = 'warning';
                $htmlMessage = "Product <a href='$url'>#{$product->id}</a>
                <strong>\"{$product->name}\"</strong> was not removed from the cart
                because cart does not include it!";
                return back()
                    ->with('alert-msg', $htmlMessage)
                    ->with('alert-type', $alertType);
            }
        }
    }

    public function destroy(Request $request): RedirectResponse
    {
        $request->session()->forget('cart');
        return back()
            ->with('alert-type', 'success')
            ->with('alert-msg', 'Shopping Cart has been cleared');
    }


    public function confirm(CartConfirmationFormRequest $request): RedirectResponse
    {
        //Confirmar se utilizador está logado
        if (!auth()->check()) {
            return redirect()->route('login')->with('alert-msg', 'Please log in to confirm your purchase.');
        }
        //Confirmar se o carrinho tem produtos
        $cart = session('cart', collect());

        if ($cart->isEmpty()) {
            return back()->with('alert-type', 'danger')->with('alert-msg', 'Your cart is empty.');
        }
        //Obter preco final da compra
        $products = $cart->map(function ($item) {
            $product = Product::find($item['product_id']);
            if (!$product) return null;

            // preço final pode considerar desconto aqui
            $finalPrice = $product->price - ($product->discount ?? 0);
            if ($finalPrice < 0) $finalPrice = 0;

            return [
                'product' => $product,
                'quantity' => $item['quantity'],
                'subtotal' => $finalPrice * $item['quantity'],
                'unit_price' => $finalPrice,
            ];
        });
        $memberId = auth()->id();
        $nif = $request->input('nif');
        $address = $request->input('delivery_address');

        //Verificar saldo do cartão virtual
        //Criar Order
        $order = Order::create([
            'member_id' => $memberId,
            'status' => 'preparing',
            'date' => now(),
            'total_items' => $totalItems,
            'shipping_cost' => $shippingCost,
            'total' => $total,
            'nif' => $nif,
            'delivery_address' => $address,
            'pdf_receipt' => null,
            'cancel_reason' => null,
        ]);
        //Criar encomenda - OrderItems
        //Retirar o valor ao utilizador
        //Limpar carrinho
        $request->session()->forget('cart');
        return back()
            ->with('alert-type', 'success')
            ->with('alert-msg', 'Shopping Cart has been cleared');

    }
}
