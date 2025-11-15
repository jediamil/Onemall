<?php   
    namespace App\Http\Controllers;
    use App\Models\UserModel;

    class AccountManagement extends Controller {
        protected UserModel $userModel;

        public function __construct() {
            $this->userModel = new UserModel();
        }
        public function showAccountManagement() {
            $users = $this->userModel->getAllUser();
            return view('components.pages.account-management', compact('users'));
        }

        public function jedidiah() {
            // for testing
        }
    }
