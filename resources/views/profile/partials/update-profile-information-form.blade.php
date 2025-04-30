<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)"
                required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification"
                            class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div>
            <x-input-label for="gender" :value="__('Gender')" />

            <select id="gender" name="gender"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring focus:ring-indigo-200">
                <option value="M" {{ old('gender', $user->gender) === 'M' ? 'selected' : '' }}>Male</option>
                <option value="F" {{ old('gender', $user->gender) === 'F' ? 'selected' : '' }}>Female</option>
                <option value="O" {{ old('gender', $user->gender) === 'O' ? 'selected' : '' }}>Other</option>
            </select>

            <x-input-error class="mt-2" :messages="$errors->get('gender')" />
        </div>

        <div>
            <x-input-label for="Default Delivery address" :value="__('Defaut Delivery Address')" />
            <x-text-input id="default_delivery_address" name="default_delivery_address" type="text" class="mt-1 block w-full" :value="old('default_delivery_address', $user->default_delivery_address)"
                 autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('default_delivery_address')" />
        </div>

        <div>
            <x-input-label for="nif" :value="__('Nif')" />
            <x-text-input id="nif" name="nif" type="text" class="mt-1 block w-full" :value="old('nif', $user->nif)"
                autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('nif')" />
        </div>

        <div>
            <x-input-label for="default_payment_type" :value="__('Default Payment Type')" />

            <select id="default_payment_type" name="default_payment_type"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring focus:ring-indigo-200">
                <option value="MB WAY" {{ old('default_payment_type', $user->default_payment_type) === 'MB WAY' ? 'selected' : '' }}>Mb Way</option>
                <option value="Visa" {{ old('default_payment_type', $user->default_payment_type) === 'Visa' ? 'selected' : '' }}>Visa</option>
                <option value="PayPal" {{ old('default_payment_type', $user->default_payment_type) === 'PayPal' ? 'selected' : '' }}>PayPal</option>
            </select>

            <x-input-error class="mt-2" :messages="$errors->get('default_payment_type')" />
        </div>

        <div class="mt-4">
            <x-input-label for="photo" :value="__('Profile Photo')" />
            <input id="photo" class="block mt-1 w-full" type="file" name="photo" accept="image/*" />
            <x-input-error :messages="$errors->get('photo')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
        <x-hyperlink-text-button
                    href="{{ route('profile.edit') }}"
                    text="Save"
                    type="success"/>

            <x-hyperlink-text-button
                    href="{{ route('profile.show') }}"
                    text="Cancel"
                    type="primary"/>
        </div>
    </form>
</section>