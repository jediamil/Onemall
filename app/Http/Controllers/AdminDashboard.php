<?php   
    namespace App\Http\Controllers;

    class AdminDashboard extends Controller {


        public function showAdminDashboard() {
             $weeklySales = [
                ['day' => 'Mon', 'value' => 60, 'revenue' => 1200],
                ['day' => 'Tue', 'value' => 45, 'revenue' => 900],
                ['day' => 'Wed', 'value' => 75, 'revenue' => 1500],
                ['day' => 'Thu', 'value' => 85, 'revenue' => 1700],
                ['day' => 'Fri', 'value' => 65, 'revenue' => 1300],
                ['day' => 'Sat', 'value' => 90, 'revenue' => 1800],
                ['day' => 'Sun', 'value' => 70, 'revenue' => 1400],
            ];

            $totalRevenue = array_sum(array_column($weeklySales, 'revenue'));
            $lastWeekRevenue = 10000;
            $growthPercent = round((($totalRevenue - $lastWeekRevenue) / $lastWeekRevenue) * 100, 1);

            return view('components.pages.dashboard', compact('weeklySales', 'totalRevenue', 'growthPercent'));
        }
    }

    