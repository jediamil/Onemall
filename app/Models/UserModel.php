<?php

namespace App\Models;

use Kreait\Firebase\Exception\FirebaseException;
use Google\Cloud\Core\Exception\ServiceException;
use Exception;

class UserModel extends FirebaseModel
{
    protected string $collection = 'users';

    /**
     * Create a new user document with auto-generated ID
     */
    public function createUser(string $uid, array $data): ?string
    {
        try {
            $this->getFirestore()
                ->collection($this->collection)
                ->document($uid)
                ->set($data, ['merge' => true]);
                
            return $uid;
        } catch (ServiceException $e) {
            \Log::error('Firestore Service Error creating user: ' . $e->getMessage(), [
                'uid' => $uid,
                'error_code' => $e->getCode()
            ]);
            return null;
        } catch (FirebaseException $e) {
            \Log::error('Firebase Error creating user: ' . $e->getMessage(), ['uid' => $uid]);
            return null;
        } catch (Exception $e) {
            \Log::error('Unexpected error creating user: ' . $e->getMessage(), ['uid' => $uid]);
            return null;
        }
    }

    /**
     * Get all users with optimized data processing
     */
    public function getAllUser(): array
    {
        try {
            $documents = $this->getFirestore()
                ->collection($this->collection)
                ->documents();
                
            $result = [];
            foreach ($documents as $doc) {
                if ($doc->exists()) {
                    $result[$doc->id()] = $doc->data();
                }
            }
            return $result;
        } catch (ServiceException $e) {
            \Log::error('Firestore Service Error fetching all users: ' . $e->getMessage(), [
                'error_code' => $e->getCode()
            ]);
            return [];
        } catch (FirebaseException $e) {
            \Log::error('Firebase Error fetching all users: ' . $e->getMessage());
            return [];
        } catch (Exception $e) {
            \Log::error('Unexpected error fetching all users: ' . $e->getMessage());
            return [];
        }
    }

    /**
     * Get a single user by document ID with existence check
     */
    public function getUser(string $id): ?array
    {
        try {
            $doc = $this->getFirestore()
                ->collection($this->collection)
                ->document($id)
                ->snapshot();
                
            return $doc->exists() ? $doc->data() : null;
        } catch (ServiceException $e) {
            \Log::error('Firestore Service Error fetching user: ' . $e->getMessage(), [
                'user_id' => $id,
                'error_code' => $e->getCode()
            ]);
            return null;
        } catch (FirebaseException $e) {
            \Log::error('Firebase Error fetching user: ' . $e->getMessage(), ['user_id' => $id]);
            return null;
        } catch (Exception $e) {
            \Log::error('Unexpected error fetching user: ' . $e->getMessage(), ['user_id' => $id]);
            return null;
        }
    }

    public function getTransLimit() {
        $doc = $this->getFirestore()
        ->collection('settings')
        ->document('dailyLimit')
        ->snapshot();

        return $doc->exists() ? $doc->data() : null;
    }

    public function updateTransLimit($data) {
        $this->getFirestore()
                ->collection('settings')
                ->document('dailyLimit')
                ->set($data, ['merge' => true]);
    }
    
    public function taskSettings() {
        $documents = $this->getFirestore()
                ->collection('tasks')
                ->documents();
                
            $result = [];
            foreach ($documents as $doc) {
                if ($doc->exists()) {
                    $result[$doc->id()] = $doc->data();
                }
            }
        return $result;
    }

    public function taskDelete($id) {
        $this->getFirestore()
                ->collection('tasks')
                ->document($id)
                ->delete();   
            return true;
    }

    public function getDashboardData() {
        try {
            $result = [];

            $docs = $this->getFirestore()
            ->collection('dashboard-overview')
            ->documents();

            foreach ($docs as $doc) {
                if ($doc->exists()) {
                    $result[$doc->id()] = $doc->data();
                }
            }
            return $result;
        } catch (FirebaseException $e) {
            \Log::error('Firebase Error fetching: ' . $e->getMessage());
            return null;
        } catch (Exception $e) {
            \Log::error('Unexpected error fetching: ' . $e->getMessage());
            return null;
        }
    }

    public function getSalesData() {
        try {
            $result = [];

            $docs = $this->getFirestore()
            ->collection('weeklySalesData')
            ->documents();

            foreach ($docs as $doc) {
                if ($doc->exists()) {
                    $result[$doc->id()] = $doc->data();
                }
            }
            return $result;
        } catch (FirebaseException $e) {
            \Log::error('Firebase Error fetching: ' . $e->getMessage());
            return null;
        } catch (Exception $e) {
            \Log::error('Unexpected error fetching: ' . $e->getMessage());
            return null;
        }
    }

