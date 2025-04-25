<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("View your account's profile information.") }}
        </p>
    </header>

    <div>
        <p><strong>{{ __('Name') }}:</strong> {{ $user->name }}</p>
    </div>

    <div>
        <p><strong>{{ __('Email') }}:</strong> {{ $user->email }}</p>
        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
            <div>
                <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                    {{ __('Your email address is unverified.') }}
                </p>
            </div>
        @endif
    </div>

    <div>
        <p><strong>{{ __('Gender') }}:</strong> 
            @switch($user->gender)
                @case('M')
                    {{ __('Male') }}
                    @break
                @case('F')
                    {{ __('Female') }}
                    @break
                @case('O')
                    {{ __('Other') }}
                    @break
                @default
                    {{ __('Not specified') }}
            @endswitch
        </p>
    </div>

    <div>
        <p><strong>{{ __('Default Delivery Address') }}:</strong> {{ $user->default_delivery_address }}</p>
    </div>

    <div>
        <p><strong>{{ __('NIF') }}:</strong> {{ $user->nif }}</p>
    </div>

    <div>
        <p><strong>{{ __('Default Payment Type') }}:</strong> {{ $user->default_payment_type }}</p>
    </div>

    <div>
        <p><strong>{{ __('Profile Photo') }}:</strong></p>
        @if($user->photo)
            <img src="{{ asset('storage/' . $user->photo) }}" alt="{{ $user->name }}" class="mt-2 w-20 h-20 rounded-full">
        @else
            <p>{{ __('No photo uploaded') }}</p>
        @endif
    </div>
</section>