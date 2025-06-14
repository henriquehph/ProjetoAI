@if (session('success'))
    <div class="text-green-600 mb-4">{{ session('success') }}</div>
@endif

@if ($errors->has('payment'))
    <div class="text-red-600 mb-4">{{ $errors->first('payment') }}</div>
@endif

<form action="{{ $action }}" method="POST">
    @csrf

    <label for="amount">Amount to add:</label>
    <input
        type="number"
        name="amount"
        id="amount"
        min="1"
        value="{{ old('amount') }}"
        required
    />

    <br><br>

    @foreach ($inputs as $input)
        <x-form-input 
            :name="$input['name']" 
            :type="$input['type'] ?? 'text'" 
            :placeholder="$input['placeholder'] ?? ''"
            :value="old($input['name'], $input['value'] ?? '')" 
        />
    @endforeach

    <x-submit-button :text="$buttonText" type="primary" />
</form>