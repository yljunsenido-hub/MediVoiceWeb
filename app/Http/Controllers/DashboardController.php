<?php

namespace App\Http\Controllers;

use Kreait\Firebase\Factory;

class DashboardController extends Controller
{
    public function getUsers()
    {
        $factory = (new Factory)
            ->withServiceAccount(storage_path('app/firebase/firebase.json'))
            ->withDatabaseUri('https://medivoice-92430-default-rtdb.firebaseio.com');

        $database = $factory->createDatabase();

        $caregivers = $database->getReference('Caregiver')->getValue() ?? [];
        $elders = $database->getReference('Elders')->getValue() ?? [];
        $nurse = $database->getReference('Nurse')->getValue() ?? [];
        $notes = $database->getReference('RunningNotes')->getValue() ?? [];

        $totalCaregivers = count($caregivers);
        $totalElders = count($elders);
        $totalNurse = count($nurse);
        $totalNotes = count($notes);

        $notesByDate = [];
        $observationsByDate = [];
        $prescriptionsByDate = [];

        foreach ($notes as $note) {
            if (!empty($note['timestamp'])) {
                $date = date('Y-m-d', strtotime($note['timestamp']));
                $notesByDate[$date] = ($notesByDate[$date] ?? 0) + 1;
            }
        }

        $totalObservations = 0;
        $totalPrescriptions = 0;

        foreach ($caregivers as $caregiver) {

            if (!empty($caregiver['Observations'])) {
                foreach ($caregiver['Observations'] as $observation) {
                    $totalObservations++;

                    if (!empty($observation['timestamp'])) {
                        $date = date('Y-m-d', strtotime($observation['timestamp']));
                        $observationsByDate[$date] = ($observationsByDate[$date] ?? 0) + 1;
                    }
                }
            }

            if (!empty($caregiver['Prescriptions'])) {
                foreach ($caregiver['Prescriptions'] as $prescription) {
                    $totalPrescriptions++;

                    if (!empty($prescription['timestamp'])) {
                        $date = date('Y-m-d', strtotime($prescription['timestamp']));
                        $prescriptionsByDate[$date] = ($prescriptionsByDate[$date] ?? 0) + 1;
                    }
                }
            }
        }

        ksort($prescriptionsByDate);
        ksort($observationsByDate);
        ksort($notesByDate);

        $prescriptionLabels = array_keys($prescriptionsByDate);
        $prescriptionData = array_values($prescriptionsByDate);

        $observationLabels = array_keys($observationsByDate);
        $observationData = array_values($observationsByDate);

        $notesLabels = array_keys($notesByDate);
        $notesData = array_values($notesByDate);

        return view('admin.dashboard', compact(
            'totalCaregivers',
            'totalElders',
            'totalNurse',
            'totalObservations',
            'totalPrescriptions',
            'totalNotes',
            'prescriptionLabels',
            'prescriptionData',
            'observationLabels',
            'observationData',
            'notesLabels',
            'notesData'
        ));
    }
}
