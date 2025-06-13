<form method="GET" action="{{ route('categories.index') }}" class="flex-wrap flex items-center gap-4 mb-4">

    <x-filter-input name="name" placeholder="Search by name" :value="request('name')" />
    
    <x-filter-select name="deleted_at" label="Delete Status" :options="['1' => 'Deleted', '0' => 'Active']" />

    <div class="col-span-3 flex gap-4">
        <button type="submit" class="rounded-full bg-blue-600 text-white px-6 py-2 font-medium 
               hover:bg-blue-700 transition shadow-sm">
            Filter
        </button>

        <x-hyperlink-text-button href="{{ route('categories.index') }}" text="Clear Filters" type="success" />
    </div>
</form>