<div {{ $attributes }}>
    <form method="GET" action="{{ $filterAction }}">
        <div class="flex flex-wrap justify-between gap-4 p-6 border dark:border-gray-700 rounded-lg bg-white dark:bg-gray-800">
            <div class="flex flex-col gap-4 w-full md:w-2/3">
                {{-- Categoria --}}
                <div>
                    <label for="category" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">Category</label>
                    <select name="category" id="category" class="w-full p-2 rounded-md border dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-100">
                        <option value="">Choose Category</option>
                        @foreach ($categories as $value => $description)
                            <option value="{{ $value }}" @if((string)$category === (string)$value) selected @endif>
                                {{ $description }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Ordenação por preço --}}
                <div>
                    <label for="price" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">Sort by Price</label>
                    <select name="price" id="price" class="w-full p-2 rounded-md border dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-100">
                        <option value="">Select Order</option>
                        <option value="asc" @if($price === 'asc') selected @endif>Price: Low to High</option>
                        <option value="desc" @if($price === 'desc') selected @endif>Price: High to Low</option>
                    </select>
                </div>

                {{-- Nome --}}
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">Name</label>
                    <input type="text" name="name" id="name" value="{{ $name }}"
                        class="w-full p-2 rounded-md border dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-100"
                        placeholder="Search by name">
                </div>
            </div>

            <div class="flex flex-col gap-4 w-full md:w-auto justify-start pt-2">
                <button type="submit" class="px-4 py-2 rounded-md bg-blue-600 text-white hover:bg-blue-700">
                    Filter
                </button>
                <a href="{{ $resetUrl }}" class="px-4 py-2 rounded-md bg-gray-300 text-black hover:bg-gray-400 dark:bg-gray-600 dark:text-white dark:hover:bg-gray-500">
                    Cancel
                </a>
            </div>
        </div>
    </form>
</div>
