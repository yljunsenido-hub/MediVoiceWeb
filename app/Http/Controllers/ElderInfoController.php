<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Factory;

class ElderInfoController extends Controller
{
    public function elderInfo($id)
    {
        $factory = (new Factory)
            ->withServiceAccount('/etc/secrets/firebase.json')
            ->withDatabaseUri('https://medivoice-92430-default-rtdb.firebaseio.com');

        $database = $factory->createDatabase();

        $elder = $database->getReference('Elders/' . $id)->getValue();

        if (!$elder) {
            abort(404);
        }

        return view('admin.elderInfo', compact('elder'));
    }
}
