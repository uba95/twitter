<?php

namespace App\Http\Controllers;

use App\Models\User;

use Kreait\Firebase;

use Illuminate\Http\Request;

use Kreait\Firebase\Factory;

use Kreait\Firebase\Database;
use Kreait\Firebase\ServiceAccount;

class FirebaseController extends Controller

{
    
    
    }




// public function  __invoke() {

//     $firebase = (new Factory)
//         ->withServiceAccount(__DIR__.'/laravel1-7de84-firebase-adminsdk-1kpsl-42980588fd.json')
//         ->withDatabaseUri('https://laravel1-7de84.firebaseio.com');

//     $database = $firebase->createDatabase();

//     $newPost = $database

//         ->getReference('blog/posts')
//         ->push(['title' => 'Post title', 'body' => 'This should probably be longer.']);

//     echo "<pre>";

//     print_r($newPost->getvalue());
// }
