<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminDashboard;
use App\Http\Controllers\VendorRegistration;
use App\Http\Controllers\AccountManagement;
use App\Models\FirebaseModel;




// Handle login submission
Route::match(['get', 'post'], '/login/authentication', [LoginController::class, 'login'])->name('login.submit');

// Handle logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// // Handle login submission
// Route::match(['get', 'post'], '/vendor-management/registration', [VendorRegistration::class, 'vendorCreate'])->name('register.submit');

Route::post('/vendor-management/registration', [VendorRegistration::class, 'vendorCreate'])->name('vendor.register.submit');


Route::middleware(['role:Admin'])->group(function () {
    Route::get('/account-management', [AccountManagement::class, 'showAccountManagement'])->name('admin.account');
    Route::get('/account-management/users/{uid}/edit', [AccountManagement::class, 'userEdit'])->name('user.edit');
    Route::put('/account-management/users/{uid}/update', [AccountManagement::class, 'userUpdate'])->name('user.update');
    Route::delete('/account-management/user/{uid}/delete', [AccountManagement::class, 'userDelete'])->name('user.delete');
    Route::get('/vendor-management', [VendorRegistration::class, 'showVendorManagement'])->name('admin.vendorManagement');
});

// Route::get('/dashboard', [AdminDashboard::class, 'showAdminDashboard'])->name('admin.dashboard');

Route::get('/', [LoginController::class, 'showLoginForm'])->name('login')->middleware(['logged_in']);
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login')->middleware(['logged_in']);
    
Route::middleware(['role:Vendor'])->group(function () {
    Route::get('/dashboard', [AdminDashboard::class, 'showAdminDashboard'])->name('admin.dashboard');
});










Route::get('settings', function () {
    return view('components.pages.settings.settings');
});

Route::get('settings/system-maintenance', function () {
    return view('components.pages.settings.system-settings');
});

Route::get('settings/backup', function () {
    return view('components.pages.settings.backup-settings');
});

Route::get('settings/transaction', function () {
    return view('components.pages.settings.transaction-settings');
});

Route::get('settings/rewards', function () {
    return view('components.pages.settings.rewards-settings');
});


Route::get('/test-firebase', function () {
    try {
        // dd(session(['vendor_name']));
        // dd(session(['role']));
        // dd(session(['user_id']));
        
        $firebase = new FirebaseModel();
        $firestore = $firebase->getFirestore();

        // Create a test document
        $docRef = $firestore->collection('test')->document('connection_test');
        $docRef->set([
            'status' => 'connected',
            'timestamp' => now()->toDateTimeString(),
        ]);

        // Read it back
        $snapshot = $docRef->snapshot();

        if ($snapshot->exists()) {
            return "✅ Successfully connected to Firestore!<br>" .
                   "Document data: " . json_encode($snapshot->data());
        } else {
            return "❌ Failed to read test document.";
        }

    } catch (Exception $e) {
        return "❌ Connection error: " . $e->getMessage();
    }
});

Route::get('/test-firebase-auth', function () {
    try {
        $firebase = new FirebaseModel();
        $auth = $firebase->getAuth();

        // Try creating a temporary user (or you can verify a dummy token)
        $user = $auth->createUser([
            'email' => 'testuser@example.com',
            'password' => 'TestPassword123!',
        ]);

        // Optional: delete the test user to keep your Auth clean
        $auth->deleteUser($user->uid);

        return "✅ Successfully connected to Firebase Authentication! User UID: {$user->uid}";

    } catch (\Kreait\Firebase\Exception\Auth\AuthException $e) {
        return "❌ Auth connection failed: " . $e->getMessage();
    } catch (\Kreait\Firebase\Exception\FirebaseException $e) {
        return "❌ Firebase error: " . $e->getMessage();
    } catch (\Exception $e) {
        return "❌ General error: " . $e->getMessage();
    }
});