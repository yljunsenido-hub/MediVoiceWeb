<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

            <h2 class="text-slate-900 font-bold text-2xl leading-tight">
                {{ __('Elder Lists') }}
            </h2>

            <div class="w-full md:w-96">
                <x-search-bar
                    action="{{ route('admin.elder') }}"
                    placeholder="Search elder by name..."
                    name="search" />
            </div>

        </div>
    </x-slot>

    <div class="relative overflow-x-auto bg-white shadow-sm rounded-lg border border-gray-200 mt-4">
        <table class="w-full text-sm text-left text-gray-700">
            <thead class="bg-gray-100 border-b border-gray-200">
                <tr>
                    <th class="px-6 py-3 font-semibold text-gray-700">Name</th>
                    <th class="px-6 py-3 font-semibold text-gray-700">Age</th>
                    <th class="px-6 py-3 font-semibold text-gray-700">Birthday</th>
                    <th class="px-6 py-3 font-semibold text-gray-700">Gender</th>
                    <th class="px-6 py-3 font-semibold text-gray-700">Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach($data as $elderId => $elder)
                <tr class="odd:bg-white even:bg-gray-50 border-b border-gray-200 hover:bg-gray-100 transition">
                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                        {{ $elder['name'] ?? '' }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $elder['age'] ?? '' }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $elder['birthday'] ?? '' }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $elder['gender'] ?? '' }}
                    </td>
                    <td class="px-6 py-4 flex items-center gap-4">
                        <a href="{{ route('admin.elderInfo', $elderId) }}"
                            class="text-blue-600 hover:underline font-medium">
                            View
                        </a>

                        <a href="{{ route('admin.elder.edit', $elderId) }}"
                            class="text-green-600 hover:underline font-medium">
                            Edit
                        </a>

                        <x-delete-button
                            :route="route('admin.elder.delete', $elderId)"
                            message="Are you sure you want to delete this elder?" />
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @if($totalPages > 1)
    <nav class="flex justify-center mt-6">
        <ul class="flex -space-x-px text-sm">

            {{-- Previous --}}
            <li>
                <a href="{{ $currentPage > 1 
                ? request()->fullUrlWithQuery(['page' => $currentPage - 1]) 
                : '#' }}"
                    class="flex items-center justify-center w-9 h-9 border border-gray-300 
               {{ $currentPage == 1 
                    ? 'bg-gray-100 text-gray-400 cursor-not-allowed' 
                    : 'bg-white text-gray-700 hover:bg-gray-100' }}">
                    ‹
                </a>
            </li>

            {{-- Page Numbers --}}
            @for($i = 1; $i <= $totalPages; $i++)
                <li>
                <a href="{{ request()->fullUrlWithQuery(['page' => $i]) }}"
                    class="flex items-center justify-center w-9 h-9 border border-gray-300
                   {{ $currentPage == $i
                        ? 'bg-blue-600 text-white'
                        : 'bg-white text-gray-700 hover:bg-gray-100' }}">
                    {{ $i }}
                </a>
                </li>
                @endfor

                {{-- Next --}}
                <li>
                    <a href="{{ $currentPage < $totalPages 
                ? request()->fullUrlWithQuery(['page' => $currentPage + 1]) 
                : '#' }}"
                        class="flex items-center justify-center w-9 h-9 border border-gray-300
               {{ $currentPage == $totalPages 
                    ? 'bg-gray-100 text-gray-400 cursor-not-allowed' 
                    : 'bg-white text-gray-700 hover:bg-gray-100' }}">
                        ›
                    </a>
                </li>

        </ul>
    </nav>
    @endif
</x-app-layout>