<?php

use App\Models\Role;
use App\Models\Rating;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\Admin\SeoController;
use App\Http\Controllers\Admin\UserControler;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\StaffController;
use App\Http\Controllers\User\TicketController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\User\RegisterController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CurrencyController;
use App\Http\Controllers\Payment\StripeController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Frontend\CommentController;
use App\Http\Controllers\User\TicketReplyController;
use App\Http\Controllers\Admin\MailSettingController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\WishlistController;
use App\Http\Controllers\Admin\AdminLanguageController;
use App\Http\Controllers\Admin\ChildCategoryController;
use App\Http\Controllers\Payment\MobileMoneyController;
use App\Http\Controllers\Admin\FrontendLanguageController;
use App\Http\Controllers\Payment\CashOnDeliveryController;
use App\Http\Controllers\User\LoginController as UserLoginController;
use App\Http\Controllers\User\OrderController as UserOrderController;
use App\Http\Controllers\Admin\TicketController as AdminTicketController;
use App\Http\Controllers\User\ProfileController as UserProfileController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\Frontend\ProductController as FrontendProductController;
use App\Http\Controllers\Admin\TicketReplyController as AdminTicketReplyController;
use App\Http\Controllers\Frontend\CategoryController as FrontendCategoryController;

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

Route::get('frontend/laguage/{id}', [FrontendController::class, 'language'])->name('frontend.language');

Route::get('frontend/currency/{id}', [FrontendController::class, 'currency'])->name('frontend.currency');

Route::post('stripe/store', [StripeController::class, 'store'])->name('stripe.store');

Route::post('cash/store', [CashOnDeliveryController::class, 'store'])->name('cash.store');

Route::post('mobile/store', [MobileMoneyController::class, 'store'])->name('mobile.store');

Route::post('add/wishlist', [WishlistController::class, 'addWishlist'])->name('wishlist.add');

Route::get('wishlist', [WishlistController::class, 'wishlist'])->name('wishlist');

Route::get('wishlist/remove/{id}', [WishlistController::class, 'removeWishlist'])->name('wishlist.remove');

// Route::get('order/invoice/{id}', [OrderController::class, 'invoice'])->name('order.invoice');

