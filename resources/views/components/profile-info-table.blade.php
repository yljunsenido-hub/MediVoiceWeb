@props([
'fields',
'title' => 'Personal Info'
])

<div class="bg-white rounded-xl shadow border border-gray-300 overflow-hidden mb-6">

    {{-- Heading --}}
    <div class="px-6 py-4 border-b border-gray-300 bg-gray-50">
        <h3 class="text-lg font-semibold text-gray-800">
            {{ $title }}
        </h3>
    </div>

    {{-- Table --}}
    <table class="w-full border-collapse">
        @foreach($fields as $label => $value)
        <tr class="border-b border-gray-300 last:border-b-0">
            <td class="px-6 py-3 font-medium text-gray-800 w-1/3 border-r border-gray-300 bg-gray-50">
                {{ $label }}
            </td>
            <td class="px-6 py-3 text-gray-800">
                {{ $value ?? '' }}
            </td>
        </tr>
        @endforeach
    </table>

</div>