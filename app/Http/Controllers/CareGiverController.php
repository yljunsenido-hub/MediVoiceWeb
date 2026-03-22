<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Factory;

class CareGiverController extends Controller
{
    private function database()
    {
        return (new Factory)
            ->withServiceAccount(storage_path('app/firebase/medivoice-92430-firebase-adminsdk-fbsvc-2900475cf8.json'))
            ->withDatabaseUri('https://medivoice-92430-default-rtdb.firebaseio.com')
            ->createDatabase();
    }

    public function getCaregivers(Request $request)
    {
        $database = $this->database();

        // Fetch all caregivers; ensure $data is always an array
        $data = $database->getReference('Caregiver')->getValue() ?? [];

        // Search caregivers
        $search = $request->search ?? '';
        if ($search) {
            $data = array_filter($data, function ($careGiver) use ($search) {
                return (isset($careGiver['firstName']) && stripos($careGiver['firstName'], $search) !== false) ||
                    (isset($careGiver['lastName']) && stripos($careGiver['lastName'], $search) !== false) ||
                    (isset($careGiver['age']) && stripos($careGiver['age'], $search) !== false) ||
                    (isset($careGiver['shift']) && stripos($careGiver['shift'], $search) !== false);
            });
        }

        // Pagination
        $perPage = 5;
        $currentPage = max(1, (int) $request->get('page', 1));
        $total = count($data);
        $totalPages = (int) ceil($total / $perPage);

        $offset = ($currentPage - 1) * $perPage;
        $data = array_slice($data, $offset, $perPage, true);

        return view('admin.caregiver', compact(
            'data',
            'search',
            'currentPage',
            'totalPages'
        ));
    }

    public function careGiverInfo($id)
    {
        $database = $this->database();
        $careGiver = $database->getReference('Caregiver/' . $id)->getValue();

        if (!$careGiver) {
            abort(404);
        }

        $observations = $careGiver['Observations'] ?? [];
        $prescriptions = $careGiver['Prescriptions'] ?? [];

        return view('admin.caregiverInfo', compact(
            'careGiver',
            'observations',
            'prescriptions'
        ));
    }

    public function edit($id)
    {
        $database = $this->database();
        $careGiver = $database->getReference('Caregiver/' . $id)->getValue();

        if (!$careGiver) {
            abort(404);
        }

        $observations = $careGiver['Observations'] ?? [];
        $prescriptions = $careGiver['Prescriptions'] ?? [];

        return view('admin.caregiverInfoEdit', compact(
            'careGiver',
            'observations',
            'prescriptions',
            'id'
        ));
    }

    public function update(Request $request, $id)
    {
        $database = $this->database();

        $database->getReference('Caregiver/' . $id)->update([
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'age' => $request->age,
            'contactNumber' => $request->contactNumber,
            'shift' => $request->shift,
            'email' => $request->email,
        ]);

        return redirect()
            ->route('admin.caregiverInfo', $id)
            ->with('success', 'Caregiver updated successfully.');
    }

    public function deleteRecord($caregiverId, $prescriptionId = null, $observationId = null)
    {
        $database = $this->database();

        if ($prescriptionId) {
            $database->getReference("Caregiver/$caregiverId/Prescriptions/$prescriptionId")
                ->remove();
        }

        if ($observationId) {
            $database->getReference("Caregiver/$caregiverId/Observations/$observationId")
                ->remove();
        }

        return back()->with('success', 'Record deleted successfully');
    }
}
