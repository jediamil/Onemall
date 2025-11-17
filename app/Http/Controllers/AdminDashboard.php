<?php   
    namespace App\Http\Controllers;
    use App\Models\UserModel;
    use Carbon\Carbon;

    class AdminDashboard extends Controller {
        protected UserModel $userModel;

        public function showAdminDashboard() {
    
            $this->userModel = new UserModel();
            $dashboardData = $this->userModel->getDashboardData();
            $salesData = $this->userModel->getSalesData();

            
            $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];

            foreach ($days as $day) {
                ['sold' => ${$day.'Sold'}, 'amount' => ${$day.'Amount'}] = $salesData[$day] ?? ['sold' => 0, 'amount' => 0];
            }

            $today = strtolower(Carbon::now('Asia/Manila')->format('l'));

            // 3. Default weekly structure
            $weeklySales = [
                ['day' => 'Mon', 'value' => $mondaySold, 'revenue' => $mondayAmount],
                ['day' => 'Tue', 'value' => $tuesdaySold, 'revenue' => $tuesdayAmount],
                ['day' => 'Wed', 'value' => $wednesdaySold, 'revenue' => $wednesdayAmount],
                ['day' => 'Thu', 'value' => $thursdaySold, 'revenue' => $thursdayAmount],
                ['day' => 'Fri', 'value' => $fridaySold, 'revenue' => $fridayAmount],
                ['day' => 'Sat', 'value' => $saturdaySold, 'revenue' => $saturdayAmount],
                ['day' => 'Sun', 'value' => $sundaySold, 'revenue' => $sundayAmount],
            ];
            
            $this->updateTodaySales($dashboardData, $today);

            unset($today);

            // 5. Compute totals
            $totalRevenue = array_sum(array_column($weeklySales, 'revenue'));
            $totalSales = array_sum(array_column($weeklySales, 'value'));

            $lastWeekRevenue = 10000; // This should come from your data source
            $growthPercent = $lastWeekRevenue > 0 ? round((($totalRevenue - $lastWeekRevenue) / $lastWeekRevenue) * 100, 1) : 0;

            return view('components.pages.dashboard', compact('weeklySales', 'totalRevenue', 'growthPercent', 'dashboardData', 'totalSales'));
        }


        public function updateTodaySales($salesData, $documentId)
        {
            // 2. New total sales (from input)
            $newTotalSales = $salesData['totalSales']['amount'] ?? 0;

            // 3. Fetch existing weekly sales doc
            $this->userModel = new UserModel();
            $weeklySalesDoc = $this->userModel->getSalesDataById($documentId);
            
            // Ensure the document exists and contains today's data
            $previousSold   = $weeklySalesDoc['sold']  ?? 0;
            $previousAmount = $weeklySalesDoc['amount']?? 0;

            // 4. Calculate differences
            $deltaSold   = $newTotalSales - $previousSold;
            $deltaAmount = $deltaSold * 2; // adjust multiplier as needed

            // 5. Final updated numbers
            $todaySold   = $previousSold + $deltaSold;    
            $todayAmount = $previousAmount + $deltaAmount;

            // 6. Prepare update data
            $updateData = [
                'sold'   => $todaySold,
                'amount' => $todayAmount,
            ];

            // dd($updateData);
            // 7. Update Firestore
            $test = $this->userModel->updateWeeklySales($updateData, $documentId);

            
        }
    }

    