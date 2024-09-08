<?php

use App\Http\Controllers\Admin\PermissionsController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\TestimonialController as AdminTestimonialController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\MetadataController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\FaviconController;
use App\Http\Controllers\Admin\AboutUsController;
use App\Http\Controllers\Admin\SiteSettingController;
use App\Http\Controllers\Admin\SocialLinkController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\ApplicantController;
use App\Http\Controllers\NoTransactionPurposeController;
use App\Http\Controllers\OffenderController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\TranPurposeController;
use App\Http\Controllers\TranProofController;
use App\Http\Controllers\TranNatureController;
use App\Http\Controllers\HistoriesController;
use App\Models\Blog;
use App\Models\Testimonial;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', function () {
    return view('frontend.welcome');
})->name('/');

Route::get("/properties",function(){
    return view("properties");

})->name("properties");
Route::get("/blog",function(){
    return view("blog");

})->name("blog");

Route::get("/member",function(){
    return view("member");

});
Route::get("/contact",function(){
    return view("contact");
})->name("contact");

Route::get("/about",function(){
    return view("about");
})->name('about');

Route::get('/hello', function () {
    return view('singleproperties');
})->name('hello');

Route::prefix('/admin')->name('admin.')->middleware(['web', 'auth'])->group(function () {

    Route::get('/', [AdminController::class, 'index'])->name('index');

    // User Routes
    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/', [UsersController::class, 'index'])->name('index');
        Route::get('create', [UsersController::class, 'create'])->name('create');
        Route::post('store', [UsersController::class, 'store'])->name('store');
        Route::get('edit/{id}', [UsersController::class, 'edit'])->name('edit');
        Route::post('update', [UsersController::class, 'update'])->name('update');
        Route::get('delete/{id}', [UsersController::class, 'destroy'])->name('destroy');
        Route::get('deleted', [UsersController::class, 'viewDeleted'])->name('viewDeleted');
        Route::get('restore/{id}', [UsersController::class, 'restore'])->name('restore');
        Route::get('deletePermanent/{id}', [UsersController::class, 'permanentDestroy'])->name('permanentDestroy');
    });

    // Roles Routes
    Route::prefix('roles')->name('roles.')->group(function () {
        Route::get('/', [RolesController::class, 'index'])->name('index');
        Route::get('create', [RolesController::class, 'create'])->name('create');
        Route::post('store', [RolesController::class, 'store'])->name('store');
        Route::get('edit/{id}', [RolesController::class, 'edit'])->name('edit');
        Route::post('update', [RolesController::class, 'update'])->name('update');
        Route::get('delete/{id}', [RolesController::class, 'destroy'])->name('destroy');
    });

    // Permissions Routes
    Route::prefix('permissions')->name('permissions.')->group(function () {
        Route::get('/', [PermissionsController::class, 'index'])->name('index');
        Route::get('create', [PermissionsController::class, 'create'])->name('create');
        Route::post('store', [PermissionsController::class, 'store'])->name('store');
        Route::get('edit/{id}', [PermissionsController::class, 'edit'])->name('edit');
        Route::post('update', [PermissionsController::class, 'update'])->name('update');
        Route::get('delete/{id}', [PermissionsController::class, 'destroy'])->name('destroy');
    });

    // Blog Routes
    Route::resource('blogs', BlogController::class);
    Route::post('/upload-image', [BlogController::class, 'uploadImage'])->name('uploadImage');
});

    // Testimonial Routes 
    Route::resource('admin/testimonials', TestimonialController::class);

    //MetaData Routes
    Route::resource('metadata', MetadataController::class);
    Route::put('/metadata/{id}', [MetadataController::class, 'update'])->name('metadata.update');

    //Summernote
    Route::post('admin/summernote/upload', [BlogController::class, 'uploadImage'])->name('admin.summernote.upload');

    //Services
    Route::resource('services', ServiceController::class)->except(['show']);
   
    // Favicon route
    Route::resource('favicons', FaviconController::class);

    //AboutUs route
    Route::resource('aboutus', AboutUsController::class);

    //Sitesetting route
    Route::resource('sitesettings', SiteSettingController::class);

    //Sociallinks route
    Route::resource('social-links', SocialLinkController::class);

    // Routes for History
   // Route::get('/application-history/', [HistoriesController::class, 'application_index'])->name('application-history');
  // Route::get('/system-history/', [HistoriesController::class, 'system_index'])->name('system-history');

  // Frontend Routes

  Route::view("/properties", "frontend.properties")->name('properties');
  Route::view("/blog", "frontend.blog")->name('blog');
  Route::view("/member", "frontend.member")->name('member');
  Route::view("/contact", "frontend.contact")->name('contact');
  Route::view("/about", "frontend.about")->name('about');
  Route::view("/singleproperties", "frontend.singleproperties")->name('singleproperties');

  // Profile Routes
  Route::prefix('/profile')->name('profile.')->middleware(['web', 'auth'])->group(function () {
    Route::get('/', [App\Http\Controllers\ProfilesController::class, 'index'])->name('index');
    Route::post('/update/info', [App\Http\Controllers\ProfilesController::class, 'updateInfo'])->name('update.info');
    Route::post('/update/password', [App\Http\Controllers\ProfilesController::class, 'updatePassword'])->name('update.password');
});
