<x-app-layout>
    <x-slot name="header">
        <h2 class="text-slate-900 font-bold text-2xl leading-tight">
            {{ __('Elder Information') }}
        </h2>
    </x-slot>

    <x-profile-info-table
        title="Personal Information"
        :fields="[
        'Name' => $elder['name'] ?? '',
        'Gender' => $elder['gender'] ?? '',
        'Age' => $elder['age'] ?? '',
        'Birthday' => $elder['birthday'] ?? '',
        'Civil Status' => $elder['civilStatus'] ?? '',
        'Home Address' => $elder['homeAddress'] ?? '',
    ]" />

    <x-profile-info-table
        title="Health Information"
        :fields="[
        'Cognitive Status' => $elder['cognitiveStatus'] ?? '',
        'Allergies' => $elder['allergies'] ?? '',
        'Disabilities' => $elder['disabilities'] ?? '',
    ]" />

    <x-profile-info-table
        title="Primary Contact Information"
        :fields="[
        'Contact Person' => $elder['primaryContactPerson'] ?? '',
        'Contact Number' => $elder['primaryContactNumber'] ?? '',
        'Relationship' => $elder['primaryRelationship'] ?? '',
    ]" />

    <x-profile-info-table
        title="Secondary Contact Information"
        :fields="[
        'Contact Person' => $elder['secondaryContactPerson'] ?? '',
        'Contact Number' => $elder['secondaryContactNumber'] ?? '',
        'Relationship' => $elder['secondaryRelationship'] ?? '',
    ]" />


</x-app-layout>