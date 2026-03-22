<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Factory;

class ElderController extends Controller
{
    private function database()
    {
        return (new Factory)
            ->withServiceAccount(storage_path('app/firebase/medivoice-92430-firebase-adminsdk-fbsvc-2900475cf8.json'))
            ->withDatabaseUri('https://medivoice-92430-default-rtdb.firebaseio.com')
            ->createDatabase();
    }

    public function getElders(Request $request)
    {
        $database = $this->database();

        // Fetch all elders; ensure $data is always an array
        $data = $database->getReference('Elders')->getValue() ?? [];

        // Search elder
        $search = $request->search ?? '';
        if ($search) {
            $data = array_filter($data, function ($elder) use ($search) {
                return (isset($elder['name']) && stripos($elder['name'], $search) !== false) ||
                    (isset($elder['age']) && stripos($elder['age'], $search) !== false) ||
                    (isset($elder['birthday']) && stripos($elder['birthday'], $search) !== false) ||
                    (isset($elder['gender']) && stripos($elder['gender'], $search) !== false);
            });
        }

        // Pagination
        $perPage = 5;
        $currentPage = max(1, (int) $request->get('page', 1));
        $total = count($data);
        $totalPages = (int) ceil($total / $perPage);

        $offset = ($currentPage - 1) * $perPage;
        $data = array_slice($data, $offset, $perPage, true);

        return view('admin.elder', compact(
            'data',
            'search',
            'currentPage',
            'totalPages'
        ));
    }

    public function elderInfo($id)
    {
        $database = $this->database();
        $elder = $database->getReference('Elders/' . $id)->getValue();

        if (!$elder) {
            abort(404);
        }

        return view('admin.elderInfo', compact('elder'));
    }

    public function edit($id)
    {
        $database = $this->database();
        $elder = $database->getReference('Elders/' . $id)->getValue();

        if (!$elder) {
            abort(404);
        }

        return view('admin.elderInfoEdit', compact('elder', 'id'));
    }

    public function update(Request $request, $id)
    {
        $database = $this->database();

        $database->getReference('Elders/' . $id)->update([
            'name' => $request->name,
            'gender' => $request->gender,
            'age' => $request->age,
            'birthday' => $request->birthday,
            'civilStatus' => $request->civilStatus,
            'homeAddress' => $request->homeAddress,
            'allergies' => $request->allergies,
            'cognitiveStatus' => $request->cognitiveStatus,
            'disabilities' => $request->disabilities,
            'primaryContactNumber' => $request->primaryContactNumber,
            'primaryContactPerson' => $request->primaryContactPerson,
            'primaryRelationship' => $request->primaryRelationship,
            'secondaryContactNumber' => $request->secondaryContactNumber,
            'secondaryContactPerson' => $request->secondaryContactPerson,
            'secondaryRelationship' => $request->secondaryRelationship,
        ]);

        return redirect()
            ->route('admin.elderInfo', $id)
            ->with('success', 'Elder updated successfully.');
    }

    public function delete($id)
    {
        $database = $this->database();
        $elder = $database->getReference('Elders/' . $id)->getValue();

        if (!$elder) {
            abort(404);
        }

        $database->getReference('Elders/' . $id)->remove();

        return redirect()
            ->route('admin.elder')
            ->with('success', 'Elder deleted successfully.');
    }
}
