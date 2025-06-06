<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-white dark:bg-zinc-800">
        <flux:sidebar sticky stashable class="border-e border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
            <flux:sidebar.toggle icon="x-mark" inset="left"/>

            <flux:menu.separator />

            <flux:navlist variant="outline">
                <flux:navlist.group class="grid">
                    <flux:navlist.item icon="home" :href="route('dashboard')" :current="request()->routeIs('dashboard')" wire:navigate>{{ __('Dashboard') }}</flux:navlist.item>
                    <flux:navlist.item icon="currency-euro"  :href="route('products.index')"  :current="request()->routeIs('products.index')" wire:navigate>{{ __('Products') }}</flux:navlist.item>
                    <flux:navlist.item icon="inbox"  :href="route('orders.index')" :current="request()->routeIs('orders.index')" wire:navigate>{{ __('Orders') }}</flux:navlist.item>
                    <!-- Verifica o número de produtos no cart, e mostra caso seja maior que 0 -->
                    <flux:navlist.item icon="shopping-cart"  :href="route('cart.show')" :current="request()->routeIs('cart.show')"
                        badge="{{ session('cart') && session('cart')->count() > 0 ? session('cart')->count(): '' }}"
                        wire:navigate>{{ __('Cart') }}
                    </flux:navlist.item>
                </flux:navlist.group>
            </flux:navlist>

            {{-- <flux:spacer /> --}}
            <flux:spacer/>
            {{-- <flux:separator /> --}}
            <flux:separator />

            <!-- Desktop User Menu -->
            @auth
                <flux:dropdown position="bottom" align="start">
                    <flux:profile
                        :name="auth()->user()?->firstLastName()"
                        :initials="auth()->user()?->firstLastInitial()"
                        :avatar="auth()->user()?->photoFullUrl"
                        icon-trailing="chevrons-up-down"
                    />

                    <flux:menu class="w-[220px]">
                        <flux:menu.radio.group>
                            <div class="p-0 text-sm font-normal">
                                <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                                    <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                        <span
                                            class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white"
                                        >
                                            {{ auth()->user()?->firstLastInitial()}}
                                        </span>
                                    </span>
                                    <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                        <span
                                            class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200  text-black dark:bg-neutral-700 dark:text-white"
                                            >
                                            @if(auth()->user()?->photoFullUrl)
                                                <img src="{{ auth()->user()?->photoFullUrl }}" alt="{{ auth()->user()?->name }}"
                                                    class="h-full w-full object-cover" />
                                            @else
                                                {{ auth()->user()?->firstLastInitial()}}
                                            @endif

                                    <div class="grid flex-1 text-start text-sm leading-tight">
                                        <span class="truncate font-semibold">{{ auth()->user()?->name}}</span>
                                        <span class="truncate text-xs">{{ auth()->user()?->email }}</span>
                                    </div>
                                </div>
                            </div>
                        </flux:menu.radio.group>


                        <flux:menu.radio.group>
                            <flux:menu.item :href="route('settings.profile')" icon="cog" wire:navigate>{{ __('Settings') }}</flux:menu.item>
                        </flux:menu.radio.group>

                        <flux:menu.separator />

                        <form method="POST" action="{{ route('logout') }}" class="w-full">
                            @csrf
                            <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                                {{ __('Log Out') }}
                            </flux:menu.item>
                        </form>
                    </flux:menu>
                </flux:dropdown>
            @else
                <flux:navlist variant="outline">
                    <flux:navlist.group class="grid">
                        <flux:navlist.item icon="key" :href="route('login')" :current="request()->routeIs('login')" wire:navigate>Login</flux:navlist.item>
                        <flux:navlist.item icon="information-circle"  :href="'#'" :current="false" wire:navigate>Help</flux:navlist.item>
                    </flux:navlist.group>
                </flux:navlist>
            @endauth
            <flux:menu.separator />
        </flux:sidebar>

        <!-- Mobile User Menu -->
        <flux:header class="lg:hidden">
            <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

            <flux:spacer />

            @auth
            <flux:dropdown position="top" align="end">
                <flux:profile
                    :name="auth()->user()?->firstLastName()"
                    :initials="auth()->user()?->firstLastInitial()"
                    :avatar="auth()->user()?->photoFullUrl"
                    icon-trailing="chevrons-up-down"
                />

                <flux:menu>
                    <flux:menu.radio.group>
                        <div class="p-0 text-sm font-normal">
                            <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                                <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                    <span
                                        class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200  text-black dark:bg-neutral-700 dark:text-white">
                                        @if(auth()->user()?->photoFullUrl)
                                            <img src="{{ auth()->user()?->photoFullUrl }}" alt="{{ auth()->user()?->name }}"
                                                class="h-full w-full object-cover" />
                                        @else
                                            {{ auth()->user()?->firstLastInitial()}}
                                        @endif

                                <div class="grid flex-1 text-start text-sm leading-tight">
                                    <span class="truncate font-semibold">{{ auth()->user()?->name }}</span>
                                    <span class="truncate text-xs">{{ auth()->user()?->email }}</span>
                                </div>
                            </div>
                        </div>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <flux:menu.radio.group>
                        <flux:menu.item :href="route('settings.profile')" icon="cog" wire:navigate>{{ __('Settings') }}</flux:menu.item>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                            {{ __('Log Out') }}
                        </flux:menu.item>
                    </form>
                </flux:menu>
            </flux:dropdown>
            @else
                <flux:navbar>
                    <flux:navbar.item  icon="key" :href="route('login')" :current="request()->routeIs('login')" wire:navigate>Login</flux:navbar.item>
                </flux:navbar>
            @endauth
        </flux:header>

        {{ $slot }}

        @fluxScripts
    </body>
</html>
