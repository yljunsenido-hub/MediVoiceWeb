<x-app-layout>
    <div class="flex justify-end mb-4">
        <a href="{{ route('admin.nurse-list.create') }}"
            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
            Add Employee
        </a>
    </div>

    <div class="relative overflow-x-auto bg-white shadow-sm rounded-lg border border-gray-200 mt-4">
        <table class="w-full text-sm text-left text-gray-700">
            <thead class="bg-gray-100 border-b border-gray-200">
                <tr>
                    <th class="px-6 py-3 font-semibold text-gray-700">Employee ID</th>
                    <th class="px-6 py-3 font-semibold text-gray-700">First Name</th>
                    <th class="px-6 py-3 font-semibold text-gray-700">Middle Name</th>
                    <th class="px-6 py-3 font-semibold text-gray-700">Last Name</th>
                    <th class="px-6 py-3 font-semibold text-gray-700">Email</th>
                    <th class="px-6 py-3 font-semibold text-gray-700">Contact</th>
                </tr>
            </thead>

            <tbody>
                @if($nurses)
                @foreach($nurses as $id => $nurse)
                @if($nurse) <!-- skip null entries -->
                <tr class="odd:bg-white even:bg-gray-50 border-b border-gray-200 hover:bg-gray-100 transition">
                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">{{ $nurse['employee_number'] ?? '' }}</td>
                    <td class="px-6 py-4">{{ $nurse['first_name'] ?? '' }}</td>
                    <td class="px-6 py-4">{{ $nurse['middle_name'] ?? '' }}</td>
                    <td class="px-6 py-4">{{ $nurse['last_name'] ?? '' }}</td>
                    <td class="px-6 py-4">{{ $nurse['email'] ?? '' }}</td>
                    <td class="px-6 py-4">{{ $nurse['contact'] ?? '' }}</td>
                </tr>
                @endif
                @endforeach
                @else
                <tr>
                    <td colspan="6" class="text-center p-4">No nurses found</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</x-app-layout>