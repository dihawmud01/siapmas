<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HBNController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CadreController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PACController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\LibraryController;
use App\Http\Controllers\QrCodeController;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\News\TagController;
use App\Http\Controllers\LaravoltController;
use App\Http\Controllers\AdministratorController;
use App\Http\Controllers\News\NewsController;
use App\Http\Controllers\StatisticController;
use App\Http\Controllers\News\CategoryController;
use App\Http\Controllers\ForgetPasswordControler;
use App\Http\Controllers\Admin\News\TagController as AdminTagController;
use App\Http\Controllers\Admin\News\NewsController as AdminPostController;
use App\Http\Controllers\Admin\News\CategoryController as AdminCategoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/emails', function () {
    return view('mails.reset');
});

Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/news', [NewsController::class, 'index'])->name('news');
Route::get('/administrators', [AdministratorController::class, 'show'])->name('administrators');
Route::get('/contact', [ContactController::class, 'create'])->name('contact.create');
Route::post('/contact/store', [ContactController::class, 'store'])->name('contact.store');
Route::get('/articles/{slug}', [NewsController::class, 'show'])->name('articles.index');
Route::get('/articles/nu/{slug}', [NewsController::class, 'nuArticle'])->name('articles.nu');
Route::get('/categories/{slug}', [CategoryController::class, 'show'])->name('categories');
Route::get('/tags/{slug}', [TagController::class, 'show'])->name('tag');
Route::get('/calendar', [AgendaController::class, 'index'])->name('calendar.index');
Route::get('/profile/{slug}', [ProfileController::class, 'show'])->name('profile.user');
Route::get('/qrcode/varifikasi/kta/{id}/anjay/mabar/ckuahsksdfsihew/S3NAT-4NJ1NG-63lut-73ng/51-3nd1', [
    QrCodeController::class,
    'index',
]);
Route::get('/libraries', [LibraryController::class, 'index'])->name('libraries.index');
Route::get('/libraries/details/{id}', [LibraryController::class, 'show'])->name('libraries.details');
Route::get('/kta/users/download/pdf/{id}/my-kta/', [PDFController::class, 'cadrePDF'])->name('download.kta');

// Route Auth
Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::get('/validation', [LoginController::class, 'showValidation'])->name('validation.index');
Route::post('/validation', [LoginController::class, 'validateUser'])->name('validation');
Route::get('/register/{users}', [LoginController::class, 'register'])->name('index.register');
Route::put('/register/{id}', [LoginController::class, 'store'])->name('register');
Route::post('/authenticate', [LoginController::class, 'authenticate'])->name('authenticate');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

// Forget Password
// Show forget password form
Route::get('/forgot-password', [ForgetPasswordControler::class, 'showForgotPasswordForm'])
    ->middleware('guest')
    ->name('password.request');

// Send a password reset link
Route::post('/forgot-password', [ForgetPasswordControler::class, 'sendResetLinkEmail'])
    ->middleware('guest')
    ->name('password.email');

// Show password reset form
Route::get('/reset-password/{token}', [ForgetPasswordControler::class, 'showResetPasswordForm'])
    ->middleware('guest')
    ->name('password.reset');

// Password reset
Route::post('/reset-password', [ForgetPasswordControler::class, 'resetPassword'])
    ->middleware('guest')
    ->name('password.update');

// Route Auth Pengunjung Kader Admin, Superadmin
Route::middleware(['auth', 'role:1, 2, 3, 4'])->group(function () {
    Route::post('/comments', [CommentController::class, 'store'])
        ->name('comments.store')
        ->middleware('auth');
    Route::get('/profile', [ProfileController::class, 'index'])
        ->name('profile.index')
        ->middleware(['auth']);
    Route::get('/account', [ProfileController::class, 'account'])
        ->name('profile.account')
        ->middleware(['auth']);
    Route::put('/account/update', [ProfileController::class, 'update'])
        ->name('profile.update')
        ->middleware(['auth']);
    Route::post('/account/new-password', [ProfileController::class, 'changePassword'])
        ->name('change-password')
        ->middleware(['auth']);
});

// Route Kader, Admin, Superadmin
Route::middleware(['auth', 'role:1, 2, 3'])->group(function () {
    Route::get('/uploads', [ProfileController::class, 'showUploads'])
        ->name('uploads')
        ->middleware(['auth']);
    Route::post('/profile/post/store', [ProfileController::class, 'storePost'])->name('profile.post.store');
    Route::post('/profile/libraries/store', [ProfileController::class, 'storeLibrary'])->name(
        'profile.libraries.store',
    );
});

