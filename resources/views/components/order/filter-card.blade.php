<div {{ $attributes }}>
    <form method="GET" action="{{ $filterAction }}">
        <div class="flex justify-between space-x-3 p-6 border dark:border-zinc-700 rounded-lg">
            <div class="grow flex flex-col space-y-2">
                <div>
                    <flux:select class="grow" name="status" label="status" placeholder="Sort by Status">
                        @foreach ($status as $value => $description)
                            <flux:select.option value="{{ $value }}"  :selected="(string)$status === (string)$value"> {{ $description }}</flux:select.option>
                        @endforeach
                    </flux:select>
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
