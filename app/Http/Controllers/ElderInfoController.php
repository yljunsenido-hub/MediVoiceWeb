<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Factory;

class ElderInfoController extends Controller
{
    public function elderInfo($id)
    {
        $factory = (new Factory)
            ->withServiceAccount(storage_path('app/firebase/medivoice-92430-firebase-adminsdk-fbsvc-2900475cf8.json'))
            ->withDatabaseUri('https://medivoice-92430-default-rtdb.firebaseio.com');

        $database = $factory->createDatabase();

        $elder = $database->getReference('Elders/' . $id)->getValue();

        if (!$elder) {
            abort(404);
        }

        return view('admin.elderInfo', compact('elder'));
    }
}
