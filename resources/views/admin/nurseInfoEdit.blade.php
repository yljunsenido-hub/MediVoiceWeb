<x-app-layout>
    <x-slot name="header">
        <h2 class="text-slate-900 font-bold text-2xl leading-tight">
            {{ __('Nurse Information Edit') }}
        </h2>
    </x-slot>

    <form method="POST" action="{{ route('admin.nurse.update', $id) }}">
        @csrf
        @method('PUT')

        <x-profile-info-table-edit
            title="Personal Information"
            :fields="[
                'employeeNumber' => ['label' => 'Employee Number', 'value' => $nurse['employeeNumber'] ?? ''], 
                'firstName' => ['label' => 'First Name', 'value' => $nurse['firstName'] ?? ''],
                'lastName' => ['label' => 'Last Name', 'value' => $nurse['lastName'] ?? ''],
                'age' => ['label' => 'Age', 'value' => $nurse['age'] ?? ''],
                'contactNumber' => ['label' => 'Contact Number', 'value' => $nurse['contactNumber'] ?? ''],
                'shift' => ['label' => 'Shift', 'value' => $nurse['shift'] ?? ''],
                'email' => ['label' => 'Email', 'value' => $nurse['email'] ?? ''],
            ]" />
        <button type="submit"
            class="mt-2 text-white bg-blue-700 px-4 py-2 rounded-lg font-semibold">
            Update
        </button>
    </form>
</x-app-layout>