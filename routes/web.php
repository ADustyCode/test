<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\SavedJobsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JobBoardController;
use App\Http\Controllers\ApplicationController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Mail; // tambahkan ini
use App\Mail\SendEmail; // tambahkan ini
use App\Http\Controllers\JobseekerProfileController;
use App\Http\Controllers\JobseekerSettingsController;
use App\Http\Controllers\EmployerSettingsController;
use App\Http\Controllers\EmployerProfileController;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/

// Homepage
Route::get('/', function () {
    return view('homepage');
});




Route::middleware(['auth', 'verified', 'role:employer'])->prefix('employer')
    ->name('employer.')->group(function () {
    Route::get('/settings', [EmployerSettingsController::class, 'index'])->name('index');
    Route::post('/settings/profile', [EmployerSettingsController::class, 'updateProfile'])->name('settings.profile');
    Route::post('/settings/password', [EmployerSettingsController::class, 'updatePassword'])->name('settings.password');
});
Route::middleware(['auth', 'verified', 'role:jobseeker'])
    ->prefix('jobseeker')
    ->name('jobseeker.')
    ->group(function () {
        Route::get('/settings', [JobseekerSettingsController::class, 'index'])

            ->name('settings');
        Route::post('/settings/profile', [JobseekerSettingsController::class, 'updateProfile'])
            ->name('settings.profile');

        Route::post('/settings/password', [JobseekerSettingsController::class, 'updatePassword'])
            ->name('settings.password');
    });

Route::middleware(['auth'])->group(function () {

    Route::get('/employer/profile', [EmployerProfileController::class, 'show'])
        ->name('employer.profile.show');

    Route::get('/employer/profile/edit', [EmployerProfileController::class, 'edit'])
        ->name('employer.profile.edit');

    Route::put('/employer/profile', [EmployerProfileController::class, 'update'])
        ->name('employer.profile.update');

});




/*
|--------------------------------------------------------------------------
| AUTHENTICATED ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/profile', function () {
        if (auth()->user()->user_type === 'employer') {
            return redirect()->route('employer.profile.show');
        }
        return redirect()->route('jobseeker.profile.show');
    })->name('profile');

    Route::get('/jobseeker/profile', [JobseekerProfileController::class, 'show'])
        ->name('jobseeker.profile.show');

    Route::get('/profile/edit', [JobseekerProfileController::class, 'edit'])
        ->name('jobseeker.profile.edit');

    Route::put('/profile', [JobseekerProfileController::class, 'update'])
        ->name('jobseeker.profile.update');

    Route::get('/notifications', [NotificationController::class, 'index'])
        ->name('notifications.index');

    Route::patch('/notifications/{notification}/read', [NotificationController::class, 'markAsRead'])
        ->name('notifications.read');

    Route::delete('/notifications/{notification}', [NotificationController::class, 'destroy'])
        ->name('notifications.destroy');

    /*
    |--------------------------------------------------------------------------
    | DASHBOARD
    |--------------------------------------------------------------------------
    */
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | EMPLOYER - JOB MANAGEMENT
    |--------------------------------------------------------------------------
    */
    Route::prefix('employer')->group(function () {

        Route::get('/jobs', [JobController::class, 'index'])
            ->name('jobs.index');

        Route::get('/jobs/create', [JobController::class, 'create'])
            ->name('jobs.create');

        Route::post('/jobs', [JobController::class, 'store'])
            ->name('jobs.store');

        Route::get('/jobs/{job}/edit', [JobController::class, 'edit'])
            ->name('jobs.edit');

        Route::put('/jobs/{job}', [JobController::class, 'update'])
            ->name('jobs.update');

        Route::delete('/jobs/{job}', [JobController::class, 'destroy'])
            ->name('jobs.destroy');

    });

    /*
    |--------------------------------------------------------------------------
    | JOBBOARD (JOBSEEKER)
    |--------------------------------------------------------------------------
    */
    Route::get('/jobs/{job}/applications', [ApplicationController::class, 'index'])
        ->name('jobs.applications');

    Route::post('/jobs/{job}/apply', [ApplicationController::class, 'apply'])
        ->name('jobs.apply');

    Route::get('/applications/my', [ApplicationController::class, 'myApplications'])
        ->name('applications.my');

    Route::patch('/applications/{application}/status', [ApplicationController::class, 'updateStatus'])
        ->name('applications.updateStatus');

    Route::delete('/applications/{application}', [ApplicationController::class, 'destroy'])
        ->name('applications.destroy');
    Route::get('/jobboard', [JobBoardController::class, 'index'])
        ->name('jobboard.index');

    Route::get('/jobboard/{job}', [JobBoardController::class, 'show'])
        ->name('jobboard.show');

    // Public job detail (optional, kalau mau employer/jobboard beda)
    Route::get('/jobs/{job}', [JobController::class, 'show'])
        ->name('jobs.show');

    /*
    |--------------------------------------------------------------------------
    | SAVED JOBS
    |--------------------------------------------------------------------------
    */
    Route::get('/saved-jobs', [SavedJobsController::class, 'index'])
        ->name('saved-jobs.index');

    Route::post('/saved-jobs', [SavedJobsController::class, 'store'])
        ->name('saved-jobs.store');

    Route::delete('/saved-jobs/{job}', [SavedJobsController::class, 'destroy'])
        ->name('saved-jobs.destroy');

    /*
    |--------------------------------------------------------------------------
    | PROFILE
    |--------------------------------------------------------------------------
    */
    // Route::get('/profile', [ProfileController::class, 'edit'])
    //     ->name('profile.edit');

    // Route::patch('/profile', [ProfileController::class, 'update'])
    //     ->name('profile.update');

    // Route::delete('/profile', [ProfileController::class, 'destroy'])
    //     ->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| AUTH ROUTES
|--------------------------------------------------------------------------
*/
Route::get('/sign-as', function () {
    return view('sign_as');
})->name('sign-as');

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware(['auth'])->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/dashboard')->with('success', 'Email berhasil diverifikasi.');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function () {
    request()->user()->sendEmailVerificationNotification();

    return back()->with('success', 'Link verifikasi telah dikirim ulang.');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');


Route::get('/mail/send', function () {
    $data = [
        'subject' => 'Testing Kirim Email',
        'title' => 'Testing Kirim Email',
        'body' => 'Ini adalah email uji coba dari Tutorial Laravel: Send Email Via SMTP GMAIL @ qadrLabs.com'
    ];

    Mail::to('nantapeachy@gmail.com')->send(new SendEmail($data));

});

require __DIR__ . '/auth.php';
