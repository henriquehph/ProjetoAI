<form method="GET" action="{{ route('shipping-costs.index') }}" class="flex-wrap flex items-center gap-4 mb-4">

    <x-filter-input name="shipping_cost" placeholder="Search by shipping cost" :value="request('shipping_cost')" />
    <x-filter-input name="min_value_threshold" placeholder="Search by min value" :value="request('min_value_threshold')" />
    <x-filter-input name="max_value_threshold" placeholder="Search by max value" :value="request('max_value_threshold')" />
    
    <div class="col-span-3 flex gap-4">
        <button type="submit" class="rounded-full bg-blue-600 text-white px-6 py-2 font-medium 
               hover:bg-blue-700 transition shadow-sm">
            Filter
        </button>

        <x-hyperlink-text-button href="{{ route('shipping-costs.index') }}" text="Clear Filters" type="success" />
    </div>
</form>