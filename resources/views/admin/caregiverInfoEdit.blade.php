<x-app-layout>

    <x-slot name="header">
        <h2 class="text-slate-900 font-bold text-2xl leading-tight">
            Caregiver Information Edit
        </h2>
    </x-slot>
    <form method="POST"
        action="{{ route('admin.caregiver.update', $id) }}">

        @csrf
        @method('PUT')

        <x-profile-info-table-edit
            title="Personal Information"
            :fields="[
            'employeeNumber' => ['label' => 'Employee Number', 'value' => $careGiver['employeeNumber'] ?? ''],
            'firstName' => ['label' => 'First Name', 'value' => $careGiver['firstName'] ?? ''],
            'lastName' => ['label' => 'Last Name', 'value' => $careGiver['lastName'] ?? ''],
            'age' => ['label' => 'Age', 'value' => $careGiver['age'] ?? ''],
            'contactNumber' => ['label' => 'Contact Number', 'value' => $careGiver['contactNumber'] ?? ''],
            'shift' => ['label' => 'Shift', 'value' => $careGiver['shift'] ?? ''],
            'email' => ['label' => 'Email', 'value' => $careGiver['email'] ?? ''],
        ]" />

        <button type="submit"
            class="mb-6 text-white bg-blue-700 px-4 py-2 rounded-lg text-sm">
            Update Personal Info
        </button>

    </form>

    @foreach($observations as $observationId => $observation)

    <div class="bg-white py-6 px-6 rounded-xl shadow-sm mb-6">

        <h3 class="text-lg font-semibold mb-4">
            Observation
        </h3>

        <x-delete-button
            :route="route('admin.caregiver.observation.delete', [
        'caregiverId' => $id,
        'observationId' => $observationId
    ])"
            message="Delete this observation?"
            buttonClass="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded-lg text-sm"
            confirmClass="px-4 py-2 rounded-lg bg-red-700 text-white hover:bg-red-800" />


        <div class="grid gap-6 md:grid-cols-2">

            <div>
                <label class="block mb-2 text-sm font-medium text-gray-700">
                    Elder
                </label>

                <input type="text"
                    name="observations[{{ $observationId }}][elderName]"
                    value="{{ $observation['elderName'] ?? '' }}"
                    class="bg-gray-100 border border-gray-300 rounded-lg w-full px-3 py-2" />
            </div>

            <div>
                <label class="block mb-2 text-sm font-medium text-gray-700">
                    Nurse
                </label>

                <input type="text"
                    name="observations[{{ $observationId }}][nurseName]"
                    value="{{ $observation['nurseName'] ?? '' }}"
                    class="bg-gray-100 border border-gray-300 rounded-lg w-full px-3 py-2" />
            </div>

            <div>
                <label class="block mb-2 text-sm font-medium text-gray-700">
                    Schedule
                </label>

                <input type="text"
                    name="observations[{{ $observationId }}][monitoringSchedule]"
                    value="{{ $observation['monitoringSchedule'] ?? '' }}"
                    class="bg-gray-100 border border-gray-300 rounded-lg w-full px-3 py-2" />
            </div>

        </div>

    </div>

    @endforeach


    @foreach($prescriptions as $prescriptionId => $prescription)

    <div class="bg-white py-6 px-6 rounded-xl shadow-sm mb-6">

        <h3 class="text-lg font-semibold mb-4">
            Prescription
        </h3>

        <x-delete-button
            :route="route('admin.caregiver.prescription.delete', [
        'caregiverId' => $id,
        'prescriptionId' => $prescriptionId
    ])"
            message="Delete this prescription?"
            buttonClass="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded-lg text-sm"
            confirmClass="px-4 py-2 rounded-lg bg-red-700 text-white hover:bg-red-800" />


        <div class="grid gap-6 md:grid-cols-2">

            <div>
                <label class="block mb-2 text-sm font-medium text-gray-700">
                    Medication
                </label>

                <input type="text"
                    name="prescriptions[{{ $prescriptionId }}][medicationName]"
                    value="{{ $prescription['medicationName'] ?? '' }}"
                    class="bg-gray-100 border border-gray-300 rounded-lg w-full px-3 py-2" />
            </div>

            <div>
                <label class="block mb-2 text-sm font-medium text-gray-700">
                    Elder
                </label>

                <input type="text"
                    name="prescriptions[{{ $prescriptionId }}][elderName]"
                    value="{{ $prescription['elderName'] ?? '' }}"
                    class="bg-gray-100 border border-gray-300 rounded-lg w-full px-3 py-2" />
            </div>

            <div>
                <label class="block mb-2 text-sm font-medium text-gray-700">
                    Nurse
                </label>

                <input type="text"
                    name="prescriptions[{{ $prescriptionId }}][nurseName]"
                    value="{{ $prescription['nurseName'] ?? '' }}"
                    class="bg-gray-100 border border-gray-300 rounded-lg w-full px-3 py-2" />
            </div>

            <div>
                <label class="block mb-2 text-sm font-medium text-gray-700">
                    Dosage
                </label>

                <input type="text"
                    name="prescriptions[{{ $prescriptionId }}][dosage]"
                    value="{{ $prescription['dosage'] ?? '' }}"
                    class="bg-gray-100 border border-gray-300 rounded-lg w-full px-3 py-2" />
            </div>

            <div>
                <label class="block mb-2 text-sm font-medium text-gray-700">
                    Time
                </label>

                <input type="text"
                    name="prescriptions[{{ $prescriptionId }}][time]"
                    value="{{ $prescription['time'] ?? '' }}"
                    class="bg-gray-100 border border-gray-300 rounded-lg w-full px-3 py-2" />
            </div>

        </div>

    </div>

    @endforeach

</x-app-layout>