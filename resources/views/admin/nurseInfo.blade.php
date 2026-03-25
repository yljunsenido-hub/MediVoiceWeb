<x-app-layout>
    <x-slot name="header">
        <h2 class="text-slate-900 font-bold text-2xl leading-tight">
            {{ __('Nurse Information') }}
        </h2>
    </x-slot>

    <x-profile-info-table
        title="Personal Information"
        :fields="[
        'Employee No.' => $nurse['employeeNumber'] ?? '',
        'First Name' => $nurse['firstName'] ?? '',
        'Last Name' => $nurse['lastName'] ?? '',
        'Age' => $nurse['age'] ?? '',
        'Contact Number' => $nurse['contactNumber'] ?? '',
        'Role' => $nurse['role'] ?? '',
        'Shift' => $nurse['shift'] ?? '',
        'Email' => $nurse['email'] ?? '',
    ]" />
</x-app-layout>