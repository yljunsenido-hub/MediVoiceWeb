@props([
'fields',
'title' => 'Personal Info'
])

<div class="bg-white py-6 px-6 rounded-xl shadow-sm mb-6">

    <h3 class="text-lg font-semibold text-gray-800 mb-4">
        {{ $title }}
    </h3>

    <div class="grid gap-6 md:grid-cols-2">

        @foreach($fields as $name => $field)

        <div>
            <label for="{{ $name }}"
                class="block mb-2 text-sm font-medium text-gray-700">
                {{ $field['label'] }}
            </label>

            <input
                type="text"
                name="{{ $name }}"
                id="{{ $name }}"
                value="{{ $field['value'] ?? '' }}"
                class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full px-3 py-2 shadow-sm"
                required />
        </div>

        @endforeach

    </div>
</div>