require __DIR__ . '/auth.php';

// Route for Address Package
//Route::get('contoh-laravolt', [LaravoltController::class, 'index'])->name('laravolt.index');
Route::get('get-kota', [LaravoltController::class, 'showCity'])->name('show.kota');
Route::get('get-kecamatan', [LaravoltController::class, 'showDistrict'])->name('show.kecamatan');
Route::get('get-kelurahan', [LaravoltController::class, 'showVillage'])->name('show.kelurahan');

// Route Admin & Superadmin
Route::middleware(['auth', 'role:1,2'])->group(function () {
    Route::get('/dashboard', [StatisticController::class, 'index'])->name('dashboard');
    Route::get('/admin/libraries', [LibraryController::class, 'adminIndex'])->name('admin.libraries.index');
    Route::get('/admin/libraries/create', [LibraryController::class, 'create'])->name('admin.libraries.create');
    Route::post('/admin/libraries/store', [LibraryController::class, 'store'])->name('admin.libraries.store');
    Route::get('/admin/libraries/{id}/edit', [LibraryController::class, 'edit'])->name('admin.libraries.edit');
    Route::put('/admin/libraries/{id}', [LibraryController::class, 'update'])->name('admin.libraries.update');
    Route::delete('/admin/libraries/{id}', [LibraryController::class, 'destroy'])->name('admin.libraries.destroy');

    Route::get('/admin/news/categories', [AdminCategoryController::class, 'index'])->name('categories.index');
    Route::get('/admin/news/categories/create', [AdminCategoryController::class, 'create'])->name('categories.create');
    Route::post('/admin/news/categories/store', [AdminCategoryController::class, 'store'])->name('categories.store');
    Route::get('/admin/news/categories/{id}/edit', [AdminCategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/admin/news/categories/{id}', [AdminCategoryController::class, 'update'])->name('categories.update');
    Route::delete('/admin/news/categories/{id}', [AdminCategoryController::class, 'destroy'])->name(
        'categories.destroy',
    );

    Route::get('/admin/news/tags', [AdminTagController::class, 'index'])->name('tags.index');
    Route::get('/admin/news/tags/create', [AdminTagController::class, 'create'])->name('tags.create');
    Route::post('/admin/news/tags/store', [AdminTagController::class, 'store'])->name('tags.store');
    Route::get('/admin/news/tags/{id}/edit', [AdminTagController::class, 'edit'])->name('tags.edit');
    Route::put('/admin/news/tags/{id}', [AdminTagController::class, 'update'])->name('tags.update');
    Route::delete('/admin/news/tags/{id}', [AdminTagController::class, 'destroy'])->name('tags.destroy');

    Route::get('/admin/news', [AdminPostController::class, 'index'])->name('news.index');
    Route::get('/admin/news/create', [AdminPostController::class, 'create'])->name('news.create');
    Route::post('/admin/news/store', [AdminPostController::class, 'store'])->name('news.store');
    Route::get('/admin/news/{id}/edit', [AdminPostController::class, 'edit'])->name('news.edit');
    Route::put('/admin/news/{id}', [AdminPostController::class, 'update'])->name('news.update');
    Route::delete('/admin/news/{id}', [AdminPostController::class, 'destroy'])->name('news.destroy');

    Route::get('/admin/calendar', [AgendaController::class, 'adminIndex'])->name('admin.calendar.index');
    Route::get('/admin/calendar/create', [AgendaController::class, 'create'])->name('admin.calendar.create');
    Route::post('/admin/calendar/store', [AgendaController::class, 'store'])->name('admin.calendar.store');
    Route::get('/admin/calendar/{id}/edit', [AgendaController::class, 'edit'])->name('admin.calendar.edit');
    Route::put('/admin/calendar/{id}', [AgendaController::class, 'update'])->name('admin.calendar.update');
    Route::delete('/admin/calendar/destroy/{id}', [AgendaController::class, 'destroy'])->name('admin.calendar.destroy');

    Route::get('/admin/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/admin/users/create', [UserController::class, 'create'])->name('users.create');
    Route::get('/admin/users/{id}/detail', [ProfileController::class, 'showDetail'])->name('users.detail');

    Route::get('/admin/users/download-pdf/{id}', [PDFController::class, 'cadrePDF'])->name('users.cadre-pdf');
    Route::get('/admin/users/pac/pdf/{slug}', [PDFController::class, 'pacPDF'])->name('users.pac-pdf');

    Route::post('/admin/users/store', [UserController::class, 'store'])->name('users.store');
    Route::get('/admin/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/admin/users/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/admin/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::get('/admin/users/pac/{slug}', [UserController::class, 'showList'])->name('users.pac.list');

    Route::get('/admin/pac', [PACController::class, 'index'])->name('pac.index');
    Route::get('/admin/pac/{slug}', [PACController::class, 'show'])->name('pac.show');

    Route::get('/admin/', [UserController::class, 'showAdministrators'])->name('admins');
    Route::get('/admin/makesta/', [UserController::class, 'showMakestaCadres'])->name('makesta');
    Route::get('/admin/lakmud/', [UserController::class, 'showLakmudCadres'])->name('lakmud');
    Route::get('/admin/lakut/', [UserController::class, 'showLakutCadres'])->name('lakut');
    Route::get('/admin/latinpel/', [UserController::class, 'showLatinpelCadres'])->name('latinpel');
    Route::get('/admin/unverification/', [UserController::class, 'showUnverification'])->name('unverification');
    Route::get('/admin/noncadres/', [UserController::class, 'showNoncadres'])->name('noncadre');

    Route::get('/admin/national-days/', [HBNController::class, 'index'])->name('hbn.index');
    Route::get('/admin/national-days/create', [HBNController::class, 'create'])->name('hbn.create');
    Route::post('/admin/national-days/store', [HBNController::class, 'store'])->name('hbn.store');
    Route::get('/admin/national-days/{id}/edit', [HBNController::class, 'edit'])->name('hbn.edit');
    Route::put('/admin/national-days/{id}', [HBNController::class, 'update'])->name('hbn.update');
    Route::delete('/admin/national-days/{id}', [HBNController::class, 'destroy'])->name('hbn.destroy');
});

// Route Superadmin only
Route::middleware(['auth', 'role: 1'])->group(function () {
    Route::get('/admin/cadres', [CadreController::class, 'index'])->name('cadres.index');
    Route::get('/admin/cadres/create', [CadreController::class, 'create'])->name('cadres.create');
    Route::post('/admin/cadres/store', [CadreController::class, 'store'])->name('cadres.store');
    Route::get('/admin/cadres/{id}/edit', [CadreController::class, 'edit'])->name('cadres.edit');
    Route::put('/admin/cadres/{id}', [CadreController::class, 'update'])->name('cadres.update');
    Route::delete('/admin/cadres/{id}', [CadreController::class, 'destroy'])->name('cadres.destroy');
    Route::get('/admin/cadres/{id}/view', [CadreController::class, 'view'])->name('cadres.view');

    Route::get('/admin/pages', [HomeController::class, 'adminIndex'])->name('pages.index');
    Route::get('/admin/pages/{id}/edit', [HomeController::class, 'edit'])->name('pages.edit');
    Route::put('/admin/pages/{id}', [HomeController::class, 'update'])->name('pages.update');

    Route::get('/admin/pac/create/new', [PACController::class, 'create'])->name('pac.create');
    Route::post('/admin/pac/store', [PACController::class, 'store'])->name('pac.store');
    Route::get('/admin/pac/{id}/edit', [PACController::class, 'edit'])->name('pac.edit');
    Route::put('/admin/pac/{id}', [PACController::class, 'update'])->name('pac.update');
    Route::delete('/admin/pac/{id}', [PACController::class, 'destroy'])->name('pac.destroy');

    Route::get('/admin/quotes/', [QuoteController::class, 'index'])->name('quotes.index');
    Route::get('/admin/quotes/create', [QuoteController::class, 'create'])->name('quotes.create');
    Route::post('/admin/quotes/store', [QuoteController::class, 'store'])->name('quotes.store');
    Route::get('/admin/quotes/{id}/edit', [QuoteController::class, 'edit'])->name('quotes.edit');
    Route::put('/admin/quotes/{id}', [QuoteController::class, 'update'])->name('quotes.update');
    Route::delete('/admin/quotes/{id}', [QuoteController::class, 'destroy'])->name('quotes.destroy');

    Route::get('/admin/administrators/', [AdministratorController::class, 'index'])->name('administrators.index');
    Route::get('/admin/administrators/create', [AdministratorController::class, 'create'])->name(
        'administrators.create',
    );
    Route::post('/admin/administrators/store', [AdministratorController::class, 'store'])->name('administrators.store');
    Route::get('/admin/administrators/{id}/edit', [AdministratorController::class, 'edit'])->name(
        'administrators.edit',
    );
    Route::put('/admin/administrators/{id}', [AdministratorController::class, 'update'])->name('administrators.update');
    Route::delete('/admin/administrators/{id}', [AdministratorController::class, 'destroy'])->name(
        'administrators.destroy',
    );
});
