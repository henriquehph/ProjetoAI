@vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/table2excel.js'])
<!--ADD
    User
    -average money spent per purchase
    -total money spent
    -total number of purchases
    -most expensive purchase
    -cheapest purchase?????


    Admin
    -total number of users
    -total number of products
    -average money spent per user
    -maybe product info

    ORder these by:
    Price
    
    
    Filter by:

    -Date


-->
<x-app-layout>
    <x-slot name="header">
        <div class="space-x-4">
            <!-- Pedidos pendentes this really needs a better option...-->
            <x-nav-link :href="route('statistics.index', ['filter' => 'Month'])" :active="request('status') === 'pending'">
                {{ __('Month') }}
            </x-nav-link>
            <x-nav-link :href="route('statistics.index', ['filter' => 'Year'])" :active="request('status') === 'pending'">
                {{ __('Year') }}
            </x-nav-link>
            <x-nav-link :href="route('statistics.index', ['filter' => 'Total'])" :active="request('status') === 'pending'">
                {{ __('Total') }}
            </x-nav-link>
            
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-black dark:bg-gray-800 shadow sm:rounded-lg">
                <h2 class="text-2xl pb-8 text-center font-semibold text-white">
                        {{ __('Statistics of ') . $judged }}<!-- Replace with dynamic user name and role  if needed -->
                    </h2>
                    <h2 class="text-lg pb-8 text-center font-semibold text-slate-400">
                        {{ $filter }}<!-- Replace with dynamic user name and role  if needed -->
                    </h2>
                    <div class="flex items-center gap-4 mb-4">
                    
                    
                    
                    </div>
                    <script src="table2excel.js"></script>
                    <script src="csv.min.js"></script>
                    <table id="Info" class="table-auto top-padding mx-auto w-1/2 border-A border-white dark:border-gray-700">

                        <tbody>
                                
                                <tr class="text-white bg-slate-700 rounded-lg border-b border-b-gray-600 dark:border-b-gray-500">
                                    <td class="px-2 py-2 text-left hidden lg:table-cell">{{ $str1 }}</td>
                                    <td class="px-2 py-2 bg-gray-900 text-left hidden lg:table-cell">{{ $resp1}}</td>
                                </tr>
                                <tr class="text-white bg-slate-700 rounded-lg border-b border-b-gray-600 dark:border-b-gray-500">
                                    <td class="px-2 py-2 text-left hidden lg:table-cell">{{ $str2 }}</td>
                                    <td class="px-2 py-2 bg-gray-900 text-left hidden lg:table-cell">{{ $resp2 }}</td>
                                </tr>
                                <tr class="text-white bg-slate-700  rounded-lg border-b border-b-gray-600 dark:border-b-gray-500">
                                    <td class="px-2 py-2 text-left hidden lg:table-cell">{{ $str3 }}</td>
                                    <td class="px-2 py-2 bg-gray-900 text-left hidden lg:table-cell">{{ $resp3 }}</td>
                                </tr>
                                <tr class="text-white bg-slate-700 rounded-lg border-b border-b-gray-600 dark:border-b-gray-500">
                                    <td class="px-2 py-2 text-left hidden lg:table-cell">{{ $str4 }}</td>
                                    <td class="px-2 py-2 bg-gray-900 text-left hidden lg:table-cell">{{ $resp4 }}</td>
                                </tr>                
                        </tbody>
                    </table>
                    <div class="flex justify-center pt-11 gap-4 mb-4 ">
                    
                        <button id="export-excel" class="inline-flex items-center px-4 py-2 bg-gray-700 text-white rounded-md hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                            {{ __('Export to Excel') }}
                        </button>
                    </div>
                    <script src="table2excel.js"></script>
                    <script>
                        document.getElementById("export-excel").addEventListener("click", function() {
                            var table2excel = new Table2Excel();
                            table2excel.export(document.querySelectorAll("#Info", ""));
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>