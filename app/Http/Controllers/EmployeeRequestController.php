<?php

namespace App\Http\Controllers;

use Kreait\Firebase\Factory;
use Illuminate\Http\Request;

class EmployeeRequestController extends Controller
{
    private function firebase()
    {
        return (new Factory)
            ->withServiceAccount(storage_path('app/firebase/medivoice-92430-firebase-adminsdk-fbsvc-2900475cf8.json'))
            ->withDatabaseUri('https://medivoice-92430-default-rtdb.firebaseio.com');
    }

    // Fetch all nurse and caregiver requests
    public function getEmployeeRequests()
    {
        $database = $this->firebase()->createDatabase();

        $nurseRequests = $database
            ->getReference('Employee_Request/nurse')
            ->getValue() ?? [];

        $caregiverRequests = $database
            ->getReference('Employee_Request/caregiver')
            ->getValue() ?? [];

        return view('admin.employeeRequest', compact('nurseRequests', 'caregiverRequests'));
    }

    // Approve employee (nurse or caregiver)
    public function approveEmployee($role, $id)
    {
        $firebase = $this->firebase();
        $database = $firebase->createDatabase();
        $auth = $firebase->createAuth();

        $request = $database
            ->getReference('Employee_Request/' . $role . '/' . $id)
            ->getValue();

        if (!$request) {
            return back()->with('error', 'Request not found');
        }

        // Create Firebase Auth user
        $user = $auth->createUser([
            'email' => $request['email'],
            'password' => $request['password']
        ]);

        // Save to Nurse or Caregiver
        $database
            ->getReference(ucfirst($role) . '/' . $user->uid)
            ->set([
                'employeeNumber' => $request['employeeNumber'],
                'firstName' => $request['firstName'],
                'lastName' => $request['lastName'],
                'age' => $request['age'],
                'contactNumber' => $request['contactNumber'],
                'shift' =>  $request['shift'],
                'email' => $request['email'],
                'role' => $role
            ]);

        // Remove from pending requests
        $database
            ->getReference('Employee_Request/' . $role . '/' . $id)
            ->remove();

        return back()->with('success', ucfirst($role) . ' approved');
    }

    // Reject employee request
    public function rejectEmployee($role, $id)
    {
        $database = $this->firebase()->createDatabase();

        $database
            ->getReference('Employee_Request/' . $role . '/' . $id)
            ->remove();

        return back()->with('success', ucfirst($role) . ' request rejected');
    }
}
