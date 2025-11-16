<?php 

    namespace App\Models;
    use Kreait\Firebase\Auth\SignIn\FailedToSignIn;
    use Kreait\Firebase\Exception\Auth\UserNotFound;
    use Kreait\Firebase\Exception\AuthException;

    class UserAuthModel extends FirebaseModel {
        public function login(string $email, string $password)
        {
            try {
                // Attempt to sign in
                return $this->getAuth()->signInWithEmailAndPassword($email, $password);
            } catch (FailedToSignIn|AuthException $e) {
                error_log("Failed login attempt for $email: " . $e->getMessage());
                return null;
            }
        }

        public function registerUser(string $email, string $password) {
            try {
                $user = $this->getAuth()->createUser([
                    'email' => $email,
                    'password' => $password,
                ]);
                return $user; //  Returns Firebase User object
            } catch (\Kreait\Firebase\Exception\AuthException $e) {
                return null; // Invalid credentials
            }
        }

        public function changePassword($id, $newPassword) {
            try {
                $this->getAuth()->changeUserPassword($id, $newPassword);
            } catch (\Kreaite|Firebase\Exception\AuthException $e) {
                return null;
            }
        }

        
        public function deleteUsers(string $uid) {
            try {
                $this->getAuth()->deleteUser($uid);
            } catch (\Kreaite\Firebase\Exception\Auth\UserNotFound $e) {
                return null;
            }
        }
        // public function verifyIdToken(string $idToken)
        // {
        // try {
        //     return $this->getAuth()->verifyIdToken($idToken);
        // } catch (\Kreait\Firebase\Exception\Auth\FailedToVerifyToken $e) {
        //     return null;
        // }
    }