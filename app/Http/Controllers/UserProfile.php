<?php   
    namespace App\Http\Controllers;

    class UserProfile extends Controller {
        public function showUserProfile() {
            return view('components.pages.userprofile');
        }
    }