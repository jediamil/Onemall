<?php

namespace App\Models;

class UserModel extends FirebaseModel
{
    protected string $collection = 'vendors';

    /**
     * Create a new user document with auto-generated ID
     */
    public function createUser(array $data)
    {
        $docRef = $this->getFirestore()->collection($this->collection)->add($data);
        return $docRef->id(); // Returns the generated document ID
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
