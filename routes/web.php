<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PermissionsController;
use App\Http\Controllers\Admin\PropertyController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\TestimonialController as AdminTestimonialController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\WhyusController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\MetadataController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\FrontViewController;
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
use App\Http\Controllers\SingleController;
use App\Http\Controllers\Admin\FAQController;
use App\Http\Controllers\Admin\FaviconController;
use App\Http\Controllers\Admin\SiteSettingController;
use App\Http\Controllers\Admin\SocialLinkController;
use App\Http\Controllers\Admin\AboutUsController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Admin\AboutDescriptionController;


Auth::routes();

Route::get('/', function () {
    return view('frontend.welcome');
})->name('/');

Route::get("/properties", function () {
    return view("frontend.properties");

})->name("properties");
Route::get("/blog", function () {
    return view("frontend.blog");

})->name("blog");


Route::get("/member", function () {
    return view("frontend.member");

});
Route::get("/contact", function () {
    return view("frontend.contact");
})->name("contact");


Route::get("/about", function () {
    return view("frontend.about");
})->name('about');

Route::get("/service", function () {
    return view("service");
});
Route::get("services", function () {
    return view('frontend.include.blog.php');
});
Route::get("services", function () {
    return view("frontend.include.advantage.php");
});
Route::get("services", function () {
    return view("frontend.include.indexbanner.php");
});

Route::get("services", function () {
    return view("frontend.include.about.blade.php");
});

Route::get("services", function () {
    return view("frontend.testimonial.blade.php");
});
Route::get("service", function () {
    return view("frontend.include.project.blade.php");
});

Route::get("service", function () {
    return view("frontend.include.project.blade.php");
});


Route::get('/hello', function () {
    return view('frontend.singleproperties');
})->name('hello');
Route::get('/', [FrontViewController::class, 'index'])->name('index');


Auth::routes(['verify' => true]);

Route::get('/email/verify', function () {
    return view('auth.verify');
})->middleware('auth')->name('verification.notice');

// Route to handle the verification when the user clicks the link in the email
Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])
    ->middleware(['auth', 'signed'])
    ->name('verification.verify');

// Route to resend the verification email
Route::post('/email/resend', [VerificationController::class, 'resend'])
    ->middleware(['auth', 'throttle:6,1'])
    ->name('verification.send');




Route::prefix('/admin')->name('admin.')->middleware(['web', 'auth'])->group(function () {

    Route::get('/', [AdminController::class, 'index'])->name('index');
    Route::resource('services', ServiceController::class);
    Route::resource('favicon', FaviconController::class);
    Route::get('/dashboard', [AdminController::class, 'index'])->middleware('verified');
    Route::put('/services/update', [ServiceController::class, 'update'])->name('services.update');
    Route::resource('favicons', FaviconController::class);

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
    Route::resource('services', ServiceController::class);

    Route::resource('favicons', FaviconController::class);

    //AboutUs route
    Route::resource('aboutus', AboutUsController::class);

    //Sitesetting route
    Route::resource('sitesettings', SiteSettingController::class);

    Route::resource('property', PropertyController::class);

    //Sociallinks route
    Route::resource('social-links', SocialLinkController::class);

    Route::resource('property', PropertyController::class);
    Route::resource('team', TeamController::class);
    Route::resource('whyus', WhyusController::class);
    Route::resource('faqs', FAQController::class);

    Route::resource('about_descriptions', AboutDescriptionController::class);


    Route::resource('admin/testimonials', TestimonialController::class);
    Route::resource('admin/property', PropertyController::class);
    Route::resource('admin/categories', CategoryController::class);
    Route::resource('admin/subcategories', SubCategoryController::class);
    //MetaData Routes
    Route::resource('metadata', MetadataController::class);
    Route::put('/metadata/{id}', [MetadataController::class, 'update'])->name('metadata.update');

    // Blog Routes
    Route::resource('blogs', BlogController::class);
    Route::post('/upload-image', [BlogController::class, 'uploadImage'])->name('uploadImage');
});



// Testimonial Routes 


//    Route::resource('services', ServiceController::class);






Route::get('/services', [SingleController::class, 'render_service'])->name('properties');
Route::view("/member", "frontend.member")->name('member');
Route::view("/contact", "frontend.contact")->name('contact');
Route::get('/about', [SingleController::class, 'render_about'])->name('about');
Route::get('/blog', [SingleController::class, 'render_blog'])->name('blog');
Route::get('/singleblogpost', [SingleController::class, 'render_singleblogpost'])->name('singleblogpost');
Route::view("/singleproperties", "frontend.singleproperties")->name('singleproperties');


// Routes for History
// Route::get('/application-history/', [HistoriesController::class, 'application_index'])->name('application-history');
// Route::get('/system-history/', [HistoriesController::class, 'system_index'])->name('system-history');

// Frontend Routes

// Route::get('/services', [SingleController::class, 'render_service'])->name('properties');
Route::view("/member", "frontend.member")->name('member');
Route::view("/contact", "frontend.contact")->name('contact');
Route::get('/about', [SingleController::class, 'render_about'])->name('about');
Route::get('/blog', [SingleController::class, 'render_blog'])->name('blog');
Route::get('/singleblogpost/{id}', [SingleController::class, 'singlePost'])->name('singleblogpost');
Route::view("/singleproperties", "frontend.singleproperties")->name('singleproperties');


Route::prefix('/profile')->name('profile.')->middleware(['web', 'auth'])->group(function () {
    Route::get('/', [App\Http\Controllers\ProfilesController::class, 'index'])->name('index');
    Route::post('/update/info', [App\Http\Controllers\ProfilesController::class, 'updateInfo'])->name('update.info');
    Route::post('/update/password', [App\Http\Controllers\ProfilesController::class, 'updatePassword'])->name('update.password');
});
Route::prefix('services')->name('services.')->group(function () {
    Route::get('/', [ServiceController::class, 'index'])->name('index');
    Route::get('create', [ServiceController::class, 'create'])->name('create');
    Route::post('store', [ServiceController::class, 'store'])->name('store');
    Route::get('edit/{id}', [ServiceController::class, 'edit'])->name('edit');
    Route::post('update', [ServiceController::class, 'update'])->name('update');
    Route::get('delete/{id}', [ServiceController::class, 'destroy'])->name('destroy');
});