Route::group(['middleware' => 'language'], function(){

    Route::get('/', [FrontendController::class, 'index'])->name('index');
    Route::get('category/{slug}', [FrontendCategoryController::class, 'category'])->name('category');
    Route::get('product/details/{slug}', [FrontendProductController::class, 'details'])->name('product.details');
    Route::post('cart/store', [CartController::class, 'store'])->name('cart.store');
    Route::get('cart/show', [CartController::class, 'show'])->name('cart.show');
    Route::get('cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::get('checkout', [CheckoutController::class, 'checkout'])->name('checkout');
    Route::post('rating', [RatingController::class, 'rating'])->name('rating');
    Route::post('comment', [CommentController::class, 'comment'])->name('comment');
    Route::post('comment/update/{id}', [CommentController::class, 'update'])->name('comment.update');
    Route::get('comment/delete/{id}', [CommentController::class, 'delete'])->name('comment.delete');

    Route::post('reply', [CommentController::class, 'reply'])->name('reply');
    Route::post('reply/update/{id}', [CommentController::class, 'updateReply'])->name('reply.update');
    Route::get('reply/delete/{id}', [CommentController::class, 'deleteReply'])->name('reply.delete');
   
});



//<---------------> START ADMIN ROUTE <---------------------------------------------------------------------------------------->

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'language'], function(){

    //<---------------------> Start Login Route <------------------------------------------------------------------------------------>

    Route::get('login', [LoginController::class, 'loginForm'])->name('login.form')->withoutMiddleware('auth:admin');
    Route::post('login', [LoginController::class, 'login'])->name('login')->withoutMiddleware('auth:admin');
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');

    Route::group(['middleware' => 'auth:admin'], function(){

        //<---------------------> Start Dashboard Route <------------------------------------------------------------------------------------>

        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index');


        //<---------------------> Start Category Route <------------------------------------------------------------------------------------>

        Route::get('category/status/{id1}/{id2}', [CategoryController::class, 'status'])->name('category.status');
        Route::get('category/delete/{id}', [CategoryController::class, 'delete'])->name('category.delete');
        Route::resource('category', CategoryController::class);


        //<---------------------> Start Sub Category Route <------------------------------------------------------------------------------------>

        Route::get('subcategory/status/{id1}/{id2}', [SubCategoryController::class, 'status'])->name('subcategory.status');
        Route::get('subcategory/load/{id}', [SubCategoryController::class, 'load'])->name('subcategory.load');
        Route::get('subcategory/delete/{id}', [SubCategoryController::class, 'delete'])->name('subcategory.delete');
        Route::resource('subcategory', SubCategoryController::class);


        //<---------------------> Start Child Category Route <------------------------------------------------------------------------------------>

        Route::get('childcategory/status/{id1}/{id2}', [ChildCategoryController::class, 'status'])->name('childcategory.status');
        Route::get('childcategory/load/{id}', [ChildCategoryController::class, 'load'])->name('childcategory.load');
        Route::get('childcategory/status/{id1}/{id2}', [ChildCategoryController::class, 'status'])->name('childcategory.status');
        Route::get('childcategory/delete/{id}', [ChildCategoryController::class, 'delete'])->name('childcategory.delete');
        Route::resource('childcategory', ChildCategoryController::class);


        //<---------------------> Start Product Route <------------------------------------------------------------------------------------>

        Route::get('product/index', [ProductController::class, 'index'])->name('product.index');
        Route::get('product/create', [ProductController::class, 'create'])->name('product.create');
        Route::post('product/store', [ProductController::class, 'store'])->name('product.store');
        Route::get('product/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
        Route::post('product/update/{id}', [ProductController::class, 'update'])->name('product.update');
        Route::get('product/delete/{id}', [ProductController::class, 'delete'])->name('product.delete');
        Route::get('product/status/{id1}/{id2}', [ProductController::class, 'status'])->name('product.status');
        Route::get('product/show/{id}', [ProductController::class, 'show'])->name('product.show');


        //<---------------------> Start Frontend Language Route <------------------------------------------------------------------------------------>

    
        Route::get('frontendlanguage/index', [FrontendLanguageController::class, 'index'])->name('frontendlanguage.index');
        Route::get('frontendlanguage/create', [FrontendLanguageController::class, 'create'])->name('frontendlanguage.create');
        Route::post('frontendlanguage/store', [FrontendLanguageController::class, 'store'])->name('frontendlanguage.store');
        Route::get('frontendlanguage/edit/{id}', [FrontendLanguageController::class, 'edit'])->name('frontendlanguage.edit');
        Route::post('frontendlanguage/update/{id}', [FrontendLanguageController::class, 'update'])->name('frontendlanguage.update');
        Route::get('frontendlanguage/status/{id1}/{id2}', [FrontendLanguageController::class, 'status'])->name('frontendlanguage.status');
        Route::get('frontendlanguage/delete/{id}', [FrontendLanguageController::class, 'delete'])->name('frontendlanguage.delete');


        //<---------------------> Start Admin Language Route <------------------------------------------------------------------------------------>

    
        Route::get('adminlanguage/index', [AdminLanguageController::class, 'index'])->name('adminlanguage.index');
        Route::get('adminlanguage/create', [AdminLanguageController::class, 'create'])->name('adminlanguage.create');
        Route::post('adminlanguage/store', [AdminLanguageController::class, 'store'])->name('adminlanguage.store');
        Route::get('adminlanguage/edit/{id}', [AdminLanguageController::class, 'edit'])->name('adminlanguage.edit');
        Route::post('adminlanguage/update/{id}', [AdminLanguageController::class, 'update'])->name('adminlanguage.update');
        Route::get('adminlanguage/status/{id1}/{id2}', [AdminLanguageController::class, 'status'])->name('adminlanguage.status');
        Route::get('adminlanguage/delete/{id}', [AdminLanguageController::class, 'delete'])->name('adminlanguage.delete');
        Route::get('language/{id}', [DashboardController::class, 'language'])->name('language');


        //<---------------------> Start Setting Route <------------------------------------------------------------------------------------>

    
        Route::get('setting/favicon/{id}', [SettingController::class, 'favicon'])->name('setting.favicon');
        Route::post('setting/favicon/{id}', [SettingController::class, 'faviconUpdate'])->name('setting.favicon.update');

        Route::get('setting/logo/{id}', [SettingController::class, 'logo'])->name('setting.logo');
        Route::post('setting/logo/{id}', [SettingController::class, 'logoUpdate'])->name('setting.logo.update');

        Route::get('setting/brand-text/{id}', [SettingController::class, 'brandText'])->name('setting.brand.text');
        Route::post('setting/brand-text/{id}', [SettingController::class, 'brandTextUpdate'])->name('setting.brand.text.update');

        Route::get('setting/frontend-title/{id}', [SettingController::class, 'frontendTitle'])->name('setting.frontend.title');
        Route::post('setting/frontend-title/{id}', [SettingController::class, 'frontendTitleUpdate'])->name('setting.frontend.title.update');

        Route::get('setting/backend-title/{id}', [SettingController::class, 'backendTitle'])->name('setting.backend.title');
        Route::post('setting/backend-title/{id}', [SettingController::class, 'backendTitleUpdate'])->name('setting.backend.title.update');

        Route::get('setting/user-title/{id}', [SettingController::class, 'userTitle'])->name('setting.user.title');
        Route::post('setting/user-title/{id}', [SettingController::class, 'userTitleUpdate'])->name('setting.user.title.update');



        //<---------------------> Start Admin Payment Route <------------------------------------------------------------------------------------>

    
        Route::get('payment/index', [PaymentController::class, 'index'])->name('payment.index');
        Route::get('payment/edit/{id}', [PaymentController::class, 'edit'])->name('payment.edit');
        Route::post('payment/update/{id}', [PaymentController::class, 'update'])->name('payment.update');
        Route::get('payment/status/{id1}/{id2}', [PaymentController::class, 'status'])->name('payment.status');


        //<---------------------> Start Admin Currency Route <------------------------------------------------------------------------------------>

    
        Route::get('currency/index', [CurrencyController::class, 'index'])->name('currency.index');
        Route::get('currency/create', [CurrencyController::class, 'create'])->name('currency.create');
        Route::post('currency/store', [CurrencyController::class, 'store'])->name('currency.store');
        Route::get('currency/edit/{id}', [CurrencyController::class, 'edit'])->name('currency.edit');
        Route::post('currency/update/{id}', [CurrencyController::class, 'update'])->name('currency.update');
        Route::get('currency/delete/{id}', [CurrencyController::class, 'delete'])->name('currency.delete');
        Route::get('currency/status/{id1}/{id2}', [CurrencyController::class, 'status'])->name('currency.status');


        //<---------------------> Start Admin Order Route <------------------------------------------------------------------------------------>

    
        Route::get('all/order', [OrderController::class, 'allOrder'])->name('all.order');
        Route::get('pending/order', [OrderController::class, 'pendingOrder'])->name('pending.order');
        Route::get('complete/order', [OrderController::class, 'completeOrder'])->name('complete.order');
        Route::get('order/details/{id}', [OrderController::class, 'orderDetails'])->name('order.details');
        Route::get('order/status/{id1}/{id2}', [OrderController::class, 'status'])->name('order.status');


        //<---------------------> Start Admin Mail Route <------------------------------------------------------------------------------------>

    
        Route::get('mail/setting/{id}', [MailSettingController::class, 'mailSetting'])->name('mail.setting');
        Route::post('mail/update/{id}', [MailSettingController::class, 'mailUpdate'])->name('mail.update');



        //<---------------------> Start Admin User Route <------------------------------------------------------------------------------------>

    
        Route::get('user/list', [UserController::class, 'userList'])->name('user.list');
        Route::get('user/status/{id1}/{id2}', [UserController::class, 'status'])->name('user.status');
        Route::get('user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
        Route::post('user/update/{id}', [UserController::class, 'update'])->name('user.update');
        Route::get('user/delete/{id}', [UserController::class, 'delete'])->name('user.delete');


        //<---------------------> Start Admin Profile Setting Route <------------------------------------------------------------------------------------>


        Route::get('profile/edit/{id}', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::post('profile/update', [ProfileController::class, 'update'])->name('profile.update');

        Route::get('reset/password/{id}', [ProfileController::class, 'resetPassword'])->name('reset.password');
        Route::post('reset/password/update', [ProfileController::class, 'passwordUpdate'])->name('password.update');

        //<---------------------> Start Admin Ticket Route <------------------------------------------------------------------------------------>

        Route::get('ticket/index', [AdminTicketController::class, 'index'])->name('ticket.index');
        Route::get('ticket/create', [AdminTicketController::class, 'create'])->name('ticket.create');
        Route::post('ticket/store', [AdminTicketController::class, 'store'])->name('ticket.store');
        Route::get('ticket/message/{id}', [AdminTicketController::class, 'message'])->name('ticket.message');
        Route::get('ticket/delete/{id}', [AdminTicketController::class, 'delete'])->name('ticket.delete');
        Route::get('ticket/file/download/{file}', [AdminTicketController::class, 'downloadFile'])->name('ticket.file.download');
        Route::get('ticket/message/edit/{id}', [AdminTicketController::class, 'editMessage'])->name('ticket.message.edit');
        Route::post('ticket/message/update/{id}', [AdminTicketController::class, 'updateMessage'])->name('ticket.message.update');
       
        Route::post('ticket/message/reply', [AdminTicketReplyController::class, 'reply'])->name('ticket.message.reply');
        Route::get('ticket/message/reply/delete/{id}', [AdminTicketReplyController::class, 'delete'])->name('ticket.message.reply.delete');
        Route::get('ticket/message/reply/edit/{id}', [AdminTicketReplyController::class, 'edit'])->name('ticket.message.reply.edit');
        Route::post('ticket/message/reply/update/{id}', [AdminTicketReplyController::class, 'update'])->name('ticket.message.reply.update');


        //<---------------------> Start Admin Role Route <------------------------------------------------------------------------------------>

        Route::get('role/index', [RoleController::class, 'index'])->name('role.index');
        Route::get('role/create', [RoleController::class, 'create'])->name('role.create');
        Route::post('role/store', [RoleController::class, 'store'])->name('role.store');
        Route::get('role/edit/{id}', [RoleController::class, 'edit'])->name('role.edit');
        Route::post('role/update/{id}', [RoleController::class, 'update'])->name('role.update');
        Route::get('role/delete/{id}', [RoleController::class, 'delete'])->name('role.delete');


        //<---------------------> Start Admin Staff Route <------------------------------------------------------------------------------------>
        

        Route::get('staff/index', [StaffController::class, 'index'])->name('staff.index');
        Route::get('staff/create', [StaffController::class, 'create'])->name('staff.create');
        Route::post('staff/store', [StaffController::class, 'store'])->name('staff.store');
        Route::get('staff/edit/{id}', [StaffController::class, 'edit'])->name('staff.edit');
        Route::post('staff/update/{id}', [StaffController::class, 'update'])->name('staff.update');
        Route::get('staff/delete/{id}', [StaffController::class, 'delete'])->name('staff.delete');



        //<---------------------> Start Admin Seo Route <------------------------------------------------------------------------------------>
        
        Route::get('seo/edit/{id}', [SeoController::class, 'edit'])->name('seo.edit');
        Route::post('seo/update/{id}', [SeoController::class, 'update'])->name('seo.update');
        
    });

});

//<---------------> END ADMIN ROUTE <------------------------------------------------------------------------------------------------->



//<---------------> START USER ROUTE <------------------------------------------------------------------------------------------------>

Route::group(['prefix' => 'user', 'as' => 'user.'], function(){

    //<---------------------> Start Login Route <------------------------------------------------------------------------------------>

    Route::get('login', [UserLoginController::class, 'loginForm'])->name('login.form');
    Route::post('login', [UserLoginController::class, 'login'])->name('login');
    Route::get('logout', [UserLoginController::class, 'logout'])->name('logout');


    //<---------------------> Start Register Route <------------------------------------------------------------------------------------>

    Route::get('register', [RegisterController::class, 'registerForm'])->name('register.form');
    Route::post('register', [RegisterController::class, 'register'])->name('register');



    //<---------------------> Start Forgot Route <------------------------------------------------------------------------------------>

    Route::get('forgot/form', [UserLoginController::class, 'forgotFormShow'])->name('forgot.form');
    Route::post('forgot', [UserLoginController::class, 'forgot'])->name('forgot');
    Route::get('password/reset/form/{token}', [UserLoginController::class, 'passwordResetForm'])->name('password.reset.form');
    Route::post('password/reset', [UserLoginController::class, 'passwordReset'])->name('password.reset');


    
    Route::group([ 'middleware' => 'auth'], function(){

        //<---------------------> Start Dashboard Route <------------------------------------------------------------------------------------>

        Route::get('dashboard', [UserDashboardController::class, 'index'])->name('dashboard.index');

        Route::get('order/index', [UserOrderController::class, 'index'])->name('order.index');
        Route::get('order/detials/{id}', [UserOrderController::class, 'details'])->name('order.details');
        Route::get('order/pdf/{id}', [UserOrderController::class, 'orderPDF'])->name('order.pdf');


        //<---------------------> Start User Profile Setting <------------------------------------------------------------------------------------>


        Route::get('profile/edit/{id}', [UserProfileController::class, 'edit'])->name('profile.edit');
        Route::post('profile/update', [UserProfileController::class, 'update'])->name('profile.update');

        Route::get('reset/password/{id}', [UserProfileController::class, 'resetPassword'])->name('reset.password');
        Route::post('reset/password/update', [UserProfileController::class, 'passwordUpdate'])->name('password.update');


        //<---------------------> Start User Ticket Route <------------------------------------------------------------------------------------>

        Route::get('ticket/index', [TicketController::class, 'index'])->name('ticket.index');
        Route::get('ticket/create', [TicketController::class, 'create'])->name('ticket.create');
        Route::post('ticket/store', [TicketController::class, 'store'])->name('ticket.store');
        Route::get('ticket/message/{id}', [TicketController::class, 'message'])->name('ticket.message');
        Route::get('ticket/delete/{id}', [TicketController::class, 'delete'])->name('ticket.delete');
        Route::get('ticket/file/download/{file}', [TicketController::class, 'downloadFile'])->name('ticket.file.download');
        Route::get('ticket/message/edit/{id}', [TicketController::class, 'editMessage'])->name('ticket.message.edit');
        Route::post('ticket/message/update/{id}', [TicketController::class, 'updateMessage'])->name('ticket.message.update');
       
        Route::post('ticket/message/reply', [TicketReplyController::class, 'reply'])->name('ticket.message.reply');
        Route::get('ticket/message/reply/delete/{id}', [TicketReplyController::class, 'delete'])->name('ticket.message.reply.delete');
        Route::get('ticket/message/reply/edit/{id}', [TicketReplyController::class, 'edit'])->name('ticket.message.reply.edit');
        Route::post('ticket/message/reply/update/{id}', [TicketReplyController::class, 'update'])->name('ticket.message.reply.update');

    });

    
});

//<---------------> END USER ROUTE <--------------------------------------------------------------------------------------------------------->
