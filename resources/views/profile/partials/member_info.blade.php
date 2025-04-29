<br>

<section>

    <div>
        <x-input-label for="nif" :value="__('Nif')" />
        <div class="mt-1 block w-full border-2 border-gray-300 shadow sm:rounded-lg p-2 bg-white rounded-lg">
            {{ $user->nif ?: 'N/A' }}
        </div>
    </div>

    <br>
    
    <div>
        <x-input-label for="default_payment_type" :value="__('Default Payment Type')" />
        <div class="mt-1 block w-full border-2 border-gray-300 shadow sm:rounded-lg p-2 bg-white rounded-lg">
            {{ $user->default_payment_type ?: 'N/A' }}
        </div>
    </div>

</section>