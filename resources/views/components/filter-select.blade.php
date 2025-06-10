@props([
    'name',
    'label' => '',
    'options' => [],
])

<div class="relative">
  <select
    name="{{ $name }}"
    class="rounded-full border border-gray-300 py-2 px-4 pr-10 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 transition w-56"
  >
    {{-- Default empty option --}}
    <option value="">{{ $label }}</option>

    @foreach ($options as $val => $text)
      <option value="{{ $val }}" {{ request($name) == (string) $val ? 'selected' : '' }}>
        {{ $text }}
      </option>
    @endforeach
  </select>
</div>