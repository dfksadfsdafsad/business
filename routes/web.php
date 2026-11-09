<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ImageManagerController;
use App\Http\Controllers\Admin\AdminLocaleController;
use App\Http\Controllers\Admin\PageEditorController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\VisualPageBuilderController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ContactMessageController;
use Illuminate\Support\Facades\Route;

$pages = config('site.pages');
$defaultLocale = config('site.default_locale', 'en');
$supportedLocales = array_keys(config('site.supported_locales', ['en' => 'English', 'jp' => 'Japanese']));
$localePattern = implode('|', $supportedLocales);

$resolveView = function (string $locale, string $defaultView): string {
    if ($locale === 'jp') {
        $jpView = str_replace('pages.', 'pages.jp.', $defaultView);
        if (view()->exists($jpView)) {
            return $jpView;
        }
    }

    return $defaultView;
};

Route::redirect('/', '/'.$defaultLocale)->name('home');
Route::redirect('/index.html', '/'.$defaultLocale);

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::redirect('/', '/admin/dashboard');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/locale', [AdminLocaleController::class, 'update'])->name('locale.update');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('/settings', [SettingsController::class, 'edit'])->name('settings.edit');
    Route::post('/settings', [SettingsController::class, 'update'])->name('settings.update');

    Route::get('/pages', [PageEditorController::class, 'index'])->name('pages.index');
    Route::get('/pages/{locale}/{page}', [PageEditorController::class, 'edit'])->name('pages.edit');
    Route::post('/pages/{locale}/{page}', [PageEditorController::class, 'update'])->name('pages.update');
    Route::post('/pages/{locale}/{page}/sections', [PageEditorController::class, 'updateSections'])->name('pages.sections.update');

    Route::get('/builder', [VisualPageBuilderController::class, 'index'])->name('builder.index');
    Route::get('/builder/{locale}/{page}', [VisualPageBuilderController::class, 'edit'])->name('builder.edit');
    Route::get('/builder/{locale}/{page}/payload', [VisualPageBuilderController::class, 'payload'])->name('builder.payload');
    Route::post('/builder/{locale}/{page}/draft', [VisualPageBuilderController::class, 'saveDraft'])->name('builder.save-draft');
    Route::post('/builder/{locale}/{page}/publish', [VisualPageBuilderController::class, 'publish'])->name('builder.publish');
    Route::get('/builder/media/{page}', [VisualPageBuilderController::class, 'listMedia'])->name('builder.media.index');
    Route::post('/builder/media/{page}', [VisualPageBuilderController::class, 'uploadMedia'])->name('builder.media.upload');

    Route::get('/images/{page}', [ImageManagerController::class, 'index'])->name('images.index');
    Route::post('/images/{page}', [ImageManagerController::class, 'upload'])->name('images.upload');
    Route::post('/images/{page}/{filename}/replace', [ImageManagerController::class, 'replace'])
        ->where('filename', '.*')
        ->name('images.replace');
    Route::delete('/images/{page}/{filename}', [ImageManagerController::class, 'destroy'])
        ->where('filename', '.*')
        ->name('images.destroy');
});

Route::prefix('{locale}')
    ->where(['locale' => $localePattern])
    ->group(function () use ($pages, $resolveView) {
        Route::get('/', function (string $locale) use ($pages, $resolveView) {
            app()->setLocale($locale);

            return view($resolveView($locale, $pages['home-3']));
        })->name('localized.home');

        Route::get('/index.html', function (string $locale) {
            return redirect('/'.$locale);
        });

        Route::get('/assets/{path}', function (string $locale, string $path) {
            return redirect('/assets/'.$path);
        })->where('path', '.*');

        Route::post('/contact/send', [ContactMessageController::class, 'send'])
            ->name('localized.contact.send');

        foreach ($pages as $slug => $viewName) {
            if ($slug === 'home-3') {
                continue;
            }

            Route::get('/'.$slug, function (string $locale) use ($slug, $viewName, $resolveView) {
                app()->setLocale($locale);

                return view($resolveView($locale, $viewName));
            })->name('localized.'.$slug);

            Route::get('/'.$slug.'.html', function (string $locale) use ($slug, $viewName, $resolveView) {
                app()->setLocale($locale);

                return view($resolveView($locale, $viewName));
            });
        }

        Route::get('/home-3', function (string $locale) use ($pages, $resolveView) {
            app()->setLocale($locale);

            return view($resolveView($locale, $pages['home-3']));
        });

        Route::get('/home-3.html', function (string $locale) use ($pages, $resolveView) {
            app()->setLocale($locale);

            return view($resolveView($locale, $pages['home-3']));
        });
    });

Route::fallback(function () use ($pages, $defaultLocale) {
    app()->setLocale($defaultLocale);

    return response()->view($pages['404'], [], 404);
});
