<?php   
    namespace App\Http\Controllers;
    use App\Models\UserModel;

    class AdminDashboard extends Controller {
        protected UserModel $userModel;

        public function showAdminDashboard() {
            
            $this->userModel = new UserModel();

            $dashboardData = $this->userModel->getDashboardData();

            


             // 1. Get today's day abbreviation (Mon, Tue, Wed, ...)
            $today = date('D');  // Example: "Mon"

            // 2. Get sales amount from Firestore
            $currentSales = $dashboardData['totalSales']['amount'] ?? 0;

            // 3. Default weekly structure
            $weeklySales = [
                ['day' => 'Mon', 'value' => 0, 'revenue' => 0],
                ['day' => 'Tue', 'value' => 0, 'revenue' => 0],
                ['day' => 'Wed', 'value' => 0, 'revenue' => 0],
                ['day' => 'Thu', 'value' => 0, 'revenue' => 0],
                ['day' => 'Fri', 'value' => 0, 'revenue' => 0],
                ['day' => 'Sat', 'value' => 0, 'revenue' => 0],
                ['day' => 'Sun', 'value' => 0, 'revenue' => 0],
            ];

            // 4. Inject today's Firestore value into the correct day
            foreach ($weeklySales as &$day) {
                if ($day['day'] === $today) {
                    $day['value'] = $currentSales;
                    $day['revenue'] = $currentSales * 20; // Example multiplier
                }
            }
            unset($day); // good practice

            // 5. Compute totals
            $totalRevenue = array_sum(array_column($weeklySales, 'revenue'));

            $lastWeekRevenue = 10000;
            $growthPercent = round((($totalRevenue - $lastWeekRevenue) / $lastWeekRevenue) * 100, 1);


            return view('components.pages.dashboard', compact('weeklySales', 'totalRevenue', 'growthPercent', 'dashboardData'));
        }
    }

    