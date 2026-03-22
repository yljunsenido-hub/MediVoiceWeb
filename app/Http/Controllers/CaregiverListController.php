<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Factory;

class CaregiverListController extends Controller
{
    private function database()
    {
        $factory = (new Factory)
            ->withServiceAccount(storage_path('app/firebase/medivoice-92430-firebase-adminsdk-fbsvc-2900475cf8.json'))
            ->withDatabaseUri('https://medivoice-92430-default-rtdb.firebaseio.com');

        return $factory->createDatabase();
    }

    public function getCaregiverLists()
    {
        $database = $this->database();

        $caregivers  = $database
            ->getReference('Employees/Caregivers')
            ->getValue();

        return view('admin.caregiverList', compact('caregivers'));
    }
    public function create()
    {
        return view('admin.caregiverListCreate'); // <-- your form Blade
    }

    public function store(Request $request)
    {
        $database = $this->database();

        $counterRef = $database->getReference('Counters/caregiver_id');

        $currentId = $counterRef->getValue() ?? 0;

        if (!$currentId) {
            $currentId = 0;
        }

        $newId = $currentId + 1;

        $year = date('y');

        $employeeNumber = 'CG' . $year . str_pad($newId, 3, '0', STR_PAD_LEFT);

        $caregiverData = [
            'employee_number' => $employeeNumber,
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'contact' => $request->contact,
            'created_at' => now()->toDateTimeString()
        ];

        $database
            ->getReference('Employees/Caregivers/' . $newId)
            ->set($caregiverData);

        $counterRef->set($newId);

        return redirect()
            ->route('admin.caregiver-list')
            ->with('success', 'Caregiver added successfully.');
    }
}
