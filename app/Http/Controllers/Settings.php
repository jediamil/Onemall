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

        public function taskGet() {
            $this->UserModel = new UserModel();
            $tasks = $this->UserModel->taskSettings();

            return view('components.pages.settings.rewards-settings', compact('tasks'));
        }

        public function taskDelete($taskId)
        {
            $this->UserModel = new UserModel();
            $delete = $this->UserModel->taskDelete($taskId);

            if ($delete) {
                return redirect()->back()->with('success', 'Task deleted successfully!');
            } else {
                return redirect()->back()->with('error', 'Failed to delete task.');
            }
        }
    }