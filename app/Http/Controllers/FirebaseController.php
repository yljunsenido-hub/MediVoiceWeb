<?php

namespace App\Http\Controllers;

use Kreait\Firebase\Factory;

class FirebaseController extends Controller
{
    public function getCaregivers()
    {
        $factory = (new Factory)
            ->withServiceAccount(storage_path('app/firebase/medivoice-92430-firebase-adminsdk-fbsvc-2900475cf8.json'))
            ->withDatabaseUri('https://medivoice-92430-default-rtdb.firebaseio.com');

        $database = $factory->createDatabase();

        $data = $database->getReference('Caregiver')->getValue();

        return view('index', compact('data'));
    }
}
