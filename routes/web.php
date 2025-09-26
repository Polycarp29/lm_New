<?php

use Filament\Facades\Filament;
use App\Livewire\PrivacyPolicy;
use App\Livewire\Auth\ResetPassword;
use App\Http\Controllers\User\Logout;
use App\Livewire\Auth\ForgotPassword;
use App\Livewire\Components\ViewBlog;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserDashboard;
use App\Http\Controllers\BlogController;
use App\Livewire\Pages\User\Actions\Tasks;
use App\Http\Controllers\Checker\CopyLeaks;
use App\Http\Controllers\HomePageController;
use App\Livewire\Pages\User\Actions\Profile;
use Illuminate\Auth\Middleware\Authenticate;
use App\Livewire\Pages\User\Actions\ViewTask;
use App\Livewire\Pages\User\Partials\SOPPage;
use App\Http\Controllers\User\GoogleController;
use App\Http\Controllers\QouteServiceController;
use App\Livewire\Pages\User\Actions\Notifications;
use App\Livewire\UserDashboard\Pages\PaymentsPage;
use App\Http\Controllers\Charts\AverageCompletionRate;
use App\Filament\Clusters\TasksConfigurations\Pages\BlogPreview;
use App\Filament\Clusters\TasksConfigurations\Pages\AdminSeoAnalysisPage;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomePageController::class, 'index'])->name('home');
Route::get('/about-us',  [HomePageController::class, 'about_us'])->name('about_us');
Route::get('/services', [HomePageController::class, 'services'])->name('services');
Route::get('/blog', [BlogController::class, 'index'])->name('blog');
Route::get('blog/{slug}', [BlogController::class, 'loadPost'])->name('post.view');


Route::get('/user/login', [UserDashboard::class, 'index'])->name('login');
Route::get('user/register', [UserDashboard::class, 'register'])->name('register');
Route::get('/join_us', [HomePageController::class, 'join_us'])->name('join_us');

//Google Authentication

Route::get('/auth/redirect/google', [GoogleController::class, 'redirectToGoogle'])->name('google.redirect');
Route::get('/auth/callback/google', [GoogleController::class, 'handleGoogleCallback'])->name('google.callback');

Route::get('view_position/{title}', [HomePageController::class, 'view_post'])->name('job.view');

// Reset Password

Route::get('/password_reset', ForgotPassword::class)->name('auth.reset');
Route::get('/reset-password/{token}', ResetPassword::class)->name('password.reset');
Route::get('privacy_policy', PrivacyPolicy::class)->name('privacypolicy');

Route::middleware(['auth', 'role:user,super_admin,user'])->group(function () {
    Route::get('/dashboard', [UserDashboard::class, 'dashboard'])->name('dashboard');
    Route::get('user/view_tasks', Tasks::class)->name('tasks_get');
    Route::get('/notifications', Notifications::class)->name('get_notifications');
    Route::post('/logout', [Logout::class, 'logout'])->name('logout');
    Route::get('/user/profile', Profile::class)->name('profile');
    Route::get('/user/task_view/{taskId}', ViewTask::class)->name('viewTask');
    Route::get('/user/tasks', [UserDashboard::class, 'tasksPage'])->name('tasks');
    Route::get('/user/payments', [UserDashboard::class, 'payments'])->name('payments');
    Route::get('reciept/{task_id}/view', [UserDashboard::class, 'generatePdf'])->name('reciept_pdf');
    Route::get('/completion-rate-data', [AverageCompletionRate::class, 'getAverageCompletionRates'])->name('completion-rate-data');
    Route::get('/admin/seo-analysis/{taskId}', AdminSeoAnalysisPage::class)
    ->name('filament.admin.pages.seo-analysis');

    Route::get('/admin/blog-preview/{taskId}', BlogPreview::class)
    ->name('filament.admin.pages.blog-preview');

    Route::post('/notifications/mark-all-read', function () {
        auth()->user()->unreadNotifications->markAsRead();
        return back();
    })->name('notifications.markAllRead');

    Route::post('/notifications/clear_chats', function () {
        auth()->user()->notifications()->delete(); // Deletes all notifications
        return back();
    })->name('notifications.clear');

    Route::post('/copyleaks/webhook/status/{scanId}', [CopyLeaks::class, 'status'])->name('copyleaks.webhook.status');
    Route::post('/copyleaks/webhook/completed/{scanId}', [CopyLeaks::class, 'completed'])->name('copyleaks.webhook.completed');
    Route::get('sop_page/{id}', SOPPage::class)->name('sop.view');
});

Route::get('/quote/{serviceId}', [QouteServiceController::class, 'index'])->name('get_quote');



Route::get('/email',  function () {
    return view('emails.requestanalysis');
});
// Public privacy policy page (no controller needed)
Route::view('/privacy', 'privacy')->name('privacy');
