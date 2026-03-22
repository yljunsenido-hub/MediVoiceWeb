<x-app-layout>
    <div class="flex justify-end mb-4">
        <a href="{{ route('admin.caregiver-list.create') }}"
            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
            Add Employee
        </a>
    </div>

    <table class="w-full border">
        <thead>
            <tr class="bg-gray-100">
                <th class="border p-2">Employee ID</th>
                <th class="border p-2">First Name</th>
                <th class="border p-2">Middle Name</th>
                <th class="border p-2">Last Name</th>
                <th class="border p-2">Email</th>
                <th class="border p-2">Contact</th>
            </tr>
        </thead>

        <tbody>
            @if($caregivers)
            @foreach($caregivers as $id => $caregiver)
            <tr>
                <td class="border p-2 text-center">{{ $caregiver['employee_number'] ?? '' }}</td>
                <td class="border p-2 text-center">{{ $caregiver['first_name'] ?? '' }}</td>
                <td class="border p-2 text-center">{{ $caregiver['middle_name'] ?? '' }}</td>
                <td class="border p-2 text-center">{{ $caregiver['last_name'] ?? '' }}</td>
                <td class="border p-2 text-center">{{ $caregiver['email'] ?? '' }}</td>
                <td class="border p-2 text-center">{{ $caregiver['contact'] ?? '' }}</td>
            </tr>
            @endforeach
            @else
            <tr>
                <td colspan="3" class="text-center p-4">No caregivers found</td>
            </tr>
            @endif
        </tbody>
    </table>
</x-app-layout>