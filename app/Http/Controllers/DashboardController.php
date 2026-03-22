<?php

namespace App\Http\Controllers;

use Kreait\Firebase\Factory;

class DashboardController extends Controller
{
    public function getUsers()
    {
        $factory = (new Factory)
            ->withServiceAccount(storage_path('app/firebase/medivoice-92430-firebase-adminsdk-fbsvc-2900475cf8.json'))
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

        /*
        |--------------------------------------------------------------------------
        | Chart Data Containers
        |--------------------------------------------------------------------------
        */

        $notesByDate = [];
        $observationsByDate = [];
        $prescriptionsByDate = [];

        /*
        |--------------------------------------------------------------------------
        | Running Notes Chart Aggregation
        |--------------------------------------------------------------------------
        */

        foreach ($notes as $note) {

            if (!empty($note['timestamp'])) {

                $date = date('Y-m-d', strtotime($note['timestamp']));

                if (!isset($notesByDate[$date])) {
                    $notesByDate[$date] = 0;
                }

                $notesByDate[$date]++;
            }
        }

        /*
        |--------------------------------------------------------------------------
        | Caregiver Observations + Prescriptions Aggregation
        |--------------------------------------------------------------------------
        */

        $totalObservations = 0;
        $totalPrescriptions = 0;

        foreach ($caregivers as $caregiver) {

            if (!empty($caregiver['Observations'])) {

                foreach ($caregiver['Observations'] as $observation) {

                    $totalObservations++;

                    if (!empty($observation['timestamp'])) {

                        $date = date('Y-m-d', strtotime($observation['timestamp']));

                        if (!isset($observationsByDate[$date])) {
                            $observationsByDate[$date] = 0;
                        }

                        $observationsByDate[$date]++;
                    }
                }
            }

            if (!empty($caregiver['Prescriptions'])) {

                foreach ($caregiver['Prescriptions'] as $prescription) {

                    $totalPrescriptions++;

                    if (!empty($prescription['timestamp'])) {

                        $date = date('Y-m-d', strtotime($prescription['timestamp']));

                        if (!isset($prescriptionsByDate[$date])) {
                            $prescriptionsByDate[$date] = 0;
                        }

                        $prescriptionsByDate[$date]++;
                    }
                }
            }
        }

        /*
        |--------------------------------------------------------------------------
        | Sort Chart Data
        |--------------------------------------------------------------------------
        */

        ksort($prescriptionsByDate);
        ksort($observationsByDate);
        ksort($notesByDate);

        /*
        |--------------------------------------------------------------------------
        | Chart Labels + Dataset
        |--------------------------------------------------------------------------
        */

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
