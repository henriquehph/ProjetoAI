<x-app-layout>
    <div class="container">
        <h2>Add Funds to Your Card</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @elseif(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form action="{{ url('/add-funds') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="amount">Amount to Add:</label>
                <input type="number" id="amount" name="amount" class="form-control" required min="1" step="any">
            </div>

            <input type="submit" value="Add Funds">
        </form>
    </div>
</x-app-layout>