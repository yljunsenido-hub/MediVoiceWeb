<!DOCTYPE html>
<html>
<head>
    <title>Caregivers</title>
</head>
<body>

<h1>Caregivers List</h1>

@foreach($data as $caregiverId => $caregiver)

    <hr>
    <h2>{{ $caregiver['firstName'] ?? '' }} {{ $caregiver['lastName'] ?? '' }}</h2>
    <p>Email: {{ $caregiver['email'] ?? '' }}</p>
    <p>Shift: {{ $caregiver['shift'] ?? '' }}</p>
    <p>Age: {{ $caregiver['age'] ?? '' }}</p>

    {{-- Observations --}}
    @if(isset($caregiver['Observations']))
        <h3>Observations</h3>
        <ul>
            @foreach($caregiver['Observations'] as $obs)
                <li>
                    Elder: {{ $obs['elderName'] ?? '' }} |
                    Nurse: {{ $obs['nurseName'] ?? '' }} |
                    Time: {{ $obs['timestamp'] ?? '' }}
                </li>
            @endforeach
        </ul>
    @endif

    {{-- Prescriptions --}}
    @if(isset($caregiver['Prescriptions']))
        <h3>Prescriptions</h3>
        <ul>
            @foreach($caregiver['Prescriptions'] as $prescription)
                <li>
                    {{ $prescription['medicationName'] ?? '' }}
                    ({{ $prescription['dosage'] ?? '' }}) |
                    Elder: {{ $prescription['elderName'] ?? '' }} |
                    Time: {{ $prescription['time'] ?? '' }}
                </li>
            @endforeach
        </ul>
    @endif

@endforeach

</body>
</html>
