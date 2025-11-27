<?php 
    namespace App\Http\Controllers;
    use App\Models\UserModel;
    use Illuminate\Http\Request;

    class Settings extends Controller {
        protected UserModel $userModel;

        public function TransLimit() {
            $this->UserModel = new UserModel();
            $TransLimit = $this->UserModel->getTransLimit();    
            
            return view('components.pages.settings.transaction-settings', compact('TransLimit'));
        }

        public function updateTransLimit(Request $request)
        {
            $validated = $request->validate([
                'limit' => 'required|integer',
            ]);

            try {
                $this->UserModel = new UserModel();
                $this->UserModel->updateTransLimit($validated);

                return redirect()
                    ->back()
                    ->with('success', 'Transaction limit updated successfully!');
            } catch (\Exception $e) {
                return redirect()
                    ->back()
                    ->with('error', 'Failed to update limit. Please try again.');
            }
        }
    }