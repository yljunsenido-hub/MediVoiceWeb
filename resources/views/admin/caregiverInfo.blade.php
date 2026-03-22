<x-app-layout>
    <x-slot name="header">
        <h2 class="text-slate-900 font-bold text-2xl leading-tight">
            {{ __('Caregiver Information') }}
        </h2>
    </x-slot>

    <x-profile-info-table
        title="Personal Information"
        :fields="[
        'First Name' => $careGiver['firstName'] ?? '',
        'Last Name' => $careGiver['lastName'] ?? '',
        'Age' => $careGiver['age'] ?? '',
        'Contact Number' => $careGiver['contactNumber'] ?? '',
        'Shift' => $careGiver['shift'] ?? '',
        'Email' => $careGiver['email'] ?? '',
    ]" />

    <div class="bg-white rounded-xl shadow border border-gray-300 overflow-hidden mb-6">

        <div class="px-6 py-4 border-b border-gray-300 bg-gray-50">
            <h3 class="text-lg font-semibold text-gray-800">
                Observations
            </h3>
        </div>

        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-300">
                    <th class="px-6 py-3 text-left border-r border-gray-300">Elder</th>
                    <th class="px-6 py-3 text-left border-r border-gray-300">Nurse</th>
                    <th class="px-6 py-3 text-left border-r border-gray-300">Schedule</th>
                    <th class="px-6 py-3 text-left">Timestamp</th>
                </tr>
            </thead>
            <tbody>
                @forelse($observations as $observation)
                <tr class="border-b border-gray-300 last:border-b-0">
                    <td class="px-6 py-3 border-r border-gray-300">
                        {{ $observation['elderName'] ?? '' }}
                    </td>
                    <td class="px-6 py-3 border-r border-gray-300">
                        {{ $observation['nurseName'] ?? '' }}
                    </td>
                    <td class="px-6 py-3 border-r border-gray-300">
                        {{ $observation['monitoringSchedule'] ?? '' }}
                    </td>
                    <td class="px-6 py-3">
                        {{ $observation['timestamp'] ?? '' }}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                        No observations
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

    </div>

    <div class="bg-white rounded-xl shadow border border-gray-300 overflow-hidden mb-6">

        <div class="px-6 py-4 border-b border-gray-300 bg-gray-50">
            <h3 class="text-lg font-semibold text-gray-800">
                Prescriptions
            </h3>
        </div>

        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-300">
                    <th class="px-6 py-3 border-r border-gray-300">Medication</th>
                    <th class="px-6 py-3 border-r border-gray-300">Elder</th>
                    <th class="px-6 py-3 border-r border-gray-300">Nurse</th>
                    <th class="px-6 py-3 border-r border-gray-300">Dosage</th>
                    <th class="px-6 py-3 border-r border-gray-300">Time</th>
                    <th class="px-6 py-3">Timestamp</th>
                </tr>
            </thead>
            <tbody>
                @forelse($prescriptions as $prescription)
                <tr class="border-b border-gray-300 last:border-b-0">
                    <td class="px-6 py-3 border-r border-gray-300">
                        {{ $prescription['medicationName'] ?? '' }}
                    </td>
                    <td class="px-6 py-3 border-r border-gray-300">
                        {{ $prescription['elderName'] ?? '' }}
                    </td>
                    <td class="px-6 py-3 border-r border-gray-300">
                        {{ $prescription['nurseName'] ?? '' }}
                    </td>
                    <td class="px-6 py-3 border-r border-gray-300">
                        {{ $prescription['dosage'] ?? '' }}
                    </td>
                    <td class="px-6 py-3 border-r border-gray-300">
                        {{ $prescription['time'] ?? '' }}
                    </td>
                    <td class="px-6 py-3">
                        {{ $prescription['timestamp'] ?? '' }}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                        No prescriptions
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

    </div>
</x-app-layout>