    public function getSalesDataById($documentId)
    {
        try {
            $snapshot = $this->getFirestore()
                ->collection('weeklySalesData')
                ->document($documentId)
                ->snapshot();

            if ($snapshot->exists()) {
                return $snapshot->data();
                
            }

            return null;

        } catch (FirebaseException $e) {
            \Log::error('Firebase Error fetching: ' . $e->getMessage());
            return null;
        } catch (Exception $e) {
            \Log::error('Unexpected error fetching: ' . $e->getMessage());
            return null;
        }
    }


    public function updateWeeklySales($updateData, $documentId ) {
        try {
            $this->getFirestore()
                ->collection('weeklySalesData')
                ->document($documentId)
                ->set($updateData, ['merge' => true]);
        } catch (FirebaseException $e) {
            \Log::error('Firebase Error fetching: ' . $e->getMessage());
            return null;
        } catch (Exception $e) {
            \Log::error('Unexpected error fetching: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Update a user by document ID with validation
     */
    public function updateUser(string $id, array $data): bool
    {
        try {
            if (empty($data)) {
                \Log::warning('Attempted to update user with empty data', ['user_id' => $id]);
                return false;
            }
            
            $this->getFirestore()
                ->collection($this->collection)
                ->document($id)
                ->set($data, ['merge' => true]);
                
            return true;
        } catch (ServiceException $e) {
            \Log::error('Firestore Service Error updating user: ' . $e->getMessage(), [
                'user_id' => $id,
                'error_code' => $e->getCode()
            ]);
            return false;
        } catch (FirebaseException $e) {
            \Log::error('Firebase Error updating user: ' . $e->getMessage(), ['user_id' => $id]);
            return false;
        } catch (Exception $e) {
            \Log::error('Unexpected error updating user: ' . $e->getMessage(), ['user_id' => $id]);
            return false;
        }
    }

    /**
     * Delete a user by document ID with existence verification
     */
    public function deleteUser(string $id): bool
    {
        try {
            $doc = $this->getFirestore()
                ->collection($this->collection)
                ->document($id)
                ->snapshot();
                
            if (!$doc->exists()) {
                \Log::warning('Attempted to delete non-existent user', ['user_id' => $id]);
                return false;
            }
            
            $this->getFirestore()
                ->collection($this->collection)
                ->document($id)
                ->delete();
                
            return true;
        } catch (ServiceException $e) {
            \Log::error('Firestore Service Error deleting user: ' . $e->getMessage(), [
                'user_id' => $id,
                'error_code' => $e->getCode()
            ]);
            return false;
        } catch (FirebaseException $e) {
            \Log::error('Firebase Error deleting user: ' . $e->getMessage(), ['user_id' => $id]);
            return false;
        } catch (Exception $e) {
            \Log::error('Unexpected error deleting user: ' . $e->getMessage(), ['user_id' => $id]);
            return false;
        }
    }

    /**
     * Check if user exists
     */
    public function userExists(string $id): bool
    {
        try {
            $doc = $this->getFirestore()
                ->collection($this->collection)
                ->document($id)
                ->snapshot();
                
            return $doc->exists();
        } catch (Exception $e) {
            \Log::error('Error checking user existence: ' . $e->getMessage(), ['user_id' => $id]);
            return false;
        }
    }

    /**
     * Get users with pagination (optional enhancement)
     */
    public function getUsersPaginated(int $limit = 25, ?string $startAfter = null): array
    {
        try {
            $query = $this->getFirestore()
                ->collection($this->collection)
                ->limit($limit);
                
            if ($startAfter) {
                $startDoc = $this->getFirestore()
                    ->collection($this->collection)
                    ->document($startAfter)
                    ->snapshot();
                $query = $query->startAfter($startDoc);
            }
            
            $documents = $query->documents();
            
            $result = [
                'users' => [],
                'last_id' => null
            ];
            
            foreach ($documents as $doc) {
                if ($doc->exists()) {
                    $result['users'][$doc->id()] = $doc->data();
                    $result['last_id'] = $doc->id();
                }
            }
            
            return $result;
        } catch (Exception $e) {
            \Log::error('Error fetching paginated users: ' . $e->getMessage());
            return ['users' => [], 'last_id' => null];
        }
    }
}