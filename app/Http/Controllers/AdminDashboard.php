<?php   
    namespace App\Http\Controllers;
    // use App\Models\UserAuthModel;
    // use Illuminate\Http\Request;

    class AdminDashboard extends Controller {
    //  Show the Admin Dashboard
        public function showAdminDashboard(): string {
            return view('components.pages.dashboard');
        }
    }