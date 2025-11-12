<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminDashboard;
use App\Models\FirebaseModel;

// Handle login user interface
Route::get('/', [LoginController::class, 'showLoginForm'])->name('login')->middleware('logged_in');


// Handle login submission
Route::match(['get', 'post'], '/login/authentication', [LoginController::class, 'login'])->name('login.submit');

// Handle logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


Route::middleware(['role:admin'])->group(function () {
    Route::get('/dashboard', [AdminDashboard::class, 'showAdminDashboard'])->name('admin.dashboard');
});








Route::get('account-management', function () {
    return view('components.pages.account-management');
});

Route::get('vendor-management', function () {
    return view('components.pages.vendor-management');
});

Route::get('settings', function () {
    return view('components.pages.settings');
});


Route::get('/test-firebase', function () {
    try {
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