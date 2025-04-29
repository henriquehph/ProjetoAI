<x-app-layout>
    <section>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <div class="max-w-xl"></div>
                    @include('profile.partials.membership_info', ['user' => $user])
                    @include('profile.partials.user_info', ['user' => $user])
                    @include('profile.partials.member_info', ['user' => $user]) 
                </div>
            </div>
        </div>
    </section>
</x-app-layout>