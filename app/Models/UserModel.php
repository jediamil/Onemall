<?php

namespace App\Models;

class UserModel extends FirebaseModel
{
    protected string $collection = 'users';

    /**
     * Create a new user document with auto-generated ID
     */
    public function createUser(string $uid, array $data)
    {
        $docRef = $this->getFirestore()->collection($this->collection)->document($uid)->set($data, ['merge' => true]);
        return $uid; // Returns the document ID
    }

    /**
     * Get all users
     */
    public function getAllUser(): array
    {
        $documents = $this->getFirestore()->collection($this->collection)->documents();
        $result = [];
        foreach ($documents as $doc) {
            $result[$doc->id()] = $doc->data();
        }
        return $result;
    }

    /**
     * Get a single user by document ID
     */
    public function getUser(string $id): ?array
    {
        $doc = $this->getFirestore()->collection($this->collection)->document($id)->snapshot();
        return $doc->exists() ? $doc->data() : null;
    }

    // public function getUser(string $id): ?array
    // {
    //     // Simple recursion protection
    //     static $depth = 0;
    //     $depth++;
        
    //     if ($depth > 5) {
    //         throw new \Exception('Recursion detected: getUser method called too many times');
    //     }
        
    //     try {
    //         $doc = $this->getFirestore()->collection($this->collection)->document($id)->snapshot();
    //         return $doc->exists() ? $doc->data() : null;
    //     } finally {
    //         $depth--;
    //     }
    // }


    /**
     * Update a user by document ID
     */
    public function updateUser(string $id, array $data): void
    {
        $this->getFirestore()->collection($this->collection)->document($id)->set($data, ['merge' => true]);
    }

    /**
     * Delete a user by document ID
     */
    public function deleteUser(string $id): void
    {
        $this->getFirestore()->collection($this->collection)->document($id)->delete();
    }
}
