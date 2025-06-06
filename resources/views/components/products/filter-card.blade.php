<div {{ $attributes }}>
    <form method="GET" action="{{ $filterAction }}">
        <div class="flex justify-between space-x-3 p-6 border dark:border-gray-700 rounded-lg">
            <div class="grow flex flex-col space-y-2">
                <div>
                    <select class="grow" name="category" label="Category" placeholder="Choose Category">
                        @foreach ($categories as $value => $description)
                            <select.option value="{{ $value }}"  :selected="(string)$category === (string)$value"> {{ $description }}</select.option>
                        @endforeach
                    </select>
                </div>
                <div class="flex space-x-3">
                    <div class="flex-1/2">
                        <select class="grow" name="price" label="Price" placeholder="Sort by Price">
                            <select.option value="asc" :selected="$price === 'asc'">Price: Low to High</select.option>
                            <select.option value="desc" :selected="$price === 'desc'">Price: High to Low</select.option>
                        </select>
                    </div>
                </div>
                <div>
                    <input name="name" label="Name" class="grow" value="{{ $name }}"/>
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
