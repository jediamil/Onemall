<?php

namespace App\Models;

use Kreait\Firebase\Factory;
use Kreait\Firebase\Auth as FirebaseAuth;

class FirebaseModel
{
    protected $factory;
    protected $firestore;
    protected $auth;

    public function __construct()
    {
        $this->factory = (new Factory)->withServiceAccount(base_path('storage/app/private/tapeat-merchant-firebase-adminsdk-fbsvc-83575b8d8b.json'));
    }

    public function getFirestore()
    {
        if (!$this->firestore) {
            $this->firestore = $this->factory->createFirestore()->database();
        }
        return $this->firestore;
    }

    public function getAuth(): FirebaseAuth
    {
        if (!$this->auth) {
            $this->auth = $this->factory->createAuth();
        }
        return $this->auth;
    }
}
