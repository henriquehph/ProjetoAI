<x-app-layout>
    <section>
        @include('profile.partials.membership_info', ['user' => $user])
        @include('profile.partials.user_info', ['user' => $user])
    </section>
</x-app-layout>