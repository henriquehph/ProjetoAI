<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\ShippingCost;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\ShippingCostFormRequest;


class ShippingCostController extends Controller
{
    public function index(Request $request): View
    {

        $shippingCosts = ShippingCost::query();

        if ($request->filled('shipping_cost')) {
            $shippingCosts->where('shiping_cost', 'like', '%' . $request->shipping_cost . '%');
        }
        if ($request->filled('min_value_threshold')) {
            $shippingCosts->where('min_value_threshold', '=', $request->min_value_threshold);
        }
        if ($request->filled('max_value_threshold')) {
            $shippingCosts->where('max_value_threshold', '=', $request->max_value_threshold);
        }

        $shippingCosts = $shippingCosts->paginate(20)->withQueryString();

        return view('shipping-costs.index', compact('shippingCosts'));

    }


    public function store(ShippingCostFormRequest $request): RedirectResponse
    {

        $data = $request->validated();

        if (
            ShippingCost::where('min_value_threshold', $data['min_value_threshold'])
                ->where('max_value_threshold', $data['max_value_threshold'])
                ->exists()
        ) {
            return redirect()->back()->withErrors(['error' => 'Shipping cost for this range already exists.']);
        }
        if ($data['min_value_threshold'] >= $data['max_value_threshold']) {
            return redirect()->back()->withErrors(['error' => 'Minimum value threshold must be less than maximum value threshold.']);
        }
        if ($data['shipping_cost'] < 0) {
            return redirect()->back()->withErrors(['error' => 'Shipping cost must be a non-negative number.']);
        }

        ShippingCost::create($data);



        return redirect()->route('shipping-costs.index');

    }

    public function edit(ShippingCost $shippingCost): View
    {

        if (!$shippingCost) {
            abort(404);
        }
        return view('shipping-costs.edit', [
            'shippingCost' => $shippingCost,
        ]);
    }


    public function update(ShippingCostFormRequest $request, ShippingCost $shippingCost): RedirectResponse
    {


        $data = $request->validated();

        if (
            ShippingCost::where('min_value_threshold', $data['min_value_threshold'])
                ->where('max_value_threshold', $data['max_value_threshold'])
                ->when($shippingCost = $request->route('shipping_cost'), function ($query) use ($shippingCost) {
                    $query->where('id', '!=', $shippingCost->id);
                })
                ->exists()
        ) {
            return redirect()->back()->withErrors(['error' => 'Shipping cost for this range already exists.']);
        }
        if ($data['min_value_threshold'] >= $data['max_value_threshold']) {
            return redirect()->back()->withErrors(['error' => 'Minimum value threshold must be less than maximum value threshold.']);
        }
        if ($data['shipping_cost'] < 0) {
            return redirect()->back()->withErrors(['error' => 'Shipping cost must be a non-negative number.']);
        }

        $shippingCost->update($data);

        return redirect()->route('shipping-costs.index');
    }

    public function create(): View
    {
        $shippingCost = new \App\Models\ShippingCost(); // empty object
        return view('shipping-costs.create')->with('shippingCost', $shippingCost);
    }


    public function destroy(ShippingCost $shippingCost): RedirectResponse
    {

        $shippingCost->delete();
        return redirect()->route('shipping-costs.index')->with('success', 'Shipping Cost deleted successfully.');

    }

}
