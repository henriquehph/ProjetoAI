<x-app-layout>
    <div class="py-12"> 
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="text-gray-700 dark:text-gray-400 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                
                    <h2>Add Funds to Your Card</h2>

                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @elseif(session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif
                    <form action="{{ url('/add-funds') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label class="" for="amount">Amount to Add:</label>
                            <input type="number" id="amount" name="amount" class="form-control" required min="1" step="any">
                        </div>

                        <input type="submit" value="Add Funds">
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>