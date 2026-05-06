<?php

namespace App\Http\Controllers;

use Kreait\Firebase\Factory;

class FirebaseController extends Controller
{
    public function getCaregivers()
    {
        $firebaseCredentials = json_decode(env('FIREBASE_CREDENTIALS'), true);

        $factory = (new Factory)
            ->withServiceAccount(storage_path('app/firebase/firebase.json'))
            ->withDatabaseUri('https://medivoice-92430-default-rtdb.firebaseio.com');

        $database = $factory->createDatabase();

        $data = $database->getReference('Caregiver')->getValue();

        return view('index', compact('data'));
    }
}
