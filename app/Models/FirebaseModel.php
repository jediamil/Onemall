<?php

namespace App\Models;

use Kreait\Firebase\Factory;
use Kreait\Firebase\Auth as FirebaseAuth;

class FirebaseModel
{
    // Singleton instances
    protected static ?Factory $factory = null;
    protected static $firestore = null;
    protected static ?FirebaseAuth $auth = null;

    public function __construct()
    {
        if (!self::$factory) {
            self::$factory = (new Factory)
                ->withServiceAccount(base_path('storage/app/private/tapeat-merchant-firebase-adminsdk-fbsvc-83575b8d8b.json'));
        }

        if (!self::$firestore) {
            self::$firestore = self::$factory->createFirestore()->database();
        }

        if (!self::$auth) {
            self::$auth = self::$factory->createAuth();
        }
    }

    public function getFirestore()
    {
        return self::$firestore;
    }

    public function getAuth(): FirebaseAuth
    {
        return self::$auth;
    }
}
