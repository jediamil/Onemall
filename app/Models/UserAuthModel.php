<?php 

    namespace App\Models;
    use Kreait\Firebase\Auth\SignIn\FailedToSignIn;

    class UserAuthModel extends FirebaseModel {
        public function login(string $email, string $password)
        {
            try {
                // Attempt to sign in
                return $this->getAuth()->signInWithEmailAndPassword($email, $password);
            } catch (FailedToSignIn $e) {
                // Login failed, return null instead of letting the exception crash the app
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

        public function verifyIdToken(string $idToken)
    {
        try {
            return $this->getAuth()->verifyIdToken($idToken);
        } catch (\Kreait\Firebase\Exception\Auth\FailedToVerifyToken $e) {
            return null;
        }
    }
    }