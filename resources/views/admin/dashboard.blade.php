<x-app-layout>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">

        <x-dashboard-card
            title="Total Elders"
            :value="$totalElders" />

        <x-dashboard-card
            title="Total Caregivers"
            :value="$totalCaregivers" />

        <x-dashboard-card
            title="Total Nurse"
            :value="$totalNurse" />

        <x-dashboard-card
            title="Total Notes"
            :value="$totalNotes" />

        <x-dashboard-card
            title="Total Prescriptions"
            :value="$totalPrescriptions" />

        <x-dashboard-card
            title="Total Observations"
            :value="$totalObservations" />

    </div>


    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        <x-chart
            title="Prescription Report"
            chartId="prescriptionChart"
            :labels="$prescriptionLabels"
            :data="$prescriptionData" />

        <x-chart
            title="Observation Report"
            chartId="observationChart"
            :labels="$observationLabels"
            :data="$observationData"
            type="bar" />

        <div class="lg:col-span-2">
            <x-chart
                title="Running Notes Report"
                chartId="noteChart"
                :labels="$notesLabels"
                :data="$notesData" />
        </div>

    </div>

</x-app-layout>