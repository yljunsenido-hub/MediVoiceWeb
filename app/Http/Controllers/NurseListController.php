<?php

namespace App\Http\Controllers;

use Kreait\Firebase\Factory;
use Illuminate\Http\Request;

class NurseListController extends Controller
{
    private function database()
    {
        $factory = (new Factory)
            ->withServiceAccount(storage_path('app/firebase/medivoice-92430-firebase-adminsdk-fbsvc-2900475cf8.json'))
            ->withDatabaseUri('https://medivoice-92430-default-rtdb.firebaseio.com');

        return $factory->createDatabase();
    }

    public function getNurseLists()
    {
        $database = $this->database();

        $nurses = $database
            ->getReference('Employees/Nurses')
            ->getValue();

        return view('admin.nurseList', compact('nurses'));
    }
    public function create()
    {
        return view('admin.nurseListCreate'); // <-- your form Blade
    }

    public function store(Request $request)
    {
        $database = $this->database();

        $counterRef = $database->getReference('Counters/nurse_id');

        $currentId = $counterRef->getValue() ?? 0;

        if (!$currentId) {
            $currentId = 0;
        }

        $newId = $currentId + 1;

        $year = date('y');

        $employeeNumber = 'N' . $year . str_pad($newId, 3, '0', STR_PAD_LEFT);

        $nurseData = [
            'employee_number' => $employeeNumber,
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'contact' => $request->contact,
            'created_at' => now()->toDateTimeString()
        ];

        $database
            ->getReference('Employees/Nurses/' . $newId)
            ->set($nurseData);

        $counterRef->set($newId);

        return redirect()
            ->route('admin.nurse-list')
            ->with('success', 'Nurse added successfully.');
    }
}
