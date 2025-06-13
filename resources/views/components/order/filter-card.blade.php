<div {{ $attributes }}>
    <form method="GET" action="{{ $filterAction }}">
        <div class="flex flex-wrap justify-between gap-4 p-6 border dark:border-gray-700 rounded-lg bg-white dark:bg-gray-800">
            <div class="flex flex-col gap-4 w-full md:w-2/3">
                {{-- Para guardar o status --}}
                <input type="hidden" name="status" value="{{ $status }}">
                {{-- Preço --}}
                <div>
                    <label for="price" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">Sort by Price</label>
                    <select name="price" id="price" class="w-full p-2 rounded-md border dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-100">
                        <option value="">Select Order</option>
                        <option value="asc" @if($price === 'asc') selected @endif>Price: Low to High</option>
                        <option value="desc" @if($price === 'desc') selected @endif>Price: High to Low</option>
                    </select>
                </div>
                {{-- Data --}}
                <div>
                    <label for="price" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">Sort by Date</label>
                    <select name="date" id="date" class="w-full p-2 rounded-md border dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-100">
                        <option value="">Select Date</option>
                        <option value="today" @if($date === 'today') selected @endif>Today</option>
                        <option value="recent" @if($date === 'recent') selected @endif>Most Recent</option>
                        <option value="oldest" @if($date === 'oldest') selected @endif>Oldest</option>
                    </select>
                </div>
            </div>
            <div class="grow-0 flex flex-col space-y-3 justify-start">
                <div class="pt-6">
                    <button variant="primary" type="submit">Filter</button>
                </div>
                <div>
                    <button :href="$resetUrl">Cancel</button>
                </div>
            </div>
        </div>
    </form>
</div>
