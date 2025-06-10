<form method="GET" action="{{ route('users.index') }}" class="flex-wrap flex items-center gap-4 mb-4">

    <x-filter-input name="name" placeholder="Search by name" :value="request('name')" />
    <x-filter-input name="nif" placeholder="Search by NIF" :value="request('nif')" />
    <x-filter-select name="blocked" label="Block Stats" :options="['1' => 'Blocked', '0' => 'Not Blocked']" />

    <x-filter-select name="gender" label="Gender" :options="['M' => 'Male', 'F' => 'Female', 'O' => 'Other']" />
    <x-filter-select name="default_payment_type" label="Payment Type" :options="['Visa' => 'VISA', 'PayPal' => 'PayPal', 'MB WAY' => 'Mb Way']" />

    <div class="col-span-3 flex gap-4">
        <button type="submit" class="rounded-full bg-blue-600 text-white px-6 py-2 font-medium 
               hover:bg-blue-700 transition shadow-sm">
            Filter
        </button>

        <x-hyperlink-text-button href="{{ route('users.index') }}" text="Clear Filters" type="success" />
    </div>
</form>