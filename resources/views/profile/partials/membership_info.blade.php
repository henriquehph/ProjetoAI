<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('Profile') }}
    </h2>
</x-slot>

<div class="flex justify-between">
    <!-- Card Balance -->
    <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
        <div class="max-w-xs">
            <p class="text-lg text-gray-700 dark:text-gray-300 font-semibold">
                Card Balance: €{{ number_format($balance, 2) }}
            </p>
            <x-hyperlink-text-button text="Add Funds" href="{{ route('funds.add') }}" type="success" />
        </div>
    </div>

    @if (Auth::user()->type === 'pending_member')
        <!-- Membership Payment -->
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class="max-w-xs">
                <p class="text-lg text-gray-700 dark:text-gray-300 font-semibold">
                    UPGRADE:
                </p>
                <x-hyperlink-text-button :href="route('transactions.create', [
                'type' => 'debit',
                'debit_type' => 'membership_fee',
                'value' => $membershipFee,
                'from' => url()->current()
            ])" :text="'Pay Membership Fee (€' . $membershipFee . ')'" type="primary" />


            </div>
        </div>
    @endif
</div>

<br>

<!-- Display Membership Status -->
<div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
    <div class="max-w-xl">
        <p class="text-lg text-gray-700 dark:text-gray-300 font-semibold">
            Membership Status: {{ $membership}}
            <!-- Show membership status -->
        </p>
    </div>
</div>

<br>