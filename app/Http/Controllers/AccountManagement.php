<?php   
    namespace App\Http\Controllers;
    use App\Models\UserModel;
    use App\Models\UserAuthModel;
    use Illuminate\Http\Request;

    class AccountManagement extends Controller {
        protected UserModel $userModel;
        protected UserAuthModel $userAuthModel;

        public function __construct() {
            $this->userModel = new UserModel();
            $this->userAuthModel = new UserAuthModel();
        }

        public function showAccountManagement() {
            $users = $this->userModel->getAllUser();
            return view('components.pages.account-management', compact('users'));
        }

        public function userDelete($uid) {
            $users = $this->userModel->deleteUser($uid);
            return redirect()->route('admin.account')->with('success', 'User deleted successfully.');
        }

        public function userEdit($uid) {
            $user = $this->userModel->getUser($uid);
            
            if (!$user) {
                abort(404, 'User not found.');
            }
            return view('components.pages.edit', compact('user', 'uid'));
        }

        public function userUpdate(Request $request, $uid) {

            $data = $request->validate([
                'vendor_name' => 'nullable|string|max:255',
                'email' => 'nullable|email',
                'food_stall' => 'nullable|string',
                'email' => 'nullable|email',
                'password' => 'nullable|string|min:6|confirmed',
            ]);

            $updateData = array_filter($data, fn($value) => $value !== null && $value !== '');

            if (!empty($data['password'])) {
                $changePassword = $this->userAuthModel->changePassword($uid, $data['password']);
            }

            unset($updateData['password']);

            $users = $this->userModel->updateUser($uid, $updateData);

            return redirect()->route('admin.account')->with('success', 'User edit successfully.');
        }
    }
