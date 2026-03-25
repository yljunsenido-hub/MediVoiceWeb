<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Factory;

class NurseController extends Controller
{
    private function database()
    {
        return (new Factory)
            ->withServiceAccount(storage_path('app/firebase/medivoice-92430-firebase-adminsdk-fbsvc-2900475cf8.json'))
            ->withDatabaseUri('https://medivoice-92430-default-rtdb.firebaseio.com')
            ->createDatabase();
    }

    public function getNurses(Request $request)
    {
        $database = $this->database();

        // Fetch all nurses; ensure $data is always an array
        $data = $database->getReference('Nurse')->getValue() ?? [];

        // Search nurse
        $search = $request->search ?? '';
        if ($search) {
            $data = array_filter($data, function ($nurse) use ($search) {
                return (isset($nurse['firstName']) && stripos($nurse['firstName'], $search) !== false) ||
                    (isset($nurse['lastName']) && stripos($nurse['lastName'], $search) !== false) ||
                    (isset($nurse['employeeNumber']) && stripos($nurse['employeeNumber'], $search) !== false) ||
                    (isset($nurse['age']) && stripos($nurse['age'], $search) !== false) ||
                    (isset($nurse['contactNumber']) && stripos($nurse['contactNumber'], $search) !== false);
            });
        }

        // Pagination
        $perPage = 5;
        $currentPage = max(1, (int) $request->get('page', 1));
        $total = count($data);
        $totalPages = (int) ceil($total / $perPage);

        $offset = ($currentPage - 1) * $perPage;
        $data = array_slice($data, $offset, $perPage, true);

        return view('admin.nurse', compact(
            'data',
            'search',
            'currentPage',
            'totalPages'
        ));
    }

    public function nurseInfo($id)
    {
        $database = $this->database();
        $nurse = $database->getReference('Nurse/' . $id)->getValue();

        if (!$nurse) {
            abort(404);
        }

        return view('admin.nurseInfo', compact('nurse'));
    }

    public function edit($id)
    {
        $database = $this->database();
        $nurse = $database->getReference('Nurse/' . $id)->getValue();

        if (!$nurse) {
            abort(404);
        }

        return view('admin.nurseInfoEdit', compact('nurse', 'id'));
    }

    public function update(Request $request, $id)
    {
        $database = $this->database();

        $database->getReference('Nurse/' . $id)->update([
            'employeeNumber' => $request->employeeNumber,
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'age' => $request->age,
            'contactNumber' => $request->contactNumber,
            'email' => $request->email,
            'shift' => $request->shift,
        ]);

        return redirect()
            ->route('admin.nurseInfo', $id)
            ->with('success', 'Nurse updated successfully.');
    }

    public function delete($id)
    {
        $database = $this->database();

        $nurse = $database->getReference('Nurse/' . $id)->getValue();
        if (!$nurse) {
            abort(404);
        }

        $database->getReference('Nurse/' . $id)->remove();

        return redirect()
            ->route('admin.nurse')
            ->with('success', 'Nurse deleted successfully.');
    }
}
