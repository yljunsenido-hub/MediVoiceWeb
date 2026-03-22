<x-app-layout>
    <x-slot name="header">
        <h2 class="text-slate-900 font-bold text-2xl leading-tight">
            {{ __('Elder Information Edit') }}
        </h2>
    </x-slot>

    <form method="POST" action="{{ route('admin.elder.update', $id) }}">
        @csrf
        @method('PUT')

        <x-profile-info-table-edit
            title="Personal Information"
            :fields="[
        'name' => ['label' => 'Name', 'value' => $elder['name'] ?? ''],
        'gender' => ['label' => 'Gender', 'value' => $elder['gender'] ?? ''],
        'age' => ['label' => 'Age', 'value' => $elder['age'] ?? ''],
        'birthday' => ['label' => 'Birthday', 'value' => $elder['birthday'] ?? ''],
        'civilStatus' => ['label' => 'Civil Status', 'value' => $elder['civilStatus'] ?? ''],
        'homeAddress' => ['label' => 'Home Address', 'value' => $elder['homeAddress'] ?? ''],
    ]" />

        <x-profile-info-table-edit
            title="Health Information"
            :fields="[
        'cognitiveStatus' => ['label' => 'Cognitive Status', 'value' => $elder['cognitiveStatus'] ?? ''],
        'allergies' => ['label' => 'Allergies', 'value' => $elder['allergies'] ?? ''],
        'disabilities' => ['label' => 'Disabilities', 'value' => $elder['disabilities'] ?? ''],
    ]" />

        <x-profile-info-table-edit
            title="Primary Contact Information"
            :fields="[
        'primaryContactPerson' => ['label' => 'Contact Person', 'value' => $elder['primaryContactPerson'] ?? ''],
        'primaryContactNumber' => ['label' => 'Contact Number', 'value' => $elder['primaryContactNumber'] ?? ''],
        'primaryRelationship' => ['label' => 'Relationship', 'value' => $elder['primaryRelationship'] ?? ''],
    ]" />

        <x-profile-info-table-edit
            title="Secondary Contact Information"
            :fields="[
        'secondaryContactPerson' => ['label' => 'Contact Person', 'value' => $elder['secondaryContactPerson'] ?? ''],
        'secondaryContactNumber' => ['label' => 'Contact Number', 'value' => $elder['secondaryContactNumber'] ?? ''],
        'secondaryRelationship' => ['label' => 'Relationship', 'value' => $elder['secondaryRelationship'] ?? ''],
    ]" />


        <button type="submit"
            class="mt-2 text-white bg-blue-700 px-4 py-2 rounded-lg font-semibold">
            Update
        </button>
    </form>
</x-app-layout>