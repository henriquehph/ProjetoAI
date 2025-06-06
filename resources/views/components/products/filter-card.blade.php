<div {{ $attributes }}>
    <form method="GET" action="{{ $filterAction }}">
        <div class="flex justify-between space-x-3 p-6 border dark:border-zinc-700 rounded-lg">
            <div class="grow flex flex-col space-y-2">
                <div>
                    <flux:select class="grow" name="category" label="Category" placeholder="Choose Category">
                        @foreach ($categories as $value => $description)
                            <flux:select.option value="{{ $value }}"  :selected="(string)$category === (string)$value"> {{ $description }}</flux:select.option>
                        @endforeach
                    </flux:select>
                </div>
                <div class="flex space-x-3">
                    <div class="flex-1/2">
                        <flux:select class="grow" name="price" label="Price" placeholder="Sort by Price">
                            <flux:select.option value="asc" :selected="$price === 'asc'">Price: Low to High</flux:select.option>
                            <flux:select.option value="desc" :selected="$price === 'desc'">Price: High to Low</flux:select.option>
                        </flux:select>
                    </div>
                </div>
                <div>
                    <flux:input name="name" label="Name" class="grow" value="{{ $name }}"/>
                </div>
            </div>
            <div class="grow-0 flex flex-col space-y-3 justify-start">
                <div class="pt-6">
                    <flux:button variant="primary" type="submit">Filter</flux:button>
                </div>
                <div>
                    <flux:button :href="$resetUrl">Cancel</flux:button>
                </div>
            </div>
        </div>
    </form>
</div>
