<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Profile Information') }}
        </h2>

    </header>

    <br>

    <div>
        <x-input-label for="name" :value="__('Name')" />
        <div class="mt-1 block w-full border-2 border-gray-300 shadow sm:rounded-lg p-2 bg-white rounded-lg">
            {{ $user->name }}
        </div>
    </div>

    <br>

    <div>
        <x-input-label for="email" :value="__('Email')" />
        <div class="mt-1 block w-full border-2 border-gray-300 shadow sm:rounded-lg  p-2 bg-white rounded-lg">
            {{ $user->email }}
        </div>


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

    <br>

    <div>
        <x-input-label for="Gender" :value="__('Gender')" />
        <div class="mt-1 block w-full border-2 border-gray-300 shadow sm:rounded-lg p-2 bg-white rounded-lg">
            {{ $user->gender }}
        </div>
    </div>

</section>