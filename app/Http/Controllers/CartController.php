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
use Symfony\Component\HttpFoundation\Response;

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

        // Recuperar carrinho da sessão, ou criar novo
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
            $element = $cart->firstWhere('id', $product->id);
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


    public function confirm(Request $request): RedirectResponse
    {

        if(Auth()->guest()) {
            return redirect('login')
                ->with('alert-type', 'danger')
                ->with('alert-msg', "You must be logged in to confirm the cart!");
            }
        $cart = session('cart', null);
        if (!$cart || ($cart->count() == 0)) {
            return back()
                ->with('alert-type', 'danger')
                ->with('alert-msg', "Cart was not confirmed, because cart is empty!");
        } else {
            $user = User::where('number', $request->validated()['user_number'])->first();
            if (!$user) {
                return back()
                    ->with('alert-type', 'danger')
                    ->with('alert-msg', "User number does not exist on the database!");
            }
            $insertProducts = [];
            $productsOfUser = $user->products;
            $ignored = 0;
            foreach ($cart as $product) {
                $exist = $productsOfUser->where('id', $product->id)->count();
                if ($exist) {
                    $ignored++;
                } else {
                    $insertProducts[$product->id] = [
                        "product_id" => $product->id,
                        "repeating" => 0,
                        "grade" => null,
                    ];
                }
            }
            $ignoredStr = match ($ignored) {
                0 => "",
                1 => "<br>(1 product was ignored because user was already enrolled in it)",
                default => "<br>($ignored products were ignored because user was already
                            enrolled on them)"
            };
            $totalInserted = count($insertProducts);
            $totalInsertedStr = match ($totalInserted) {
                0 => "",
                1 => "1 product registration was added to the user",
                default => "$totalInserted products registrations were added to the user",
            };
            if ($totalInserted == 0) {
                $request->session()->forget('cart');
                return back()
                    ->with('alert-type', 'danger')
                    ->with('alert-msg', "No registration was added to the user!$ignoredStr");
            } else {
                DB::transaction(function () use ($user, $insertProducts) {
                    $user->products()->attach($insertProducts);
                });
                $request->session()->forget('cart');
                if ($ignored == 0) {
                    return redirect()->route('users.show', ['user' => $user])
                        ->with('alert-type', 'success')
                        ->with('alert-msg', "$totalInsertedStr.");
                } else {
                    return redirect()->route('users.show', ['user' => $user])
                        ->with('alert-type', 'warning')
                        ->with('alert-msg', "$totalInsertedStr. $ignoredStr");
                }
            }
        }
    }
}
